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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('nom')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('ville')->nullable();
            $table->string('adress')->nullable();
            $table->dateTime('RDV1')->nullable();
            $table->dateTime('relance1')->nullable();
            $table->text('dialog')->nullable();
            $table->dateTime('RDV2')->nullable();
            $table->dateTime('relance2')->nullable();
            $table->text('Compte-Rendu2')->nullable();
            $table->dateTime('RDV3')->nullable();
            $table->dateTime('relanc3')->nullable();
            $table->text('Compte-Rendu3')->nullable();
            $table->dateTime('RDV4')->nullable();
            $table->dateTime('relanc4')->nullable();
            $table->text('Compte-Rendu4')->nullable();
            $table->text('prix')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
