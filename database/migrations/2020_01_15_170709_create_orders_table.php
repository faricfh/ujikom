<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tgl');
            $table->double('jmlh')->nullable();
            $table->double('total')->nullable();
            $table->unsignedBigInteger('id_customer');
            $table->foreign('id_customer')->references('id')->on('customers')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('order_produk', function (Blueprint $table) {
            $table->unsignedBigInteger('id_produk');
            $table->foreign('id_produk')->references('id')->on('produks')->onDelete('cascade');
            $table->unsignedBigInteger('id_order');
            $table->foreign('id_order')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('orders');
    }
}
