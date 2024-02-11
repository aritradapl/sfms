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
        Schema::table('amount_table', function (Blueprint $table) {
            $table->bigInteger('year_id')->unsigned()->default(0)->after('student_id');
            $table->foreign('year_id')->references('id')->on('year_master')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('amount_table', function (Blueprint $table) {
            $table->dropColumn('year_id');
        });
    }
};
