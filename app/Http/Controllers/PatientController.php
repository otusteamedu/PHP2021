<?php

namespace App\Http\Controllers;

use App\Services\Repositories\EloquentPatientRepository;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private EloquentPatientRepository $eq;

    public function __construct(EloquentPatientRepository $eq){
        $this->eq = $eq;
    }

    public function __invoke()
    {
        $patients = $this->eq->getAll();

        return view('welcome', ['patients' => $patients]);

    }


}
