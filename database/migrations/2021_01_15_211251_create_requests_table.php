<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Tabla para solicitudes
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('person_id')->unsigned()->unique();
            $table->string('status')->default('requested');
            $table->timestamps();
            //Llave foránea para id de persona
            $table->foreign('person_id')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
