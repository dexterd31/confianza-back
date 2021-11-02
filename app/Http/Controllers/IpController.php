<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ip;
use App\Http\Controllers\FuncionesController;
use App\Http\Requests\IpRequest;
use DB;

class IpController extends Controller
{

  public function autorizacion() {
    $funciones = new FuncionesController();
    $array = $funciones->ip();
    $ip    = $array['ip'];
    $host  = $array['host'];
    $ips   = $this->ips($ip);

    $data = array('ip'=>$ip, 'host'=>$host, 'oficinas'=>$ips);
    return $data;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
      //
  }

  public function oficinas($oficina_id) {
      $data = Ip::with('user', 'oficina', 'estado')->oficina($oficina_id)->estado(1)->get();
      return $data;
  }

  public function ips($ip) {
    $data = Ip::with('user', 'oficina', 'oficina.ciudad', 'oficina.ciudad.departamento', 'estado')->ip($ip)->estado(1)->get();
    return $data;
}

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  private function validarKey($user_id, $keyform)  {
    $funciones = new FuncionesController();
    $fecha     = $funciones->fecha();
    $data      = Ip::validarkey($fecha, $user_id, $keyform)->first();
    return $data;
  }

  public function store(IpRequest $request) {
      $form    = $request->form;
      $keyform = $form['keyform'];
      $user_id = $form['user_id'];

      DB::beginTransaction();
      try {
          $data = $this->validarKey($user_id, $keyform);
          if($data==null) {
              $data = $this->nuevo($form);
          }
          DB::commit();
      } catch (Exception $e) {
          $data    = null;
          DB::rollback();
      }
      return $data;
  }

  private function nuevo($form) {
    $data =  Ip::create($form);
    return $data;
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $data = Ip::id($id)->update(['estado_id'=>2]);
  }
}
