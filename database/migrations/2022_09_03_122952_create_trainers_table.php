<?php

use App\Models\Trainer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainersTable extends Migration
{
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->id();
            $table->text('bio')->nullable();
            $table->string('current_job')->nullable();
            $table->string('body_shape');
            $table->boolean('is_certified');
            $table->text('join_request_reason');
            $table->enum('statue', Trainer::STATUSES);
            $table->boolean('show_inPage')->default(false);

            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainers');
    }
}
