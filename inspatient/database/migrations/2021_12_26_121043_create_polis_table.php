<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePolisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id')->comment('Ссылка на пациента');
            $table->foreign('patient_id')->references('id')->on('patients')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('insurance_id')->unsigned()->comment('Ссылка на страховую компанию');
            $table->foreign('insurance_id')->references('id')->on('insurances')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->string('number')->comment('Номер полиса');
            $table->date('startDate')->nullable()->comment('Дата начала действия полиса');
            $table->date('endDate')->nullable()->comment('Дата оканчания действия полиса');
            $table->boolean('avans')->comment('Тип обслуживания');
            $table->unsignedBigInteger('program_id')->unsigned()->nullable()->comment('Страховая программа');
            $table->foreign('program_id')->references('id')->on('programs')
                ->onDelete('restrict')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('polis');
    }
}
