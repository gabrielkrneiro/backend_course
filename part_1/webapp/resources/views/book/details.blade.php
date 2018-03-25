@extends('index')

@section('conteudo')

    <div class="text-center">
        @if(get_class($book) == get_class(new Error()))
            <h1>
                This book there`s not exists
            </h1>
        @else
            <h1>
                {{$book->getTitle()}}
            </h1>
            <p>Author: {{ $book->getAuthor()->getName() }}</p>
            <p>Bookstore: {{ $book->getBookstore()->getName() }}</p>
        @endif
    </div>

@stop