<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SemesterSelectorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'model_id' => 'required|exists:topics,id',
        ]);
        $semester = $request->input('model_id');
        $request->session()->put('semester_id', $semester);
        $request->session()->forget('course_id');
        if (auth()->check()){
            /** @var User $user */
            $user = auth()->user();
            $user->semester()->associate($semester);
            $user->save();
        }
        return back()->with('success', 'Semester selected successfully.');
    }
}
