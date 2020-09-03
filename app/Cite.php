<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cite extends Model
{
    protected $fillable = [
        'id',
        'name',
        'state',
        'department_id'
    ];
}
