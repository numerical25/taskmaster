<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('c_p_ticker_quotes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('ticker_id')->unique();
            $table->string('type');
            $table->float('price');
            $table->unsignedDecimal('volume_24h', 15, 4);
            $table->decimal('volume_24h_change_24h', 20, 10)->signed();
            $table->timestamps();

            $table->unique(['ticker_id', 'type'], 'c_p_tickers_quote_ticker_id_type_unique');
        });
        Schema::table('c_p_ticker_quotes', function($table) {
            $table->foreign('ticker_id')->references('id')->on('c_p_tickers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_p_ticker_quotes');
    }
};
