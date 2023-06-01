<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Semester;
use App\Http\Requests\StoreSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semesters = Semester::paginate(10);
        return Inertia::render('Model/Semester/Index', ['semesters' => $semesters])->table(function(InertiaTable $table){
            $table->column('id');
            $table->column('name');
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
    public function store(StoreSemesterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Semester $semester)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semester $semester)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSemesterRequest $request, Semester $semester)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semester $semester)
    {
        //
    }
}
