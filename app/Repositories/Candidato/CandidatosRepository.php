<?php

namespace App\Repositories\Candidato;

use App\Models\Candidato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CandidatosRepository
{
    public function getAll() 
    {
        return Candidato::all();
    }

    public function getByOwner($user_id) 
    {
        return Candidato::where('owner', $user_id)->get();
    }

    public function create($data){
        return Candidato::create($data);
    }

    public function update(Candidato $candidato, $data){
        return $candidato->update($data);
    }

    public function delete(Candidato $candidato){
        return $candidato->delete();
    }
}