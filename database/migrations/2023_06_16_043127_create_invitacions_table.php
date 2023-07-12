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
        Schema::create('invitacions', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',120);
            $table->boolean('confirmacion')->nullable()->default(false);
            $table->boolean('asistencia')->nullable()->default(false);
            $table->boolean('protegido')->nullable()->default(false);
            $table->string('Keyinvited', 16)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitacions');
    }
};
