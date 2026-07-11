<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discipline_id')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->constrained()->cascadeOnDelete();
            $table->string('titre');
            $table->enum('type', ['controle','devoir','examen'])->default('controle');
            $table->date('date_evaluation');
            $table->decimal('coefficient', 4, 1)->default(1);
            $table->decimal('bareme', 5, 2)->default(20);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('evaluations'); }
};
