@extends('index')

@section('conteudo')

<div class="text-center">
    @if(get_class($author) == get_class(new Error()))
        <h1>
            This Author there is not exists
        </h1>
    @else
        <h1>
            {{ $author->getName() }}
        </h1>
    @endif
</div>

@stop