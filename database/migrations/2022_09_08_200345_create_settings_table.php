<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->decimal('net_subscription');
            $table->string('tax_name')->nullable();
            $table->decimal('tax_amount')->nullable();
            $table->enum('tax_type', Setting::TAX_TYPES)->nullable();
            $table->string('website_url')->nullable();
            $table->boolean('is_link_active')->default(true);
            $table->boolean('forced_android')->default(false);
            $table->boolean('forced_ios')->default(false);
            $table->boolean('optional_android')->default(true);
            $table->boolean('optional_ios')->default(true);
            $table->string('ios_version')->nullable();
            $table->string('android_version')->nullable();
            $table->boolean('web_maintenance')->default(false);
            $table->boolean('android_maintenance')->default(false);
            $table->boolean('ios_maintenance')->default(false);
            $table->string('logo')->nullable();
            $table->string('web_title')->nullable();
            $table->text('web_description')->nullable();
            $table->text('footer')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('instagram')->nullable();
            
            $table->string('whatsapp_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
