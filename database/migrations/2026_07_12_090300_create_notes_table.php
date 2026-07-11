<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('apprenant_id')->constrained()->cascadeOnDelete();
            $table->decimal('valeur', 5, 2);
            $table->string('appreciation')->nullable();
            $table->timestamps();
            $table->unique(['evaluation_id', 'apprenant_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('notes'); }
};
