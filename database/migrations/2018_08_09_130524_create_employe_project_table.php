<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employe_project', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comment')->nullable();
            $table->date('assignedDate')->nullable();
            $table->date('reassignedDate')->nullable();
            $table->enum('type', ['Assigned', 'Reassigned']);
            
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
        Schema::dropIfExists('employe_project');
    }
}
