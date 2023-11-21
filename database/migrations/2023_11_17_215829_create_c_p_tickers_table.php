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
        Schema::create('c_p_tickers', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('cp_id');
            $table->string('name');
            $table->string('symbol');
            $table->integer('rank')->nullable();
            $table->integer('circulating_supply')->nullable();
            $table->integer('total_supply')->nullable();
            $table->integer('max_supply')->nullable();
            $table->integer('beta_value')->nullable();
            $table->dateTime('first_data_at')->nullable();
            $table->dateTime('cp_last_updated')->nullable();
            $table->timestamps();

            // Explicitly specify the constraint for 'cp_id'
            $table->unique('id', 'c_p_tickers_id_unique');
            $table->unique('cp_id', 'c_p_tickers_cp_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_p_tickers');
    }
};
