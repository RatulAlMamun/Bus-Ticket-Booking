<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bus_id');
            $table->string('dateofjourney');
            $table->string('busroute');
            $table->string('arrivalplace');
            $table->string('leavingplace');
            $table->string('selectedseat');
            $table->string('totalprice');
            $table->string('name');
            $table->string('phoneno');
            $table->string('email');
            $table->text('address');
            $table->string('transaction_id');
            $table->string('account_no');
            $table->string('payment_amount');
            $table->string('payment_type');
            $table->integer('payment_status');
            $table->integer('notification');
            $table->integer('booking_status');
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
        Schema::dropIfExists('bookings');
    }
}
