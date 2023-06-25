<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    /** @var Builder $query */
                    $query
                        // look for questions with the given value in their title
                        ->orWhere('name', 'LIKE', "%{$value}%")
                        ->orWhereHas('parent', function ($query) use ($value) {
                            $query->where('name', 'LIKE', "%{$value}%");
                        });
                });
            });
        });
        $chapterIdFilter = AllowedFilter::callback('chapter_id', function ($query, $value) {
            $query->where('parent_id', $value);
        });

        $topics = QueryBuilder::for(Topic::class)
            ->allowedSorts(['id'])
            ->allowedFilters([
                $globalSearch,
                $chapterIdFilter,
            ])
            ->topicOfSelectedCourse()
            ->with('parent')
            ->paginate(8)
            ->withQueryString();

        $topics = TopicResource::collection($topics);

        return Inertia::render('Model/Topic/Index', [
            'topics' => $topics,
            'courses' => Topic::courseOfSelectedSemester()->get()->pluck('name', 'id')->toArray(),
        ])->table(function (InertiaTable $table) {
            $chapters = Topic::chapterOfSelectedCourse()->get()->pluck('name', 'id')->toArray();
            $table
                ->selectFilter('chapter_id', $chapters, 'Chapter')
                ->column('id', canBeHidden: false, sortable: true)
                ->column('name', canBeHidden: false)
                ->column('chapter', canBeHidden: false)
                ->column('course', canBeHidden: false)
                ->column('semester', canBeHidden: false)
                ->column('actions', canBeHidden: false)
                ->withGlobalSearch();
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'selectedType' => 'nullable|in:'. implode(',', Topic::TYPES),
        ]);
        $selectedType = request()->input('selectedType');
        $courses = Topic::whereNot('type', Topic::TYPE_TOPIC)->get()->toTree();
        return Inertia::render('Model/Topic/Create', [
            'courses' => $courses,
            'types' => Topic::TYPES,
            'selectedType' => $selectedType,
            'status' => session('status'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopicRequest $request)
    {
        $type = $request->input('type');

        $parent = match ($type) {
            Topic::TYPE_TOPIC => Topic::chapter()->whereId($request->input('chapter_id'))->first(),
            Topic::TYPE_CHAPTER => Topic::course()->whereId($request->input('course_id'))->first(),
            Topic::TYPE_COURSE => Topic::semester()->whereId($request->input('semester_id'))->first(),
            Topic::TYPE_SEMESTER => null,
            default => null,
        };
        $topic = Topic::create($request->validated());
        if (!is_null($parent)) {
            $parent->appendNode($topic);
        }

        return back()->with('status', 'Topic created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        $topic->load('questions');
        return Inertia::render('Model/Topic/Show', [
            'topic' => $topic,
        ])->table(function (InertiaTable $table) {
            $table->column('id', canBeHidden: false)
                ->column('value', canBeHidden: false);
        });
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTopicRequest $request, Topic $topic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        try {
            $topic->delete();
        } catch (\Exception $e) {
            // return back()->with('status', 'Topic cannot be deleted.');
            return response()->json(['status' => 'Topic cannot be deleted.'], 500);
        }
        return back()->with('status', 'Topic deleted.');
    }
}
