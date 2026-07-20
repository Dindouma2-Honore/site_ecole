<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('school_classes')->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('teacher_name')->nullable();
            $table->foreignId('teacher_id')->nullable()->constrained('ambassadors')->nullOnDelete();
            $table->text('description')->nullable();
            $table->string('color')->nullable();
            $table->decimal('coefficient', 4, 1)->default(1);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('courses'); }
};
