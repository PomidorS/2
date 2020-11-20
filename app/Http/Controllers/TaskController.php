<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\List;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Filter\TasksFilter;

class TaskController extends Controller
{
    /**
     * создание дела
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function create_task($id, Request $request)
    {
        $task = new Task();
        if (!$task->validate($request->all())) {
            return response()->json($task->error , 400);
        }
        $list = List::findOrFail((int) $id);
        $task = $list->tasks()->create($request->all());
        return response()->json(Task::find($task['id']), 201);
    }

    /**
     * метод вывода данных в делах по id
     * @param $id
     * @return JsonResponse
     */
     public function output($id)
     {
        $result = Task::findOrFail((int) $id);
        return response()->json($result,200);
     }

    /**
     * метод редактирования данных в делах по id
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function outputEdit(Request $request, $id)
    {
        $result = Task::findOrFail((int) $id);
        if (!$result->validate($request->all())) {
            return response()->json($result->error, 400);
        }
        $result->update($request->all());
        return response()->json($result, 201);
    }

    /**
     * метод удаления данных в делах по id
     * @param $id
     * @return JsonResponse
     */
    public function outputDelete($id)
    {
        $result = Task::findOrFail((int) $id);
        $result->delete();
        return response()->json('', 200);
    }

    /**
     * ставим меточку на дело - выполнено или нет
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function state_of_affairs($id, Request $request)
    {
        $result = Task::findOrFail((int) $id);
        $status = $request->input('state_of_affairs');
        if ($status != 'false' && $status != 'true') {
            return response()->json(['message' => 'state_of_affairs field is boolean'], 400);
        }
        $result->state_of_affairs = $status;
        $result->save();
        return response()->json('nice', 200);
    }
}

