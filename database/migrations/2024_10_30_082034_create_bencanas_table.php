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
        Schema::create('bencanas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lokasi_id');
            $table->string('nama_bencana');
            $table->date('tanggal');
            $table->text('penyebab');
            $table->text('keterangan');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamp('created_at')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->enum('is_deleted', ['1', '0'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bencanas');
    }
};
