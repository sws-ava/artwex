<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->bigInteger('customer_id')->unsigned();
            $table->tinyInteger('rating')->nullable();
            $table->longtext('comment')->nullable();
			$table->Integer('parent_id')->nullable();
			$table->bigInteger('reviewable_id')->unsigned();
            $table->string('reviewable_type');
            $table->boolean('moderated')->default(1);
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
        Schema::dropIfExists('reviews');
    }
}
