<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetiringSoonProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retiring_soon_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('external_id');
            $table->enum('marketplace', ['US', 'UK']);
            $table->string('url');
            $table->string('name');
            $table->char('currency', 3);
            $table->float('price', 15, 2);
            $table->float('sale_price', 15, 2)->nullable();
            $table->float('discount_percentage', 15, 2)->nullable();
            $table->float('discount_amount', 15, 2)->nullable();
            $table->enum('stock_status', ['out_of_stock', 'available', 'cta']);
            $table->dateTime('spotted_at');
            $table->dateTime('scraped_at');
            $table->timestamps();
            $table->unique(['external_id', 'marketplace'], 'unq_external_id_market_place');
            $table->index('price', 'idx_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('retiring_soon_products');
    }
}
