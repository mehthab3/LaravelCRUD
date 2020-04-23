<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    public $table = 'feedback';

    public $fillable = ['name','email','feedback'];
}
