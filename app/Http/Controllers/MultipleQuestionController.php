<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMultipleQuestionRequest;
use App\Models\Question;
use App\Models\Topic;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MultipleQuestionController extends Controller
{
    public function create()
    {
        $semesters = Topic::with('children')->get()->toTree();
        return Inertia::render('Model/Question/CreateMany', [
            'semesters' => $semesters,
            'years' => Year::all()
        ]);
    }

    public function store(StoreMultipleQuestionRequest $request)
    {
        if ($request->input('confirmed')) {
            $request->store_questions();
            return to_route('questions.index')->with('success', 'Questions created successfully');
        } else {
            return $request->getFormattedData();
        }
    }
}
