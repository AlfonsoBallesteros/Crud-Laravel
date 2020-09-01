<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class Client extends Model
{
    use Encryptable;
    
    protected $encryptable = [
      'nombre', 'email', 'phone'  
    ];

    protected $fillable = [
        'avatar',
        'nombre',
        'email',
        'phone',
        'id_skill'  
    ];
}
