<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('favorite_color')) {
            Schema::create('favorite_color', function (Blueprint $table) {
                $table->id();
                $table->string('user_name', 32)->nullable(false)->default('NA');
                $table->unsignedBigInteger('color_id')->nullable(false);
                $table->foreign('color_id')->references('id')->on('colors')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_color');
    }
};
