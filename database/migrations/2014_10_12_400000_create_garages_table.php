<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGaragesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garages', function (Blueprint $table) {
            $table->integer('id')->unsigned()->autoIncrement();
            $table->string('name');
            $table->integer('spaces_total')->unsigned();
            $table->integer('spaces_occupied')->unsigned();
            $table->string('phone_number')->default('1.519.860.6197');
            $table->float('hourly_rate')->default(3.0);
            $table->float('step_increase')->default(1.5);
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
        Schema::dropIfExists('garages');
    }
}
