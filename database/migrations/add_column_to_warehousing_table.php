<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToWarehousingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehousing', function (Blueprint $table) {
            //
            $table->unsignedInteger('w_transport_method_id')->after('pw_user_id')->unsigned()->nullable();
            $table->foreign('w_transport_method_id')->references('id')->on('transport_methods')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('w_schedule', 255)->after('w_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehousing', function (Blueprint $table) {
            //
        });
    }
}
