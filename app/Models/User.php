<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'tbluser'; // table name
    protected $fillable = ['username', 'password', 'gender'];
    public $timestamps = false; // if you don't have created_at / updated_at columns
}
