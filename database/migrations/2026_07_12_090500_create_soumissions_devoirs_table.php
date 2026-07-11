<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('soumissions_devoirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('devoir_id')->constrained()->cascadeOnDelete();
            $table->foreignId('apprenant_id')->constrained()->cascadeOnDelete();
            $table->string('fichier_joint');
            $table->text('commentaire')->nullable();
            $table->dateTime('date_soumission');
            $table->enum('statut', ['soumis','en_retard','note'])->default('soumis');
            $table->decimal('note', 5, 2)->nullable();
            $table->timestamps();
            $table->unique(['devoir_id', 'apprenant_id']);
        });
    }
    public function down(): void { Schema::dropIfExists('soumissions_devoirs'); }
};
