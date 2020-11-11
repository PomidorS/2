<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class List1 extends Model
{
    use HasFactory;

    protected $table = 'lists';

    protected $fillable = [
        'task_id',
        'id',
        'name'
    ];
    protected $rules = array(
        'name' => 'required'
    );

    public function validate($parametr)
    {
        $validator = Validator::make($parametr, $this->rules);
        if ($validator->passes()) {
            return true;
        }
        $this->error = $validator->messages();
        return false;
    }

    public function Task(){
        return $this->hasMany(Task::class);
    }
}
