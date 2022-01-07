<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Название страховой компании');
            $table->string('address')->nullable()->comment('Адрес страховой компании');
            $table->string('phone')->nullable()->comment('Телефон страховой компании');
            $table->string('email')->unique()->nullable();
            $table->boolean('isHidden')->default(false)->comment('Видимость');
            $table->string('description')->nullable()->comment('Коментарий');
            $table->string('parseClass')->nullable()->comment('Имя класса для парсинга списков');
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
        Schema::dropIfExists('insurances');
    }
}
