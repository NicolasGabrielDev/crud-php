<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoBladeController extends Controller
{
    public function index() {
        $produtos = Produto::orderBy('id', 'asc')->get();

        foreach($produtos as $produto) {
            $produto->valor = number_format($produto->valor, 2, ',', '.');
            $produto->estoque = $produto->estoque == true ? "Estocável" : "Não estocável";
        }

        return view('produtos.index', compact('produtos'));
    }

    public function store(Request $request) {

    }

    public function edit($id) {
        
    }

    public function update(Request $request, $id) {

    }

    public function delete($id) {
        
    }
}
