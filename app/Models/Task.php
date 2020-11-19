<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $rules = array(
        'name' => 'required',
        'stringency' => 'integer|between:1,5',
        'state_of_affairs' => 'boolean'
    );

    protected $fillable = [
        'id',
        'name',
        'short_description',
        'stringency',
        'state_of_affairs'
        ];

    public function validate($parametr)
    {
        $validator = Validator::make($parametr, $this->rules);
        if ($validator->passes()) {
            return true;
        }
        $this->error = $validator->messages();
    }

    public function list()
    {
        return $this -> belongsTo(List::class);
    }

}
