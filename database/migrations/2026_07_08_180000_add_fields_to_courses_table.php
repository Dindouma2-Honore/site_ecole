<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->text('pedagogical_content')->nullable()->after('description');
            $table->text('admission_conditions')->nullable()->after('pedagogical_content');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['pedagogical_content', 'admission_conditions']);
        });
    }
};
