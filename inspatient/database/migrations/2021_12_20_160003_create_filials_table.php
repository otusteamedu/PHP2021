<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filials', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Название филиала');
            $table->string('address')->nullable()->comment('Адрес филиала');
            $table->string('phone')->nullable()->comment('Телефон филиала');
            $table->string('email')->nullable()->comment('Email филиала');
            $table->boolean('isHidden')->default(false)->comment('Видимость');
            $table->string('description')->nullable()->comment('Коментарий');
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
        Schema::dropIfExists('filials');
    }
}
