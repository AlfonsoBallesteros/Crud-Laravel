<?php

namespace App\Traits;
use Crypt;
/**
 * Trait Encryptable
 * @package App\Traits
 */
trait Encryptable
{

    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (in_array($key, $this->encryptable)) {
            $value = Crypt::decrypt($value);
        }
        return $value;
    }
 
    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->encryptable)) {
            $value = Crypt::encrypt($value);
        }
        return parent::setAttribute($key, $value);
    }
}