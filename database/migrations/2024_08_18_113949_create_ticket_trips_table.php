<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_trips', function (Blueprint $table) {
            // id => the number of ticket
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->integer('seat_number');
            $table->enum('payment_status',['paid' , 'unpaid'])->default('unpaid');
            $table->date('booking_date') ;
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
        Schema::dropIfExists('ticket_trips');
    }
};
