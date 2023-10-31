<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
			$table->string('title')->nullable();
            $table->string('title_color', 20)->default('#333333')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('sub_title_color', 20)->default('#b5b5b5')->nullable();
            $table->string('link', 255)->nullable();
            $table->integer('order')->default(100);
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
        Schema::dropIfExists('sliders');
    }
}
