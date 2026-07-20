<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('cycle', ['maternelle','primaire','secondaire','international'])->default('primaire');
            $table->string('level')->nullable();
            $table->foreignId('academic_year_id')->nullable()->constrained()->nullOnDelete();
            $table->integer('capacity')->default(30);
            $table->text('description')->nullable();
            $table->text('pedagogical_content')->nullable();
            $table->text('admission_conditions')->nullable();
            $table->decimal('fee', 10, 2)->default(0);
            $table->boolean('active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('school_classes'); }
};
