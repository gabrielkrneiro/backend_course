@extends('index')

@section('conteudo')
    <h2 class="text-center">Insert Book</h2>

    <div class="text-center">
        @include('book._form',['authors' => $authors])
    </div>
@stop