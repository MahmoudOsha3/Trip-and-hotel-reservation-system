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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('about_company');
            $table->string('address');
            $table->integer('contact_number');
            $table->foreignId('type_company_id')->references('id')->on('type_companies')->onDelete('cascade');
            $table->foreignId('owner_id')->references('id')->on('owner_companies')->onDelete('cascade');
            // attachments of company => polymorphic relationship with (attachments table)
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
        Schema::dropIfExists('companies');
    }
};
