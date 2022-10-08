<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->string('template_name');
            $table->timestamps();
        });

        Schema::create('template_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('subject');
            $table->longText('content');

            $table->unique(['template_id', 'locale']);
            $table->foreignId('template_id')->constrained('templates')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('template_translations');
        Schema::dropIfExists('templates');
    }
};
