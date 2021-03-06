<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAchievementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_achievement', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('achievement_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
			$table->foreign('achievement_id')->references('id')->on('achievements')->onDelete('cascade');
            $table->string('reason');
            $table->string('week');
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
        Schema::dropIfExists('studentAchievement');
    }
}
