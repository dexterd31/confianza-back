<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gestion;
use App\Http\Requests\GestionRequest;

class GestionController extends Controller
{
    public function guardar(GestionRequest $request) {
        $form = $request->form;
        $tabla = Gestion::create($form);
        $data = Gestion::all();
        return $data;
    }
}
