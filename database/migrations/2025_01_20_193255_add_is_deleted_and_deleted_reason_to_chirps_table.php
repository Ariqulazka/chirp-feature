<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDeletedAndDeletedReasonToChirpsTable extends Migration
{
    public function up()
    {
        Schema::table('chirps', function (Blueprint $table) {
            $table->boolean('is_deleted')->default(false); // Menandai jika chirp dihapus
            $table->string('deleted_reason')->nullable();  // Alasan penghapusan
        });
    }

    public function down()
    {
        Schema::table('chirps', function (Blueprint $table) {
            $table->dropColumn('is_deleted');
            $table->dropColumn('deleted_reason');
        });
    }
};
