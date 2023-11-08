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
        Schema::table('attendance_time_configs', function (Blueprint $table) {
            $table->unsignedBigInteger('attendance_type_id')->after('id');
            $table->foreign('attendance_type_id')->references('id')->on('attendance_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance_time_configs', function (Blueprint $table) {
            $table->dropForeign(['attendance_type_id']);
            $table->dropColumn('attendance_type_id');
        });
    }
};
