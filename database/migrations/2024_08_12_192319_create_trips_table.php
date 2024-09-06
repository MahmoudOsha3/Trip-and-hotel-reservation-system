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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('title') ;
            $table->string('sub_description') ;
            $table->text('description') ; // 65,535 character
            $table->date('date_trip') ;
            $table->float('price') ;
            $table->integer('count_seats');
            $table->integer('booking_seats')->default(0);
            $table->enum('status_booking' , ['available_booking' , 'complete_booking' , 'close_booking'])->default('available_booking');
            $table->foreignId('place_trip_id')->references('id')->on('places')->onDelete('cascade');
            $table->foreignId('company_id')->references('id')->on('companies')->onDelete('cascade');
            // images of trips using polymorphic relationship
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
        Schema::dropIfExists('trips');
    }
};
