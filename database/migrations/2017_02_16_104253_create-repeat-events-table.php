<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepeatEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repeat_event', function (Blueprint $table) {
            $table->increments('id');
            $table->string('repeat_id');
            $table->string('event_title');
            $table->string('event_description');
            $table->string('user_id');
            $table->string('full_day');
            $table->dateTime('time_start');
            $table->dateTime('time_end');
            $table->string('color');
            $table->string('location');
            $table->string('is_shared');
            $table->timestamps();
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repeat_event');
    }
}
