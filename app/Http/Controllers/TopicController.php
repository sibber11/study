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
        $courseIdFilter = AllowedFilter::callback('course_id', function ($query, $value) {
            $query->whereHas('parent', function ($query) use ($value) {
                $query->where('parent_id', $value);
            });
        });

        $chapterIdFilter = AllowedFilter::callback('chapter_id', function ($query, $value) {
            $query->where('parent_id', $value);
        })->ignore($this->getIgnoredFilterArray('course_id', 'chapter'));

        $topics = QueryBuilder::for(Topic::class)
            ->allowedSorts(['id'])
            ->allowedFilters([
                $globalSearch,
                $chapterIdFilter,
                $courseIdFilter,
            ])
            ->topic()
            ->with('parent')
            ->paginate(8)
            ->withQueryString();

        $topics = TopicResource::collection($topics);

//        throw new \Exception('stop');
        return Inertia::render('Model/Topic/Index', [
            'topics' => $topics,
        ])->table(function (InertiaTable $table) {
            $courses = Topic::course()->get()->pluck('name', 'id')->toArray();
            $chapters = Topic::chapter()->whereParentId(request()->input('filter.course_id'))->get()->pluck('name', 'id')->toArray();
            $table
                ->selectFilter('course_id', $courses, 'Course')
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
            'selectedType' => 'nullable|in:course,chapter,topic,semester',
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

        switch ($type) {
            case Topic::TYPE_TOPIC:
                $parent = Topic::chapter()->whereId($request->input('chapter_id'))->first();
                break;
            case Topic::TYPE_CHAPTER:
                $parent = Topic::course()->whereId($request->input('course_id'))->first();
                break;
            case Topic::TYPE_COURSE:
                $parent = Topic::semester()->whereId($request->input('semester_id'))->first();
                break;
            case Topic::TYPE_SEMESTER:
                $parent = null;
                break;
            default:
                $parent = null;
        }
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
