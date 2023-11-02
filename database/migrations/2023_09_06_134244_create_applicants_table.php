<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('nik');
            $table->string('email');
            $table->bigInteger('telephone');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->boolean('is_married');
            $table->string('gender');
            $table->text('address');
            $table->string('education');
            $table->string('school');
            $table->string('faculty')->nullable();
            $table->string('major')->nullable();
            $table->string('experience');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
