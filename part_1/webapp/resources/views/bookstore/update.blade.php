@extends('index')

@section('conteudo')
    <div class="text-center">
        <h1> Updating bookstore </h1>
        @include('bookstore._form',[
            'url' => '/bookstore/updateBookstore',
            'bookstore' => $bookstore
        ])
    </div>
@stop