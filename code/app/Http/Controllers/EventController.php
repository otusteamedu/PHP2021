<?php

namespace App\Http\Controllers;

use App\Interfaces\NoSqlRepositoryInterface;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private $noSqlRepository;

    public function __construct(NoSqlRepositoryInterface $noSqlRepository)
    {
        $this->noSqlRepository = $noSqlRepository;
    }

    public function findByCondition(Request $request)
    {
        return $this->noSqlRepository->findByCondition($request->all());
    }
}
