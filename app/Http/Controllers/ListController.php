<?php

namespace App\Http\Controllers;

use App\Models\Lists;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListController extends Controller
{
    public function output($id){//метод вывода списка по id
        $result = Lists::find($id);
        if(is_null($result)){
            return response()->json(['error'=>true,'message'=>'Incorrect Name Exception'], 400);
        }
        return response()->json( $result,200);
    }


    public function create_lists(Request $req){//создание данных в списках
        $rules = [
            'list_id',
            'name' => 'required|min:3',
            'short_description'=>'required|min:3',
        ];
        $validator = Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        $Lists = Lists::create($req->all());
        return response()->json($Lists,201);
    }

    public function outputDelete(Request $req, $id){ //метод удаления данных в списках по id
        $result = Lists::find($id);
        if(is_null($result)){
            return response()->json(['error'=>true,'message'=>'Incorrect Name Exception'], 400);
        }

        $result->delete();
        return redirect()->back();
    }
}
