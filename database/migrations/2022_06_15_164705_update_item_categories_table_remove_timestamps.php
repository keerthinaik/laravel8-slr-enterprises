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
        //removing timestamps columns
        Schema::table('item_categories', function (Blueprint $table){
           $table->dropTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //adding timestamps columns
        Schema::table('item_categories', function (Blueprint $table){
            $table->timestamps();
        });
    }
};
