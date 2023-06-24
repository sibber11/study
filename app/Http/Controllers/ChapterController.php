<?php

namespace App\Http\Controllers;

use App\Http\Resources\TopicResource;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $globalSearch = AllowedFilter::callback('global', function ($query, $value) {
            $query->where(function ($query) use ($value) {
                Collection::wrap($value)->each(function ($value) use ($query) {
                    $query->orWhere('name', 'LIKE', "%{$value}%");
                });
            });
        });
        $chapters = $this->getChaptersUsingQueryBuilder($globalSearch);
        $chapters = TopicResource::collection($chapters);
        return Inertia::render('Model/Chapter/Index', [
            'chapters' => $chapters,
        ])->table(function (InertiaTable $table) {
            // todo: limit the courses to the ones that are related to the semester
            $courses = Topic::course()->get()->pluck('name', 'id')->toArray();
            $table
//                ->selectFilter('semester_id', $semesters, 'Semesters')
                ->selectFilter('course_id', $courses, 'Course')
                ->column('id', canBeHidden: false, sortable: true)
                ->column('name', canBeHidden: false)
                ->column('course')
                ->column('semester')
                ->column('actions', canBeHidden: false)
                ->withGlobalSearch();
        });
    }

    /**
     * @param AllowedFilter $globalSearch
     * @return mixed
     */
    public function getChaptersUsingQueryBuilder(AllowedFilter $globalSearch): mixed
    {
        return QueryBuilder::for(Topic::class)
            ->allowedSorts(['id'])
            ->allowedFilters([
                AllowedFilter::exact('course_id', 'parent_id')->ignore($this->getIgnoredFilterArray('semester_id', 'course')),
                AllowedFilter::callback('semester_id', function (Builder $query, $value) {
                    $query->whereHas('parent', function (Builder $query) use ($value) {
                        $query->where('parent_id', $value);
                    });
                }),
                $globalSearch])
            ->chapter()
            ->with('parent')
            ->paginate(9)
            ->withQueryString();
    }
}
