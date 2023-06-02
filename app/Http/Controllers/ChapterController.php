<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Chapter;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapters = Chapter::with('course')->paginate(10);
        
        return Inertia::render('Model/Chapter/Index', ['chapters'=>$chapters])->table(function(InertiaTable $table){
            $table->column('id',canBeHidden:false);
            $table->column('name', canBeHidden:false);
            $table->column('course', canBeHidden:false);
        });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChapterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter)
    {
        //
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
        //
    }
}
