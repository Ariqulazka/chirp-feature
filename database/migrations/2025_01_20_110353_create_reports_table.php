<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reporter_id'); // ID pelapor
            $table->unsignedBigInteger('reported_id'); // ID konten yang dilaporkan
            $table->string('reported_type'); // Jenis konten (chirp atau user)
            $table->text('reason'); // Alasan pelaporan
            $table->boolean('is_reviewed')->default(false); // Status ditinjau
            $table->timestamps();
    
            // Menambahkan foreign key jika diperlukan
            $table->foreign('reporter_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }

};
