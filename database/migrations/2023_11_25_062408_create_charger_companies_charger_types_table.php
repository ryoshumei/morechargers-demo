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
        Schema::create('charger_companies_charger_types', function (Blueprint $table) {
            $table->foreignId('charger_type_id')->constrained('charger_types')->onDelete('cascade');
            $table->foreignId('provider_company_id')->constrained('provider_companies')->onDelete('cascade');
            $table->primary(['charger_type_id', 'provider_company_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charger_companies_charger_types');
    }
};
