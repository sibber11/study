<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\TopicResource;
use App\Models\Question;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Builder;
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
        // global search
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    /** @var Builder $query */
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


        $questions = QueryBuilder::for(Question::class)
            // join the topics table, so we can filter by topic name
            ->join('topics', 'topics.id', 'questions.topic_id')
            // join the topics table again, so we can filter by chapter name
            ->join('topics as chapters', 'chapters.id', 'topics.parent_id')
            ->allowedFilters([
                'title',
                $globalSearch,
                // filter by topic id
                AllowedFilter::exact('topics.id', null, false),
                // filter by chapter id
                AllowedFilter::exact('chapters.id', null, false)
            ])
            // eager load the topic and its ancestors
            ->with(['topic.ancestors'])
            ->paginate(8)
            ->withQueryString();

        $questions = QuestionResource::collection($questions);
        return Inertia::render('Model/Question/Index', [
            'questions' => $questions,
            'status' => session('success')
        ])->table(function (InertiaTable $table) {
            $topics = Topic::topic()->get()->pluck('name', 'id')->toArray();
            $chapters = Topic::chapter()->get()->pluck('name', 'id')->toArray();
            $table
                ->defaultSort('id')
                ->selectFilter('topics.id', $topics, 'Topic')
                ->selectFilter('chapters.id', $chapters, 'Chapter')
                ->column('id', canBeHidden: false)
                ->column('title', canBeHidden: false)
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
        return Inertia::render('Model/Question/Create', [
            'semesters' => $semesters,
            'status' => session('success')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        $question = Question::create($request->validated());
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
        //
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
        $question->delete();
        return back()->with('success', 'Question deleted successfully');
    }
}
