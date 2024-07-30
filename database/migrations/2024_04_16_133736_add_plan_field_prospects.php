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
        Schema::create('prospects', function (Blueprint $table) {
        $table->string('plan')->nullable()->after('relance');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
