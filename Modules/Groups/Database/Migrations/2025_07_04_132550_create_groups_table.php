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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('group_code')->unique();
            $table->string('group_name');
            $table->string('group_type'); // e.g., TUA, MUDA
            $table->decimal('base_price', 15, 2); // price per gram at 100% purity
            $table->decimal('cost_price', 15, 2); // cost per gram at 100% purity
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
