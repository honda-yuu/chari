<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('opening_time', 50);
            $table->string('per_hour_fee', 200);
            $table->string('address', 50);
            $table->string('link', 100);
            $table->string('phone_number');
            $table->string('capacity', 100);
            $table->string('bicycle',5);
            $table->string('bike_under_125cc', 5);
            $table->string('bike_more_125cc', 5);
            $table->string('receipt', 30);
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facilities');
    }
};
