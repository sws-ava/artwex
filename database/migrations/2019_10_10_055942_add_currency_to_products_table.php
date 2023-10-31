<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrencyToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('priority')->nullable()->default(100);
            $table->string('iso_code', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('symbol', 255)->nullable();
            $table->string('disambiguate_symbol', 255)->nullable();
            $table->string('alternate_symbols', 255)->nullable();
            $table->string('subunit', 255)->nullable();
            $table->integer('subunit_to_unit')->default(100);
            $table->boolean('symbol_first')->default(1);
            $table->string('html_entity', 255)->nullable();
            $table->string('decimal_mark', 25)->nullable();
            $table->string('thousands_separator', 25)->nullable();
            $table->string('iso_numeric', 25)->nullable();
            $table->integer('smallest_denomination')->default(1);
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->integer('currency_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('currency_id');
        });
		Schema::drop('currencies');
    }
}
