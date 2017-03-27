<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $fillable = ['type', 'professor', 'content', 'area', 'description', 'college', 'file'];
}
