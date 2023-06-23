<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\Topic;
use App\Models\Year;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = QuestionResource::collection($this->getQuestions());
        return Inertia::render('Model/Question/Index', [
            'questions' => $questions,
            'status' => session('success')
        ])->table(function (InertiaTable $table) {
            $topics = Topic::topic()->whereParentId(request()->input('course_id'))->get()->pluck('name', 'id')->toArray();
            $chapters = Topic::chapter()->whereParentId(request()->input('course_id'))->get()->pluck('name', 'id')->toArray();
            $courses = Topic::course()->get()->pluck('name', 'id')->toArray();
            $years = Year::all()->pluck('no', 'id')->toArray();
            $table
                ->selectFilter('course_id', $courses, 'Course')
                ->selectFilter('chapter_id', $chapters, 'Chapter')
                ->selectFilter('topic_id', $topics, 'Topic')
                ->selectFilter('year_id', $years, 'Year')
                ->selectFilter('difficulty', Question::DIFFICULTIES, 'Difficulty')
                ->column('id', canBeHidden: false)
                ->column('title', canBeHidden: false)
                ->column('difficulty')
                ->column('read')
                ->column('star')
                ->column('years')
                ->column('topic')
                ->column('chapter')
                ->column('course')
                ->column('actions', canBeHidden: false)
                ->withGlobalSearch();
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $semesters = Topic::with('children')->get()->toTree();
        $years = Year::all();
        return Inertia::render('Model/Question/Create', [
            'semesters' => $semesters,
            'years' => $years,
            'difficulties' => Question::DIFFICULTIES,
            'stars' => Question::MAX_STAR,
            'status' => session('success')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        $question = Question::create($request->validated());
        $years = $request->input('years');
        $question->years()->attach($years);
        return back()->with('success', 'Question created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $semesters = Topic::with('children')->get()->toTree();
        $years = Year::all();
        return Inertia::render('Model/Question/Create', [
            'model' => $question,
            'semesters' => $semesters,
            'years' => $years,
            'difficulties' => Question::DIFFICULTIES,
            'stars' => Question::MAX_STAR,
            'status' => session('success')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->years()->detach();
        $question->users()->detach();
        $question->delete();
        return back()->with('success', 'Question deleted successfully');
    }

    public function read(Request $request, Question $question)
    {
        $question->read();
        return back()->with('success', 'Question read successfully');
    }

    /**
     * @return AllowedFilter
     */
    public function getGlobalSearchFilter(): AllowedFilter
    {
        return AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        // look for questions with the given value in their title
                        ->orWhere('title', 'LIKE', "%{$value}%")
                        // look for questions with the given value in their topic name
                        ->orWhereHas('topic', function ($query) use ($value) {
                            $query->where('name', 'LIKE', "%{$value}%");
                        })
                        // look for questions with the given value in their topic's parent name
                        ->orWhereHas('topic.parent', function ($query) use ($value) {
                            $query->where('name', 'LIKE', "%{$value}%");
                        });
                });
            });
        });
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getQuestions(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return QueryBuilder::for(Question::class)
            ->allowedFilters([
                'title',
                $this->getGlobalSearchFilter(),
                // filter by topic id
                AllowedFilter::exact('topic_id'),
                AllowedFilter::callback('chapter_id', function ($query, $value) {
                    $query->whereHas('topic', function ($query) use ($value) {
                        $query->where('parent_id', $value);
                    });
                }),
                AllowedFilter::callback('course_id', function ($query, $value) {
                    $query->whereHas('topic.parent', function ($query) use ($value) {
                        $query->where('parent_id', $value);
                    });
                }),
                AllowedFilter::callback('year_id', function ($query, $value) {
                    $query->whereHas('years', function ($query) use ($value) {
                        $query->where('year_id', $value);
                    });
                }),
                AllowedFilter::exact('difficulty'),
                AllowedFilter::exact('star'),
            ])
            // eager load the topic and its ancestors
            ->with(['topic.parent.parent.parent', 'years'])
            ->withCount('users')
            ->paginate(8)
            ->withQueryString();
    }
}
