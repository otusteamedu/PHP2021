<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePolisViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
        create view polis_views as
         SELECT po.id,
           po.patient_id,
           p.name as patient_name, 
           p.birthday,
           po.insurance_id,
           i.name as insurance_name,
           po.number,
           po.startDate,
           po.endDate,
           po.avans,
           po.program_id,
           pr.name as program_name,
           po.description,
           po.created_at,
           po.updated_at
           
    from polis po
        join patients p on po.patient_id = p.id
        join insurances i on po.insurance_id = i.id
        left join programs pr on po.program_id = pr.id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW polis_views");
    }
}
