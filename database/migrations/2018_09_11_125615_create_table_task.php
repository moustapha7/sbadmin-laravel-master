<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->text('comment')->nullable();
            $table->date('requestedDate')->nullable();
            $table->date('estcompletedDate')->nullable();
            $table->integer('estDay')->nullable();
            $table->integer('estHour')->nullable();
            $table->enum('status', ['Ongoing', 'Completed', 'Cancelled','Suspended']);
            
            $table->integer('employe_id')->unsigned()->index()->nullable();
            $table->integer('project_id')->unsigned()->index()->nullable();
            // Foerign key Constraint
            $table->foreign('employe_id')->references('id')->on('employe')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('project')->onDelete('cascade');
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
        Schema::dropIfExists('task');
    }
}
