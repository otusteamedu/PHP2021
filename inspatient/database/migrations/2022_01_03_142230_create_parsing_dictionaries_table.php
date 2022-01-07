<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParsingDictionariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('parsing_dictionaries', function (Blueprint $table) {
//            $table->string('value', 100)->primary()->comment('Значение параметра');
//            $table->string('key', 36)->comment('Ключ параметра');
//            $table->string('part', 36)->comment('Раздел параметра');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('parsing_dictionaries');
    }
}
