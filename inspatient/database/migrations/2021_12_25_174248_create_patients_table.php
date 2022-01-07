<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('ФИО пациента');
            $table->date('birthday')->nullable()->comment('Дата рождения');
            $table->string('phone')->nullable()->comment('Номер телефона');
            $table->string('email', 50)->unique()->nullable();
            $table->string('address')->nullable()->comment('Адрес проживания');
            $table->string('work',100)->nullable()->comment('Место работы');
            $table->unsignedBigInteger('filial_id')->nullable()->unsigned()->comment('Домашний филиал');
            $table->foreign('filial_id')->references('id')->on('filials')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->string('aboutAdding')->nullable()->comment('Информация о добавлении в базу');
            $table->string('aboutRemove')->nullable()->comment('Информация о снятии с обслуживания');
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
        Schema::dropIfExists('patients');
    }
}
