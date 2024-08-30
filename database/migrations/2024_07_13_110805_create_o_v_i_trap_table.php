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
        Schema::create('o_v_i_trap', function (Blueprint $table) {
            $table->id();

            $table->string('health_center');
            $table->date('date_installed');
            $table->date('date_harvested');
            $table->string('area_type');
            $table->string('address');
            $table->string('trap_indoor');
            $table->string('trap_outdoor');
            $table->float('latitude');
            $table->float('longitude');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('o_v_i_trap');
    }
};
