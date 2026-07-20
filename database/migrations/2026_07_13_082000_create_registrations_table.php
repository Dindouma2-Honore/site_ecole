<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->enum('cycle_souhaite', ['maternelle','primaire','secondaire','international'])->nullable();
            $table->foreignId('class_souhaitee_id')->nullable()->constrained('school_classes')->nullOnDelete();
            $table->string('parent_name');
            $table->string('parent_email');
            $table->string('parent_phone');
            $table->text('address')->nullable();
            $table->string('previous_school')->nullable();
            $table->enum('status', ['nouvelle','en_examen','validee','liste_attente','rejetee'])->default('nouvelle');
            $table->text('admin_notes')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('registrations'); }
};
