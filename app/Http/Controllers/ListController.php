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
     * вывод всех списков
     * @param Request $req
     * @param $id
     * @return JsonResponse
     */
    public function outputLists(Request $req, $id)
    {
        $create = List1::all()->sortBy($req->input('sort_by'));
        $list = (new List1($create, $req))->apply();
        return response()->json($list->values()->all(), 200);
    }
    /**
     * вывод всех дел в конкретном списке
     * @param Request $req
     * @param $id
     * @return JsonResponse
     */
    public function output(Request $req, $id)
    {
        $out = 10;
        $result = $req->input('out');
        if ($result && 0 < $result && 101 > $result) {
            $out = (int)$req->input('out');
        }
        $list = List1::findOrFail((int)$id);
        $create = $list->Task->sortBy($req->input('sort_by'));
        $tasks = (new ListsFilter($create,$req))->apply()->take($out);
        $list->toArray();
        $list['tasks'] = $tasks->values()->all();
        $arrayOut = array(
          'list' => $list
        );
        return response()->json( $arrayOut,200);
    }

    /**
     * созадние списков с делами
     * @param Request $req
     * @return JsonResponse
     */
    public function create_lists(Request $req)
    {
        $Lists = new List1();
        if (!$Lists->validate($req->all())) {
            return response()->json($Lists->error,200);
        }
        $Lists = List1::create($req->all());
        return response()->json($Lists,201);
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

