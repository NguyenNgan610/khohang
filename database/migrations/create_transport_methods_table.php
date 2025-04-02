<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transport_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tm_name'); // Tên phương thức vận chuyển
            $table->string('tm_carrier')->nullable(); // Tên đơn vị vận chuyển (nếu có)
            $table->decimal('tm_cost', 20, 2)->default(0.00); // Chi phí vận chuyển
            $table->tinyInteger('tm_status')->default(1);
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
        Schema::dropIfExists('transport_methods');
    }
}
