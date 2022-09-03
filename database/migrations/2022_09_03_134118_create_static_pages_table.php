<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticPagesTable extends Migration
{
    public function up()
    {
        Schema::create('static_pages', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active');
            $table->boolean('is_show_in_app');

            $table->timestamps();
        });

        Schema::create('static_page_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->string('title');
            $table->longText('content');

            $table->unique(['static_page_id', 'locale']);
            $table->foreignId('static_page_id')->constrained('static_pages')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('static_page_translations');
        Schema::dropIfExists('static_pages');
    }
}
