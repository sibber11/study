<?php

namespace App\Http\Controllers;

use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\QueryBuilder;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = QueryBuilder::for(Topic::class)
            ->defaultSort('id')
            ->allowedSorts(['id'])
            ->courseOfSelectedSemester()
            ->with('parent')
            ->paginate()
            ->withQueryString();
        $courses = TopicResource::collection($courses);
        return Inertia::render('Model/Course/Index', [
            'courses' => $courses,
        ])->table(function (InertiaTable $table) {
            $table->defaultSort('id')
                ->column('id', canBeHidden: false, sortable: true)
                ->column('name', canBeHidden: false)
                ->column('semester', canBeHidden: false)
                ->column('actions', canBeHidden: false);
        });
    }
}
