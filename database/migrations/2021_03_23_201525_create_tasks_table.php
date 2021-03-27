<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedBigInteger('task_status_id');
            $table->unsignedBigInteger('user_id');
            $table->string('header');
            $table->text('description');
            $table->datetime('end_date');
            $table->string('file')->nullable();
            $table->timestamps();

            $table->foreign('team_id')
				->references('id')
				->on('teams')
				->onDelete('CASCADE');

            $table->foreign('task_status_id')
				->references('id')
				->on('task_status')
				->onDelete('CASCADE');
            
            $table->foreign('user_id')
				->references('id')
				->on('users')
				->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
