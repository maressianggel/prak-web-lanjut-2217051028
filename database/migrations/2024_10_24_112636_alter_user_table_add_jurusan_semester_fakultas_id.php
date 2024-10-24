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
            // Cek jika kolom belum ada, baru tambahkan
            if (!Schema::hasColumn('user', 'jurusan')) {
                $table->enum('jurusan', ['fisika', 'kimia', 'biologi', 'matematika', 'ilmu komputer'])->notNull();
            }
            
            if (!Schema::hasColumn('user', 'semester')) {
                $table->tinyInteger('semester')->unsigned()->notNull()->default(1);
            }
    
            if (!Schema::hasColumn('user', 'fakultas_id')) {
                $table->bigInteger('fakultas_id')->unsigned()->notNull();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            // Kembalikan perubahan jika rollback
            $table->dropColumn(['jurusan', 'semester', 'fakultas_id']); // Hapus kolom baru
        });
    }
};
