<?php

namespace App\DatabaseJson\Models;

use DatabaseJson\Model;

class Person extends Model {

    public $timestamps = false;
    protected $fillable = ['name', 'surname', 'birth_date', 'email', 'phone'];
    //
}
