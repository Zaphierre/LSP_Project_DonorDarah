<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->decimal('biaya', 12, 2)->nullable()->default(0)->after('kuota');
            $table->string('gambar')->nullable()->after('biaya');
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropColumn(['biaya', 'gambar']);
        });
    }
};
