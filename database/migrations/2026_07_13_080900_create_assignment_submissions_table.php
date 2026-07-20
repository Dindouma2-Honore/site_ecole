<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('assignment_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assignment_id')->constrained()->cascadeOnDelete();
            $table->foreignId('learner_id')->constrained()->cascadeOnDelete();
            $table->string('file_path');
            $table->text('comment')->nullable();
            $table->dateTime('submitted_at');
            $table->enum('status', ['soumis','en_retard','note'])->default('soumis');
            $table->decimal('grade', 5, 2)->nullable();
            $table->timestamps();
            $table->unique(['assignment_id', 'learner_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('assignment_submissions'); }
};
