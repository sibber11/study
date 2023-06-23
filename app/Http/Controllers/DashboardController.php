<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {

        // fetch the questions count where star is maximum
        $important_questions = Question::whereStar(Question::MAX_STAR)->count();
//        $unimportant_questions = Question::whereStar(0)->count();

        // fetch the questions count where the year count is greater than the threshold
//        $common_questions = Question::whereHas('years', function ($query) {
//            $query->groupBy('questions_id')
//                ->havingRaw('COUNT(*) >= ?', [Question::IMPORTANT]);
//        })->count();

        $common_questions = Question::leftJoin('question_year', 'questions.id', '=', 'question_year.question_id')
            ->groupBy('questions.id')
            ->havingRaw('COUNT(*) >= ?', [Question::IMPORTANT])
            ->count();

        // fetch the questions count where the year count is less than the threshold
        $uncommon_questions = Question::leftJoin('question_year', 'questions.id', '=', 'question_year.question_id')
            ->groupBy('questions.id')
            ->havingRaw('COUNT(*) <= ?', [1])
            ->count();

        // fetch the questions count where the difficulty is maximum
        $difficult_questions = Question::whereDifficulty(Question::MAX_DIFFICULTY)->count();

        /** @var User $user */
        $user = auth()->user();
        $completed_questions = $user->questionReads()->distinct('question_id')->count();

        return Inertia::render('Dashboard', [
            'questions_count' => [
                [
                    'name' => 'Important Questions',
                    'count' => $important_questions
                ],
//                [
//                    'name' => 'Unimportant Questions',
//                    'count' => $unimportant_questions
//                ],
                [
                    'name' => 'Common Questions',
                    'count' => $common_questions
                ],
                [
                    'name' => 'Uncommon Questions',
                    'count' => $uncommon_questions
                ],
                [
                    'name' => 'Difficult Questions',
                    'count' => $difficult_questions
                ],
                [
                    'name' => 'Completed Questions',
                    'count' => $completed_questions
                ],
            ]
        ]);
    }
}
