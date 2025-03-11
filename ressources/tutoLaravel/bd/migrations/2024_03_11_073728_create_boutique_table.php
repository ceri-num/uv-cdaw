<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoutiqueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boutique', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom', 30);
            $table->string('description', 300)->nullable();
            $table->string('description_courte', 100)->nullable();
            $table->timestamps();

            // voir aussi default
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boutique');
    }
}
