<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class Client extends Model
{
    use Encryptable;
    
    protected $encryptable = [
        'name', 'email',
    ];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'id_skill'  
    ];
}
