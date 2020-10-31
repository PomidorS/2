<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'short_description',
        'stringency',
        'state_of_affairs'
    ];
    public function tasks(){
        return $this->hasMany('Task');
    }
}
