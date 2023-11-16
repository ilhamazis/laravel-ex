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
            $table->text('photo');
            $table->string('name');
            $table->bigInteger('nik');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->boolean('is_married');
            $table->text('address');
            $table->string('email');
            $table->bigInteger('telephone');
            $table->string('education');
            $table->string('school');
            $table->string('faculty')->nullable();
            $table->string('major')->nullable();
            $table->string('experience');
            $table->text('linkedin_url')->nullable();
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
