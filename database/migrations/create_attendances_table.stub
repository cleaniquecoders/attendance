<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->hashslug();
            $table->user();
            $table->belongsTo('attendance_types');
            $table->string('driver')->default('web')->comment('Driver can be Web, API, BLE, RFID');
            $table->string('identifier')
                ->nullable()
                ->index()
                ->comment('Other identifier if not using web checkin or checkout');
            $table->json('data')->nullable()->comment('Any data related to the checkin or checkout');
            $table->standardTime();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
