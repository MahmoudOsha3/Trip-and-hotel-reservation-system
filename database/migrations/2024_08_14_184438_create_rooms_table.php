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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('room_number');
            $table->enum('room_type',['single' , 'double' , 'suite'])->default('single');
            $table->string('sub_description') ;
            $table->text('description') ;
            $table->float('price');
            $table->boolean('availability_status')->default(0)->comment('0 => valiability , otherwise'); // 0 => valiablity , 1 => Non-Avaliabilty
            $table->foreignId('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
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
        Schema::dropIfExists('rooms');
    }
};
