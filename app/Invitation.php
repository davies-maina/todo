<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public function worker(){


    	return $this->belongsTo(\App\User::class, 'worker_id');
    }

    public function admin(){


    	return $this->belongsTo(\App\User::class, 'admin_id');
    }
}
