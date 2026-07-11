<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('notifications_apprenant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apprenant_id')->nullable()->constrained('apprenants')->cascadeOnDelete();
            $table->foreignId('course_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('titre');
            $table->text('message');
            $table->enum('type', ['info','alerte','annonce'])->default('info');
            $table->boolean('lu')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('notifications_apprenant'); }
};
