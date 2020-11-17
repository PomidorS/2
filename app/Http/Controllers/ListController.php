<?php

namespace App\Http\Controllers;

use App\Models\List1;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Filter\ListsFilter;

class ListController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function outputLists(Request $request)
    {
        $builder = List1::all()->sortBy($request->input('sort_by'));
        $list = (new List1($builder, $request))->apply();
        return response()->json($list->values()->all(), 200);
    }
    /**
     * вывод всех дел в конкретном списке
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function output(Request $request, $id)
    {
        $max_out = 101;
        $min_out = 0;
        $result = $request->input('out');
        if ($result && $min_out < $result && $max_out > $result) {
            $out = (int)$request->input('out');
        }
        $list = List1::findOrFail((int)$id);
        $builder = $list->Task->sortBy($request->input('sort_by'));
        $tasks = (new ListsFilter($builder,$request))->apply()->take($out);
        $list->toArray();
        $list['tasks'] = $tasks->values()->all();
        $arrayOut = array(
          'list' => $list
        );
        return response()->json($arrayOut, 200);
    }

    /**
     * созадние списков с делами
     * @param Request $request
     * @return JsonResponse
     */
    public function create_lists(Request $request)
    {
        $Lists = new List1();
        if (!$Lists->validate($request->all())) {
            return response()->json($Lists->error,200);
        }
        $Lists = List1::create($request->all());
        return response()->json($Lists, 201);
    }

    /**
     * метод удаления списков по id
     * @param $id
     * @return JsonResponse
     */
    public function outputDelete($id)
    {
        $result = List1::findOrFail((int)$id);
        $result->delete();
        return response()->json('',200);
    }
}

