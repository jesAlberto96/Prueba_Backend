<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCandidatosRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ResponseController;
use App\Repositories\Candidato\CandidatosRepository;
use App\Models\Candidato;

class CandidatosController extends Controller
{
    private $response;

    public function __construct(){
        $this->response = new ResponseController;
        $this->candidatosRepository = new CandidatosRepository;
    }

    public function index()
    {
        $data = [];
        switch (true) {
            case (auth()->user()->hasPermissionTo('candidatos.access')): //Si tiene permiso, busco todos los candidatos
                $data = $this->candidatosRepository->getAll();
                break;               
            default: //Sino solo busca los candidatos que tiene asignados
                $data = $this->candidatosRepository->getByOwner(auth()->user()->id);
                break;
        }

        return $this->response->sendResponse(true, $data);
    }

    public function store(StoreCandidatosRequest $request)
    {
        try {
            return $this->response->sendResponse(true, $this->candidatosRepository->create($request->input()), [], 201);
        } catch (Exception $ex) {
            return $this->response->sendError(["Ocurrio un error inesperado al intentar procesar la solicitud"], 500);
        }
    }

    public function show(Candidato $candidato)
    {
        return $this->response->sendResponse(true, $candidato);
    }
}
