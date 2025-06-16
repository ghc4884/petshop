<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('breeds', function (Blueprint $table) {
            $table->id();
            $table->string('api_id')->unique();
            $table->string('name');
            $table->string('temperament')->nullable();
            $table->string('origin')->nullable();
            $table->string('bred_for')->nullable();
            $table->string('breed_group')->nullable();
            $table->string('life_span')->nullable();
            $table->string('weight_imperial')->nullable();
            $table->string('weight_metric')->nullable();
            $table->string('height_imperial')->nullable();
            $table->string('height_metric')->nullable();
            $table->string('reference_image_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('breeds');
    }

};
