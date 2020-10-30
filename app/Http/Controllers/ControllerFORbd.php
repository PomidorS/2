<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class ControllerFORbd extends Controller
{
    public function create_task(Request $req){//создание данных в БД
        $task=Task::create($req->all());
        return response()->json($task,201);
    }
     public function output($id){//метод вывода "чего-то" по id

        return response()->json(Task::find($id),202);
     }
    public function outputEdit(Request $req, Task $output_edit){ //метод редактирования в БД
        $output_edit->update($req->all());
        return response()->json($output_edit,203);
    }
    public function outputDelete(Request $req, Task $output){ //метод редактирования в БД
        $output->delete();
        return response()->json('',204);
    }
}
