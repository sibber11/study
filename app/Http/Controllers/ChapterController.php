<?php

namespace App\Http\Controllers;

use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\QueryBuilder;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapters = QueryBuilder::for(Topic::class)
            ->defaultSort('id')
            ->allowedSorts(['id'])
            ->chapter()
            ->paginate(9)
            ->withQueryString();
        $chapters = TopicResource::collection($chapters);
        return Inertia::render('Model/Chapter/Index', [
            'chapters' => $chapters,
        ])->table(function (InertiaTable $table) {
            $table->defaultSort('id')
                ->column('id', canBeHidden: false, sortable: true)
                ->column('name', canBeHidden: false)
                ->column('course', canBeHidden: false)
                ->column('semester', canBeHidden: false)
                ->column('actions', canBeHidden: false);
        });
    }
}
