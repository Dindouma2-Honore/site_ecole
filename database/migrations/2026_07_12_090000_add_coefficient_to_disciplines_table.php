<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('disciplines', function (Blueprint $table) {
            $table->decimal('coefficient', 4, 1)->default(1);
        });
    }
    public function down(): void {
        Schema::table('disciplines', function (Blueprint $table) {
            $table->dropColumn('coefficient');
        });
    }
};
