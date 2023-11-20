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
            $table->string('cp_id');
            $table->string('ticker_id');
            $table->string('type');
            $table->float('price');
            $table->unsignedDecimal('volume_24h', 15, 4);
            $table->decimal('volume_24h_change_24h', 20, 10)->signed();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cpticker_quote');
    }
};
