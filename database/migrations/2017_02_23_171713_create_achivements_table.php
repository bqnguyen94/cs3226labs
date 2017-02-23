<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAchivementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achivements', function (Blueprint $table) {
            $table->increments('id');
			$table->timestamps();
			$table->integer('letitbegins')->default(0);
			$table->integer('quickstarter')->default(0);
			$table->integer('activeinclass')->default(0);
			$table->integer('surpriseus')->default(0);
			$table->integer('highdetermination')->default(0);
			$table->integer('bookworm')->default(0);
			$table->integer('kattisapprentice')->default(0);
			$table->integer('codeforcespecialist')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achivements');
    }
}
