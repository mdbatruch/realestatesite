<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('description', 512);
            $table->decimal('price');
            $table->string('image');
            $table->string('propertyType', 128);
            $table->bigInteger('neighbourhood')->nullable()->unsigned();
            $table->foreign('neighbourhood')
            ->references('id')
            ->on('Neighbourhoods')
            ->onDelete('cascade');
            $table->timestamps();
        });

        // Schema::table('houses', function(Blueprint $table) {
        //     $table->string('building_type', 128);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
