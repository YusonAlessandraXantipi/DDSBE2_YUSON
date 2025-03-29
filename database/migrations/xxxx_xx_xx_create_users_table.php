<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('tbluser', function (Blueprint $table) {
            $table->id();
            $table->string('username'); // Make sure this line exists
            $table->string('password');
            $table->timestamps();
        });
    }
}
