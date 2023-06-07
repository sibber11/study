<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\Course;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::with(['chapter' => function ($query) {
            $query->with(['course' => function ($query) {
                $query->with('semester');
            }]);
        }])->paginate(10);
        

        return Inertia::render('Model/Topic/Index', [
            'topics' => $topics,
            ])->table(function (InertiaTable $table) {
            $table->column('id', canBeHidden: false)
                ->column('name', canBeHidden: false)
                ->column('chapter', canBeHidden: false)
                ->column('course', canBeHidden: false)
                ->column('semester', canBeHidden: false)
                ->column('actions', canBeHidden:false);
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::with('chapters')->get();
        return Inertia::render('Model/Topic/Create', [
            'courses' => $courses,
            'status' => session('success'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopicRequest $request)
    {
        $topic = Topic::create($request->validated());

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
        ])->table(function(InertiaTable $table){
            $table->column('id', canBeHidden:false)
                ->column('value', canBeHidden:false);
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
        try{
            $topic->delete();
        }
        catch(\Exception $e){
            // return back()->with('status', 'Topic cannot be deleted.');
            return response()->json(['status' => 'Topic cannot be deleted.'], 500);
        }
        return back()->with('status', 'Topic deleted.');
    }
}
