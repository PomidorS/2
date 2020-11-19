<?php

namespace App\Http\Controllers;

use App\Models\List;
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
        $builder = List::all()->sortBy($request->input('sort_by'));
        $list = (new List($builder, $request))->apply();
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
        $max_tasksCountPerPage = 101;
        $min_tasksCountPerPage = 0;

        $result = $request->input('out');
        if ($result && $min_tasksCountPerPage < $result && $max_tasksCountPerPage > $result) {
            $tasksCountPerPage = (int)$request->input('out');
        }
        else {
            $tasksCountPerPage = 10;
        }
        $list = List::findOrFail((int)$id);
        $builder = $list->task->sortBy($request->input('sort_by'));
        $tasks = (new ListsFilter($builder, $request))->apply()->take($tasksCountPerPage);
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
        $Lists = new List();
        if (!$Lists->validate($request->all())) {
            return response()->json($Lists->error,200);
        }
        $Lists = List::create($request->all());
        return response()->json($Lists, 201);
    }

    /**
     * метод удаления списков по id
     * @param $id
     * @return JsonResponse
     */
    public function outputDelete($id)
    {
        $result = List::findOrFail((int)$id);
        $result->delete();
        return response()->json('',200);
    }
}

