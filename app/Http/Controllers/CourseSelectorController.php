<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CourseSelectorController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        if ($request->has('model_id')) {
            $request->validate([
                'model_id' => 'exists:topics,id',
            ]);
            session()->put('course_id', $request->get('model_id'));
        }
        return redirect(url()->previousPath());
    }
}
