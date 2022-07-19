@extends('welcome')

@section('content')
    <form method="POST" action="{{ route('produtos.update', $produto->id) }}">
        @csrf
        @method('PUT')
        @include('produtos.form')
    </form>
@endsection