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
        Schema::create('larvicide', function (Blueprint $table) {
            $table->id();

            $table->date('date')->required();
            $table->string('health_center')->required();
            $table->string('name')->required();
            $table->string('area_conducted')->required();
            $table->string('aide_name')->required();
            $table->string('contact_number')->required();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('larvicide');
    }
};
