<?php

namespace App\Http\Controllers;

use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\QueryBuilder;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semesters = QueryBuilder::for(Topic::class)
            ->defaultSort('id')
            ->allowedSorts(['id'])
            ->semester()
            ->paginate()
            ->withQueryString();

        $semesters = TopicResource::collection($semesters);
        return Inertia::render('Model/Semester/Index', [
            'semesters' => $semesters,
        ])->table(function (InertiaTable $table) {
            $table->defaultSort('id')
                ->column('id', canBeHidden: false, sortable: true)
                ->column('name', canBeHidden: false)
                ->column('actions', canBeHidden: false);
        });
    }
}
