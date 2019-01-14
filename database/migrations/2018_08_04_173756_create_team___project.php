<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->text('comment')->nullable();
            $table->date('requestedDate')->nullable();
            $table->date('estcompletedDate')->nullable();
            $table->date('assignedDate');
            $table->integer('estDay')->nullable();
            $table->integer('estHour')->nullable();
            $table->enum('status', ['Ongoing', 'Completed', 'Cancelled','Suspended']);
            
            $table->integer('team_id')->unsigned()->index()->nullable();
           // $table->integer('requestor_id')->unsigned()->index()->nullable();
            // Foerign key Constraint
            $table->foreign('team_id')->references('id')->on('team')->onDelete('cascade');
          //  $table->foreign('requestor_id')->references('id')->on('client')->onDelete('cascade');

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
        Schema::dropIfExists('Project');
    }
}
