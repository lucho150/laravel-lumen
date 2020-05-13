<?php
namespace App\Traits;
use Illuminate\Http\Response;

trait ApiResponser{

    // vamos a retornar respuestas de exito 
    // requisitos argumentos:
    // $data = informacion
    // $code = codigo de estado
    
    public function successResponse($data, $code = Response::HTTP_OK){
      
        // estandarizamos las respuestas para que nos retorne en tipo json asignandole la variable $data que es
        // donde se guardara la informacion d elabase de datos con un $code de estado 
        return response()->json(['$data' => $data], $code);

    }
    // vamos a retornar respuestas de error
    // requisitos argumentos:
    // $menssage = mensaje
    // $code=codigo de estado
    public function errorResponse($message, $code ){
        return response()->json(['error' => $message, 'code' => $code ], $code);

    }




}

?>