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
        Schema::create('clients', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name', 100)->nullable(false);
            $table->string('document', 14)->nullable(false);
            $table->date('birth_date')->nullable(false);
            $table->string('sex', 1)->nullable(false);
            $table->string('address', 100)->nullable(false);
            $table->string('state', 2)->nullable(false);
            $table->string('city', 100)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
