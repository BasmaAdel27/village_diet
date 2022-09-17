<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Coupon;


class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->timestamp('activate_date');
            $table->timestamp('end_date')->nullable();
            $table->decimal('amount');
            $table->integer('max_used');
            $table->enum('coupon_type',Coupon::COUPON_TYPES);
            $table->integer('used_times')->default(0);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
