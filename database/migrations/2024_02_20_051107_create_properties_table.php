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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_no')->unique();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('subcategory_id')->constrained();
            $table->text('description')->nullable();
            $table->string('serial_no');
            $table->char('measurement_unit');
            $table->integer('unit_value');
            $table->foreignId('acquisition_id')->constrained();
            $table->foreignId('received_from')->constrained('employees');
            $table->foreignId('office_id')->constrained();
            $table->foreignId('assigned_to')->constrained('employees');
            $table->date('date_acquired');
            $table->enum('status', ['Serviceable', 'Unserviceable']);
            $table->string('photo')->nullable();
            $table->string('document')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
