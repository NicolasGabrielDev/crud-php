@extends('welcome')

@section('content')
    <h4>Produtos</h4>
    <table class="table table-bordered table-sm table-hover table-stripped m-2">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>UN</th>
                <th>Valor</th>
                <th>Estoque?</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produtos as $produto)
               <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->descricao }}</td>
                    <td>{{ $produto->unidade }}</td>
                    <td>{{ $produto->valor }}</td>
                    <td>{{ $produto->estoque }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm">
                            Editar
                        </a>

                        <a class="btn btn-danger btn-sm">
                            Excluir
                        </a>
                    </td>
                </tr> 
            @empty
                <tr>
                    <td colspan="6">
                        Nenhum produto cadastrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection