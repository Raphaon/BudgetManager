<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('postbudgetaire', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numCompte')->unique();
            $table->string('intitulePost')->nullable();
            $table->boolean('isDelete')->default(false);
            $table->timestamps();
        });

        Schema::create('prevision', function (Blueprint $table) {
            $table->bigIncrements('idPrevision');
            $table->string('codePostBudgetaire');
            $table->string('exercicePrevi');
            $table->decimal('montantPrevision', 15, 2);
            $table->boolean('isDelete')->default(false);
            $table->timestamps();

            $table->foreign('codePostBudgetaire')->references('numCompte')->on('postbudgetaire');
        });

        Schema::create('realisation', function (Blueprint $table) {
            $table->bigIncrements('refferenceRea');
            $table->decimal('montantRea', 15, 2);
            $table->date('dateRea');
            $table->text('observationRea')->nullable();
            $table->unsignedBigInteger('codePrevision');
            $table->boolean('isDelete')->default(false);
            $table->string('autorise_par')->nullable();
            $table->string('effectuer_par')->nullable();
            $table->timestamps();

            $table->foreign('codePrevision')->references('idPrevision')->on('prevision');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('realisation');
        Schema::dropIfExists('prevision');
        Schema::dropIfExists('postbudgetaire');
    }
};
