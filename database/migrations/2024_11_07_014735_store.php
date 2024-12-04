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
        Schema::create('stores', function (Blueprint $table) {
            $table->id('id_store');
            $table->string('name', 50);
            $table->string('street', 50);
            $table->string('neighbourhood', 50);
            $table->string('zip_code', 5);
            $table->string('municipality', 50);
            $table->string('external_number')->nullable(true);
            $table->string('latitude')->nullable(true);
            $table->string('length')->nullable(true);
            $table->string('email', 50)->unique();
            $table->string('phone');
            $table->string('seller_name', 50);
            $table->unsignedBigInteger('id_status')->nullable(false);
            $table->foreign('id_status')->references('id_status')->on('statuses');
            $table->unsignedBigInteger('id_store_type')->nullable(false);
            $table->foreign('id_store_type')->references('id_store_type')->on('store_types');
            $table->unsignedBigInteger('id_employee')->nullable();
            $table->foreign('id_employee')->references('id_employee')->on('employees');
            $table->unsignedBigInteger('id_folio')->nullable(false);
            $table->foreign('id_folio')->references('id_folio')->on('folios');
            $table->timestamps();

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
