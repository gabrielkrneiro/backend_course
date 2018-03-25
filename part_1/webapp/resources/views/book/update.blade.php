@extends('index')

@section('conteudo')
    <h1 class="text-center">Update Book</h1>

    <div class="text-center">
        @include('book._form',[
            'authors' => $authors,
            'book' => $book,
            'bookstore' => $bookstores
        ])
    </div>

@stop