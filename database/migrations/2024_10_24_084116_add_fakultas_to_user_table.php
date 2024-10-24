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
        Schema::table('user', function (Blueprint $table) {
            Schema::table('user', function (Blueprint $table) {
                $table->string('fakultas')->nullable(false);  // Add fakultas column
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            Schema::table('user', function (Blueprint $table) {
                $table->dropColumn('fakultas');  // Remove fakultas column if rolled back
            });
        });
    }
};
