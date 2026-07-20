<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->cascadeOnDelete();
            $table->string('title');
            $table->string('file_path')->nullable();
            $table->enum('type', ['pdf','video','lien'])->default('pdf');
            $table->string('link_url')->nullable();
            $table->date('published_at');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('resources'); }
};
