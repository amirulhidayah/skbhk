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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->longText('nik');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('pendidikan');
            $table->string('jabatan');
            $table->foreignId('master_branch_regulars_id')->nullable()->constrained('master_branch_regulars');
            $table->string('no_surat');
            $table->date('tgl_awal_hubker');
            $table->date('tgl_akhir_hubker')->nullable();
            $table->string('jenis_pkwt')->nullable();
            $table->string('no_pkwt')->nullable();
            $table->date('tgl_pkwt')->nullable();
            $table->foreignId('master_branch_franchises_id')->nullable()->constrained('master_branch_franchises');
            $table->foreignId('toko_id')->nullable()->constrained('toko');
            $table->softDeletes();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
