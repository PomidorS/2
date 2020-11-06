<?php

namespace App\Http\Controllers;

use App\Models\Task;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//класс для осуществления манипуляций над делами в БД
class TaskController extends Controller
{

    public function create_task(Request $req){//создание данных в делах
        $rules = [
            'task_id',
            'name' => 'required|min:3',
            'short_description'=>'required|min:3',
        'stringency'=>'required|min:4'
        ];
        $validator = Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $task=Task::create($req->all());
        return response()->json($task,201);
    }
     public function output($id){//метод вывода данных в делах по id
        $result = Task::find($id);
        if(is_null($result)){
            return response()->json(['error'=>true,'message'=>'Incorrect Name Exception'], 400);
        }
        return response()->json( $result,200);
     }


    public function outputEdit(Request $req, $id){ //метод редактирования данных в делах по id
        $rules = [
            'name' => 'required|min:3',
        'short_description'=>'required|min:3',
        'stringency'=>'required|min:4'
        ];
        $validator = Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $result = Task::find($id);
        if(is_null($result)){
            return response()->json(['error'=>true,'message'=>'Incorrect Name Exception'], 400);
        }
        $result->update($req->all());
        return response()->json($result,201);
    }


    public function outputDelete(Request $req, $id){ //метод удаления данных в делах по id
        $result = Task::find($id);
        if(is_null($result)){
            return response()->json(['error'=>true,'message'=>'Incorrect Name Exception'], 400);
        }

        $result->delete();
        return response()->json('',200);
    }
}

