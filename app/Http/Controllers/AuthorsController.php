<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Author;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;


class AuthorsController extends Controller
{
    use ApiResponser;

    public function __construct()
    {
        //
    }

    // funcion para consultar la lista de usuarios

public function index()
    {
        $authors = Author::all();
        return $this->successResponse($authors);
    }

// funcion para consultar por id

    public function store(Request $request)
    {
        $this->validate($request, [

            'name' => 'required',
            'gender' => 'required|in:male, female',
            'country' => 'required',
        ]);
        $authors = Author::create($request->all());
        return $this->successResponse($authors, Response::HTTP_CREATED);
    }

// funcion para mostrar un registro en especifico

    public function show($id)
    {

        $authors = Author::findOrFail($id);
        return $this->successResponse($authors);
    }

    // funcion para modificar un  registro
    public function update(Request $request, $id)
    {

        $this->validate($request, [

            'name' => 'max:255',
            'gender' => 'in:male, female',
            'country' => 'max:255'
        ]);

        $authors = Author::findOrFail($id);
        $authors->fill($request->all());
        // creamos una condicional para saber si el autor cambio 
        if ($authors->isClean()) {
            return $this->errorResponse('al menos un valor debe cambiar', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $authors->save();
        return $this->successResponse($authors, Response::HTTP_OK);
    }
    public function destroy($id){

        $authors = Author::findOrFail($id);
        $authors->delete();
        return  $this->successResponse($authors);

    }
}
