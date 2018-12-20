<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class USER extends Authenticatable
{
    // user -> 1_n -> comment
    protected $table = "users";

    public function comment()
    {
        // user có nhiều comment
        return $this->hasMany("App\COMMENT",
            "idUser",
            "id");
    }
}
