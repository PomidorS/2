<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class List extends Model
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

    /**
     * @param $parameters
     * @return bool
     */
    public function validate($parameters)
    {
        $validator = Validator::make($parameters, $this->rules);
        if ($validator->passes()) {
            return true;
        }
        $this->error = $validator->messages();
        return false;
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }
}
