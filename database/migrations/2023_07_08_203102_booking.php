<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Booking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { {
            Schema::create('bookings', function (Blueprint $table) {
                $table->id();
                $table->string('b_type');
                $table->string('b_pickup');
                $table->string('b_dropoff');
                $table->string('b_timw');
                $table->string('b_duration');
                $table->string('b_luggage');
                $table->string('b_passenger');
                $table->string('ride_id');
                $table->string('c_name');
                $table->string('c_email');
                $table->string('c_phone');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
