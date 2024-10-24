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
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'npm')) {
                $table->dropColumn('npm');
            }    
            
            // Menambahkan kolom baru
            $table->enum('jurusan', ['fisika', 'kimia', 'biologi', 'matematika', 'ilmu komputer']);
            $table->integer('semester')->unsigned()->check('semester <= 14');
            $table->unsignedBigInteger('fakultas_id');
            
            // Membuat relasi dengan tabel fakultas
            $table->foreign('fakultas_id')->references('id')->on('fakultas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('npm')->nullable();
            $table->dropColumn(['jurusan', 'semester', 'fakultas_id']);
        });
    }
};
