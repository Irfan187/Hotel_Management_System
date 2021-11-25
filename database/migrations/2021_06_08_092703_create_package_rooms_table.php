<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_rooms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('room_id')->references('id')->on('rooms')
            ->onDelete('cascade');

            $table->foreignId('package_id')->references('id')->on('packages')
            ->onDelete('cascade');



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
        Schema::dropIfExists('package_rooms');
    }
}
