<?php

use App\Models\EmailSubscriber;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailSubscribersTable extends Migration
{
    public function up()
    {
        Schema::create('email_subscribers', function (Blueprint $table) {
            $table->id();
            $table->enum('template', EmailSubscriber::TEMPLATES)->comment('change it according to templates system');
            $table->string('email_title');
            $table->text('content');

            $table->foreignId('subscriber_id')->nullable()->constrained('subscribers')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_subscribers');
    }
}
