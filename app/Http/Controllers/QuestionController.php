<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Course;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\QueryBuilder;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $questions = Question::with('topic')->get();
        $questions = QueryBuilder::for(Question::class)
            ->allowedFilters(['value'])
            ->with(['topic.chapter.course'])
            ->paginate()
            ->withQueryString();
        return Inertia::render('Model/Question/Index', [
            'questions' => $questions,
            'status' => session('success')
        ])->table(function(InertiaTable $table){
            $table->column('id')
                ->column('value')
                ->column('topic')
                ->column('chapter')
                ->column('course');
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::with('chapters.topics')->get();
        return Inertia::render('Model/Question/Create',[
            'courses' => $courses,
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
        //
    }
}
