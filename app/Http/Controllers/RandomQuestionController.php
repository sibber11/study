<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\Topic;
use App\Models\Year;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RandomQuestionController extends Controller
{
    public function index()
    {
        $questions = QuestionResource::collection($this->getQuestions());
        $props = [
            'questions' => $questions,
            'semesters' => Topic::semester()->get()->pluck('name', 'id')->toArray(),
            'courses' => Topic::courseOfSelectedSemester()->get()->pluck('name', 'id')->toArray(),
            'status' => session('success'),
        ];
        return Inertia::render('Model/RandomQuestion/Index', $props)->table(function (InertiaTable $table) {
            $chapters = Topic::chapterOfSelectedCourse()->get()->pluck('name', 'id')->toArray();
            $years = Year::all()->pluck('no', 'id')->toArray();
            $table
                ->selectFilter('chapter_id', $chapters, 'Chapter')
                ->selectFilter('year_id', $years, 'Year')
                ->selectFilter('difficulty', Question::DIFFICULTIES, 'Difficulty')
                ->column('id', canBeHidden: false)
                ->column('title', canBeHidden: false)
                ->column('chapter')
                ->column('course')
                ->perPageOptions([1,2,3,4,8,12,16])
                ->withGlobalSearch();
            if (auth()->check() && auth()->user()?->isAdmin()) {
                $table->column('read', label: '✔️')
                    ->column('actions', canBeHidden: false);
            }
        });
    }

    public function getQuestions(): LengthAwarePaginator
    {
        return QueryBuilder::for(Question::class)
            ->allowedFilters([
                'title',
                AllowedFilter::callback('chapter_id', function ($query, $value) {
                    $query->where('topic_id', $value);
                })->ignore($this->getIgnoredFilterArray('chapter_id', 'course')),

                AllowedFilter::callback('year_id', function ($query, $value) {
                    $query->whereHas('years', function ($query) use ($value) {
                        $query->where('year_id', $value);
                    });
                }),
                AllowedFilter::exact('difficulty'),
                AllowedFilter::exact('star'),
            ])
            ->inRandomOrder()
            ->with(['topic.parent.parent', 'years'])
            ->withCount('users')
            ->paginate(request()->input('perPage', 1))
            ->withQueryString();
    }
}
