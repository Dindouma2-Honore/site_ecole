<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registration_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['acte_naissance','bulletin','photo','certificat_medical']);
            $table->string('file_path');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('registration_documents'); }
};
