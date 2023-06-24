<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function getIgnoredFilterArray(string $parent_id, string $scope): array
    {
        return Topic::select('id')
            ->where('parent_id', '!=', request()->input('filter.'.$parent_id))
            ->$scope()
            ->get()
            ->pluck('id')
            ->toArray();
    }
}
