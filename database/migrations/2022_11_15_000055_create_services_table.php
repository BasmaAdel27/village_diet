<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->integer('ordering');

            $table->timestamps();
        });


        Schema::create('service_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description')->nullable();

            $table->unique(['service_id', 'locale']);
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_translations');
        Schema::dropIfExists('services');
    }
};
