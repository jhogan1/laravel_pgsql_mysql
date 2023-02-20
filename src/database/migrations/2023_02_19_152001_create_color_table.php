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
        if (!Schema::hasTable('color')) {
            Schema::create('color', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('category_id')->nullable(false);
                $table->foreign('category_id')->references('id')->on('color_category')->onDelete('cascade');
                $table->string('color', 64)->nullable(false);
                $table->string('hex', 8)->nullable(false);
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
        Schema::dropIfExists('color');
    }
};
