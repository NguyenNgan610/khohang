<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPLocationIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->unsignedInteger('p_location_id')->after('p_user_id')->unsigned()->nullable();
            $table->foreign('p_location_id')->references('id')->on('locations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedInteger('p_box_id')->after('p_location_id')->unsigned()->nullable();
            $table->foreign('p_box_id')->references('id')->on('location_boxs')
                ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //

        });
    }
}
