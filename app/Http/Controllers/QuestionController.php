<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\Topic;
use App\Models\Year;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;
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
        $props = [
            'questions' => $questions,
            'courses' => Topic::courseOfSelectedSemester()->get()->pluck('name', 'id')->toArray(),
            'status' => session('success'),
        ];
        if (!auth()->check()){
            $props['semesters'] = Topic::semester()->get()->pluck('name', 'id')->toArray();
        }
        return Inertia::render('Model/Question/Index', $props)->table(function (InertiaTable $table) {
//            $topics = Topic::topic()->whereParentId(request()->input('filter.chapter_id'))->get()->pluck('name', 'id')->toArray();
            $chapters = Topic::chapterOfSelectedCourse()->get()->pluck('name', 'id')->toArray();
            $years = Year::all()->pluck('no', 'id')->toArray();
            $table
                ->selectFilter('chapter_id', $chapters, 'Chapter')
//                ->selectFilter('topic_id', $topics, 'Topic')
                ->selectFilter('year_id', $years, 'Year')
                ->selectFilter('difficulty', Question::DIFFICULTIES, 'Difficulty')
                ->column('id', canBeHidden: false)
                ->column('title', canBeHidden: false)
//                ->column('topic')
                ->column('chapter')
                ->column('course')
                ->withGlobalSearch();
            if (auth()->check() && auth()->user()?->isAdmin()) {
                $table->column('read', label: '✔️')
                    ->column('actions', canBeHidden: false);
            }
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
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
    public function store(StoreQuestionRequest $request): RedirectResponse
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
    public function edit(Question $question): Response
    {
        $this->prepareForEdit($question);
        $semesters = Topic::with('children')->get()->toTree();
        $years = Year::all();
        return Inertia::render('Model/Question/Edit', [
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
    public function update(UpdateQuestionRequest $request, Question $question): RedirectResponse
    {
        $question->update($request->validated());
        $years = $request->input('years');
        $question->years()->sync($years);
        return back()->with('success', 'Question updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question): RedirectResponse
    {
        $question->years()->detach();
        $question->users()->detach();
        $question->delete();
        return back()->with('success', 'Question deleted successfully');
    }

    public function read(Question $question): RedirectResponse
    {
        $question->read();
        return back()->with('success', 'Question read successfully');
    }

    public function getGlobalSearchFilter(): AllowedFilter
    {
        return AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query
                        // look for questions with the given value in their title
                        ->orWhere('title', 'LIKE', "%$value%")
                        // look for questions with the given value in their topic name
                        ->orWhereHas('topic', function ($query) use ($value) {
                            $query->where('name', 'LIKE', "%$value%");
                        })
                        // look for questions with the given value in their topic's parent name
                        ->orWhereHas('topic.parent', function ($query) use ($value) {
                            $query->where('name', 'LIKE', "%$value%");
                        });
                });
            });
        });
    }

    public function getQuestions(): LengthAwarePaginator
    {
        return QueryBuilder::for(Question::class)
            ->allowedFilters([
                'title',
                $this->getGlobalSearchFilter(),
                // filter by topic id
                AllowedFilter::exact('topic_id')->ignore($this->getIgnoredFilterArray('topic_id', 'chapter')),

                AllowedFilter::callback('chapter_id', function ($query, $value) {
                    $query->whereHas('topic', function ($query) use ($value) {
                        $query->where('parent_id', $value);
                    });
                })->ignore($this->getIgnoredFilterArray('chapter_id', 'course')),

                AllowedFilter::callback('year_id', function ($query, $value) {
                    $query->whereHas('years', function ($query) use ($value) {
                        $query->where('year_id', $value);
                    });
                }),
                AllowedFilter::exact('difficulty'),
                AllowedFilter::exact('star'),
            ])
            // eager load the topic and its ancestors
            ->with(['topic.parent.parent', 'years'])
            ->withCount('users')
            ->paginate()
            ->withQueryString();
    }

    /**
     * @param Question $question
     * @return void
     */
    public function prepareForEdit(Question $question): void
    {
        $question->load('years', 'topic.parent.parent.parent');
        $question->makeHidden(['years', 'topic']);
        $question->years_array = $question->years->pluck('id')->toArray();
        $question->chapter_id = $question->topic->parent_id;
        $question->course_id = $question->topic->parent->parent_id;
        $question->semester_id = $question->topic->parent->parent->parent_id;
    }
}
