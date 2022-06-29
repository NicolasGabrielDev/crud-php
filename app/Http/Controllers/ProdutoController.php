<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    public function index() {
        $produtos = Produto::orderBy('descricao', 'asc')->get();

        if($produtos->count() == 0)
            return response()->json(['message' => 'Nenhum produto cadastrado até o momento.'], 404);
        return response()->json($produtos);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'descricao' => 'string|required|max:60',
            'unidade' => 'string|required|size:2',
            'valor' => 'numeric|required',
            'estoque' => 'boolean'
        ]);

        if($validator->fails())
            return response()->json(['message' => 'Preencha os campos corretamente para continuar.'], 422);

        $duplicidade = Produto::where(DB::raw("lower(descricao)"), '=', mb_strtolower($request->descricao))->first();
        if(isset($duplicidade))
            return response()->json(['message' => 'Já existe um produto cadastrado para a descrição informada'], 400);

        $validated = $validator->validated();
        $validated['descricao'] = trim($validated['descricao']);

        $produto = Produto::create($validated);
        if(isset($produto))
            return response()->json(['message' => 'Produto cadastrado com sucesso.'], 201);
        return response()->json(['message' => 'Não foi possível cadastrar o produto. Tente novamente!'], 500);
    }

    public function item($id) {
        $produto = Produto::find($id);
        if(!isset($produto))
            return response()->json(['message' => 'Nenhum produto encontrado para o ID informado.'], 404);
        return response()->json($produto);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'descricao' => 'string|required|max:60',
            'unidade' => 'string|required|size:2',
            'valor' => 'numeric|required',
            'estoque' => 'boolean'
        ]);

        if($validator->fails())
            return response()->json(['message' => 'Preencha os campos corretamente para continuar.'], 422);

        $produto = Produto::find($id);
        if(!isset($produto))
            return response()->json(['message' => 'Nenhum produto encontrado para o ID informado.'], 404);

        $duplicidade = Produto::where('id', '!=', $id)->where(DB::raw("LOWER(descricao)"), '=', mb_strtolower($request->descricao))->first();
        if(isset($duplicidade))
            return response()->json(['message' => 'Já existe um produto cadastrado para a descrição informada.'], 400);

        $validated = $validator->validated();
        if($produto->update($validated))
            return response()->json(['message' => 'O produto foi atualizado com sucesso.'], 202);
        return response()->json(['message' => 'Não foi possível atualizar o produto. Tente novamente!'], 500);
    }

    public function delete($id) {
        $produto = Produto::find($id);
        if(!isset($produto))
            return response()->json(['message' => 'Nenhum produto encontrado para o ID informado.'], 404);

        if($produto->delete())
            return response()->json(['message' => 'O produto foi excluído com sucesso.'], 200);
        return response()->json(['message' => 'Não foi possível excluir o produto.'], 500);
    }
}
