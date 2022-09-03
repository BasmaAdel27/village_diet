<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

        Schema::create('faq_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('question');
            $table->text('answer')->nullable();

            $table->unique(['faq_id', 'locale']);
            $table->foreignId('faq_id')->constrained('faqs')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('faq_translations');
        Schema::dropIfExists('faqs');
    }
}
