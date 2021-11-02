<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class FuncionesController extends Controller
{
    public function token() {
       // return bcrypt('123.');
        // return Hash::make('123.');
    }
  
    public function dia_festivo($pfecha) {
      $existe  = Festivo::fecha($pfecha)->estado(1)->first();
      $festivo = 0;
      if($existe!=null) {
        $festivo=1;
      }
      return $festivo;
    }

    public function solo_fecha($pfecha) {
			$fecha = date('Y-m-d', strtotime($pfecha));
      return $fecha;
    }

    public function encriptar($texto) {
        $resultado = "";
        if(trim($texto)!="")
          $resultado = Crypt::encryptString($texto);
        return $resultado;
    }

    public function desencriptar($texto) {
        $resultado = "";
        if(trim($texto)!="")
            $resultado = Crypt::decryptString($texto);
        return $resultado;
    }

    public  function generateRandomString() {
        $length=20;
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    public function encriptarUrl($string) {
        $key    = "SJpMctUGlJo0UBOOfTI6j0dWTwca3Hp8aQ6iSfAic";
        $result = '';
        $test   = "";
        
        for($i=0; $i<strlen($string); $i++) {
          $char        = substr($string, $i, 1);
          $keychar     = substr($key, ($i % strlen($key))-1, 1);
          $char        = chr(ord($char)+ord($keychar));
          $test[$char] = ord($char)+ord($keychar);
          $result.=$char;
        }
        return urlencode(base64_encode($result));
    }
    
    public function desencriptarUrl($string) {
        $key = "SJpMctUGlJo0UBOOfTI6j0dWTwca3Hp8aQ6iSfAic";
        $result = '';
        //$string = base64_decode(urldecode($string));
        $string = base64_decode($string);
        for($i=0; $i<strlen($string); $i++) {
          $char = substr($string, $i, 1);
          $keychar = substr($key, ($i % strlen($key))-1, 1);
          $char = chr(ord($char)-ord($keychar));
          $result.=$char;
        }
        return $result;
    }

    public function nuevo_password() {
        $string = Str::random(10);
        return $string;
    }

    public function limpiarCaracteresEspeciales($string) {
        $string = htmlentities($string);
        $string = preg_replace('/\&(.)[^;]*;/', '\\1', $string);
        return $string;
    }

    public function eliminar_simbolos($string) {
        $string = trim($string);
        $string = str_replace(array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),$string);
        $string = str_replace(array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),$string);
        $string = str_replace(array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),$string);
        $string = str_replace(array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),$string);
        $string = str_replace(array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),$string);
        $string = str_replace(array('ç', 'Ç'), array('c', 'C',), $string);
        $string = str_replace(array("\\", "¨", "º", "-", "~","|", "!", "\"","·","'", "¡","^", "<code>","+", "¨", "´","・"," "), ' ', $string);
        return $string;
    }

    public function fecha() {
        $fecha = date("Y-m-d") . " 00:00:00";
        return $fecha;
    }

    public function fecha_hora() {
      $fecha = date("Y-m-d H:i:s");
      return $fecha;
  }

    public function anio() {
            $fecha        = date('Y');
            return $fecha;
    }

    public function mes() {
            $fecha        = date('m');
            return $fecha;
    }

    public function dia() {
            $fecha        = date('d');
            return $fecha;
    }

    public function sumar_fecha_dias($pfecha,$pdias) {
        //$fecha = date('Y-m-d H:i:s', strtotime($pfecha));
        $fecha = $pfecha;
        $nuevafecha = strtotime ( '+' . $pdias . ' day' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );
        return $nuevafecha;
	  }

    public function sumar_fecha_horas($pfecha, $phoras) {
        //$fecha = date('Y-m-d H:i:s', strtotime($pfecha));
        $fecha = $pfecha;
        $nuevafecha = strtotime ( '+' . $phoras . ' hours' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );
        return $nuevafecha;
	  }

    public function sumar_fecha_minutos($pfecha, $phoras) {
        //$fecha = date('Y-m-d H:i:s', strtotime($pfecha));
        $fecha = $pfecha;
        $nuevafecha = strtotime ( '+' . $phoras . ' minutes' , strtotime ( $fecha ) ) ;
        $nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );
        return $nuevafecha;
  	}

    public function sumar_fecha_segundos($pfecha, $segundos) {
      //$fecha = date('Y-m-d H:i:s', strtotime($pfecha));
      $fecha = $pfecha;
      $nuevafecha = strtotime ( '+' . $segundos . ' second' , strtotime ( $fecha ) ) ;
      $nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );
      return $nuevafecha;
  }

  public function restar_fecha_segundos($pfecha, $segundos) {
    //$fecha = date('Y-m-d H:i:s', strtotime($pfecha));
    $fecha = $pfecha;
    $nuevafecha = strtotime ( '-' . $segundos . ' second' , strtotime ( $fecha ) ) ;
    $nuevafecha = date ( 'Y-m-d H:i:s' , $nuevafecha );
    return $nuevafecha;
}


  

    public function fecha_saber_si_domingo($pfecha) {
        $fecha = date('l', strtotime($pfecha));
        if($fecha == "Sunday")
                $domingo=1; // si es domingo
        else
                $domingo=0; // no es domingo

        return $domingo;
    }

    public function fecha_saber_si_sabado($pfecha) {
        $fecha = date('l', strtotime($pfecha));
        if($fecha == "Saturday")
                $sabado=1; // si es sabado
        else
                $sabado=0; //no es sabado

        return $sabado;
    }

    public function ultimo_dia_mes($panio,$mes) {
        return strftime("%d", mktime(0, 0, 0, $mes+1, 0, $panio));
    }

    public function fecha_desde($anio,$mes) {
        return $anio . "-" . $mes . "-01";
    }

    public function fecha_hasta($anio,$mes) {
        $dia     = $this->ultimo_dia_mes($anio,$mes);
        return $anio . "-" . $mes . "-" . $dia;
    }

    public function existe_file($pruta_original) {
        if (file_exists($pruta_original))
            return 1;
        else
            return 0;
    }

    public function eliminar_file($pruta_original) {
        unlink($pruta_original);
    }

    public function renombrar_file($pruta_original,$pruta_actual) {
        if (file_exists($pruta_original))
        {
            rename($pruta_original,$pruta_actual);
        }
    }
}
