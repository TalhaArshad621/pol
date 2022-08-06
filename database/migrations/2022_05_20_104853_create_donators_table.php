<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donators', function (Blueprint $table) {
            $table->id();
            $table->integer('app')->default(0);
            $table->string('name',255);
            $table->string('cnic',20);
            $table->string('address',255);
            $table->string('gender',10);
            $table->string('blood_type',10);
            $table->integer('age',10);
            $table->string('number',15);
            $table->integer('points')->default(0);
            $table->date('nextSafeDonationDate')->default(null);
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
        Schema::dropIfExists('donators');
    }
}
