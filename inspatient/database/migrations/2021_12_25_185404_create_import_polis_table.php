<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportPolisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polis_imports', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('attach_id')->unsigned()->comment('Ссылка на файл');
            $table->foreign('attach_id')
                ->references('id')
                ->on('attachments')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('insurance_id')->unsigned()->comment('Ссылка на страховую компанию');
            $table->foreign('insurance_id')
                ->references('id')
                ->on('insurances')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->string('processing_status_code', 16)->nullable()->comment('Статус обработки');
            $table->foreign('processing_status_code')
                ->references('code')
                ->on('processing_statuses')
                ->onDelete('restrict')
                ->onUpdate('cascade');
            $table->dateTime('processing_date')->nullable()->comment('Дата обработки');
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
        Schema::dropIfExists('polis_imports');
    }
}
