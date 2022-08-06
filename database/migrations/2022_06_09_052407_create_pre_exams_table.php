<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_exams', function (Blueprint $table) {
            $table->id();
            $table->decimal('hemoglobin_gDl',5,2);
            $table->decimal('temperature_F', 5, 2);
            $table->string('blood_pressure', 8);
            $table->integer('pulse_rate_BPM');
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
        Schema::dropIfExists('pre_exams');
    }
}
