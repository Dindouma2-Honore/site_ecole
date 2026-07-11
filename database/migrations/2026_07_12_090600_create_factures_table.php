<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apprenant_id')->constrained()->cascadeOnDelete();
            $table->string('reference')->unique();
            $table->string('libelle');
            $table->decimal('montant_total', 10, 2);
            $table->date('date_emission');
            $table->date('echeance');
            $table->enum('statut', ['payee','partielle','impayee'])->default('impayee');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('factures'); }
};
