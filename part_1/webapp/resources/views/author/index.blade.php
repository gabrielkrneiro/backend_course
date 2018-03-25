@extends('index')

@section('conteudo')

    <style>
        table,
        thead,
        tr,
        th,
        tbody,
        td,
        .main-div{
            margin: 0 auto;
            width: 80em;
        }
    </style>

    <h1 class="text-center">Authors</h1>

    <div class="main-div">

        <a class="btn btn-success" href="/author/insert">New Author</a>
        <table class="table table-responsive">
            <thead>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col"></th>
            </thead>
            <tbody>
            @foreach($dataProvider as $author)

                    <tr scope="row">
                            <td>
                                {{ $author->getId() }}
                            </td>
                            <td>
                                <a href="/author/details/{{ (isset($author))?$author->getId():'' }}">{{ $author->getName() }} </a>
                            </td>

                        <td>
                            <a class="btn btn-primary" href="/author/update/{{ $author->getId() }}"> Update </a>
                            <a class="btn btn-danger" href="/author/remove/{{ $author->getId()  }}" > Remove </a>
                        </td>
                    </tr>

            @endforeach
            </tbody>
        </table>
    </div>

@stop()