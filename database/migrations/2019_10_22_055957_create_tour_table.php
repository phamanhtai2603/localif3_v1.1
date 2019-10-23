<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTourTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tour', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tourguide_id');
            $table->unsignedBigInteger('location_id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('content')->nullable();
            $table->string('plan')->nullable();
            $table->integer('price')->nullable();
            $table->string('image')->default('default.png');
            $table->float('avgrate')->default(0);
            $table->integer('status')->default(0);
            $table->integer('is_delete')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tourguide_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('location')->onDelete('cascade');
 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tour');
    }
}