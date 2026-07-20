<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('parent_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('users')->cascadeOnDelete();
            $table->string('subject');
            $table->text('message');
            $table->enum('status', ['nouvelle','en_cours','traitee'])->default('nouvelle');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('parent_requests'); }
};
