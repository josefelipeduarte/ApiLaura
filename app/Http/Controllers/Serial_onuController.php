<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enum\StateEnum;
use App\Models\Serial;

use Illuminate\Http\Response;
use Illuminate\Validation\Rules\Enum;

class Serial_onuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registros = Serial::all();

        return $registros;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pesquisarSerial(Request $request, $serial)
    {
        // Busca o primeiro item onde o campo "serial_estoque" corresponde ao valor fornecido.
        $serialEnviado = Serial::where('serial_estoque', $serial)->get();
        // Retorno da resposta
        return response()->json($serialEnviado);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'tipo_onu_estoque' => 'required|string|max:255',
            'serial_estoque' => 'required|string|max:255',
            'motivo_entrega' => 'required|string|max:100',
            'desc_estoque' => 'required|string|max:255',
            'nome_responsavel' => 'required|string|max:255',
            'user' => 'nullable|string',
        ]);

        Serial::create($request->all());

        return response()->noContent(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Serial $serial
     * @return \Illuminate\Http\Response
     */

    //Função busca pelo ID de gravação.
    public function show(Serial $id_de)
    {
        return $id_de;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Serial $serial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Serial $serial)
    {
        $request->validate([
            'tipo_onu_estoque' => 'required|string|max:255',
            'motivo_entrega' => 'required|string|max:100',
            'desc_estoque' => 'required|string|max:255',
            'nome_responsavel' => 'required|string|max:255',
            'user' => 'nullable|string',
        ]);

        $serial->update($request->all());

        // ele retorna nada para o cliente, somente altera.
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Serial $serial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serial $serial)
    {
        $serial->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
