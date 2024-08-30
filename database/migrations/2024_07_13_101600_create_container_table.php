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
        Schema::create('container', function (Blueprint $table) {
            $table->id();

            $table->string('period_covered')->required();
            $table->string('barangay')->required();
            $table->string('address')->required();
            $table->date('inspection_date')->required();
            $table->integer('no_of_container')->required();
            $table->integer('no_of_containers_with_larvae')->required();
            $table->string('containers_kind')->required();
            $table->integer('total_house')->required();
            $table->integer('total_containers')->required();
            $table->integer('total_containers_with_larvae')->required();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('container');
    }
};
