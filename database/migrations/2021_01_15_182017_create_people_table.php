<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tabla para personas
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cui')->unique();
            $table->bigInteger('identification_card')->unique()->nullable();
            $table->string('name');
            $table->string('last_name');
            $table->date('birthdate');
            $table->text('address');
            $table->string('phone', 8);
            $table->string('department');
            $table->string('township');
            $table->string('email')->unique();
            $table->string('picture')->nullable();
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
