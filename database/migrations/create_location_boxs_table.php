<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationBoxsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_boxs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('lb_location_id')->unsigned()->nullable();
            $table->foreign('lb_location_id')->references('id')->on('locations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('lb_name');
            $table->tinyInteger('lb_status')->default(0)->nullable();
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
        Schema::dropIfExists('location_boxs');
    }
}
