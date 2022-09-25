<?php

use App\Models\ContactUs;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactUsTable extends Migration
{
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->string('fullname')->nullable();
            $table->enum('user_type', ContactUs::USER_TYPES);
            $table->string('eamil')->nullable();
            $table->enum('message_type', ContactUs::MESSAGE_TYPES);
            $table->text('content');
            $table->string('phone')->nullable();
            $table->string('whatsapp_phone')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
}
