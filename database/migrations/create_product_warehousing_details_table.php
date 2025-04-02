<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductWarehousingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_warehousing_details', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('pwd_product_warehousing_id')->unsigned()->nullable();
            $table->foreign('pwd_product_warehousing_id')->references('id')->on('product_warehousing')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedInteger('pwd_product_id')->unsigned()->nullable();
            $table->foreign('pwd_product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedInteger('pwd_location_id')->unsigned()->nullable();
            $table->foreign('pwd_location_id')->references('id')->on('locations')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->unsignedInteger('pwd_box_id')->unsigned()->nullable();
            $table->foreign('pwd_box_id')->references('id')->on('location_boxs')
                ->onUpdate('cascade')->onDelete('cascade');


            $table->string('pwd_imei')->nullable();
            $table->tinyInteger('pwd_status')->nullable()->default(0);
            $table->tinyInteger('pwd_type')->nullable()->default(0);
            $table->text('pwd_note')->nullable();
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
        Schema::dropIfExists('product_warehousing_details');
    }
}
