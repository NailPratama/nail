<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoverImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cover_images', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('namagambar');
            $table->string('slug')->unique();
            $table->string('pengunggah');
            $table->string('lisensi');
            $table->string('cap_all_DE');
            $table->string('cap_locmap_DE');
            $table->string('cap_payload_DE');
            $table->string('path');
            $table->string('link');
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
        Schema::dropIfExists('cover_images');
    }
}
