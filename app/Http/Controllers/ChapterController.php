<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Chapter;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapters = Chapter::with(['course' => function ($query) {
            $query->with('semester');
        }])->paginate(10);

        return Inertia::render('Model/Chapter/Index', [
            'chapters' => $chapters,
            'status' => session('status')
        ])->table(function (InertiaTable $table) {
            $table->column('id', canBeHidden: false)
                ->column('name', canBeHidden: false)
                ->column('course', canBeHidden: false)
                ->column('semester', canBeHidden: false)
                ->column('actions', canBeHidden: false);
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return Inertia::render('Model/Chapter/Create', [
            'courses' => $courses,
            'status' => session('status')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChapterRequest $request)
    {
        $chapter = Chapter::make();
        $chapter->fill($request->validated());
        $chapter->save();
        return back()->with('status', 'chapter-stored-successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        $chapter->load('topics');
        $questions = $chapter->questions()->with('topic')->paginate();
        // dd($questions);
        return Inertia::render('Model/Chapter/Show', [
            'chapter' => $chapter,
            'questions' => $questions
        ])->table(function(InertiaTable $table){
            $table->column('id', canBeHidden:false)
                ->column('value', canBeHidden:false)
                ->column('topic', canBeHidden:false);

        });
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chapter $chapter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChapterRequest $request, Chapter $chapter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter)
    {
        $chapter->delete();
        return back()->with('status', 'chapter-deleted-successfully');
    }
}
