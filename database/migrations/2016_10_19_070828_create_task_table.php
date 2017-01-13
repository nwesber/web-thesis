<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
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
            $table->integer('user_id');
            $table->integer('routine_id');
            $table->string('task_title');
            $table->string('task_description');
            $table->date('due_date');
            $table->text('priority');
            $table->text('task_day');
            $table->time('time_start');
            $table->boolean('is_completed');
            $table->timestamps();
            $table->softDeletes();
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
