@extends('welcome')

@section('content')
<form method="POST" action="{{ route('produtos.store') }}">
    @csrf
    @include('produtos.form')
</form>
@endsection