@extends('index')

@section('conteudo')
    <div class="text-center">
        <h1>Adding bookstore</h1>

        @include('bookstore._form',[
            'bookstore' => $bookstore,
            'url' => '/bookstore/addBookstore'
        ])
    </div>
@stop