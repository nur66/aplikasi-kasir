<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice');
            $table->date('tgl_invoice');
            $table->double('pembayaran');
            $table->double('kembalian');
            $table->foreignId('transaksi_pembelian_id')->nullable();
            $table->foreignId('transaksi_pembelian_barang_id')->nullable();
            $table->foreignId('barang_id')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
