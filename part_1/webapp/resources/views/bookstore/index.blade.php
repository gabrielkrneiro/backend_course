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

    <h1 class="text-center">Bookstore</h1>

    <div class="main-div">

        <a class="btn btn-success" href="/bookstore/insert">New Bookstore</a>
        <table class="table table-responsive">
            <thead>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col"></th>
            </thead>
            <tbody>
            @foreach($dataProvider as $bookstore)
                <tr scope="row">
                    <td>
                        {{ $bookstore->getId() }}
                    </td>
                    <td>
                        <a href="/bookstore/details/{{ (isset($bookstore))?$bookstore->getId():'' }}">
                            {{ $bookstore->getName() }}
                        </a>
                    </td>
                    <td>
                        <span >{{ $bookstore->getAddress() }} </span>
                    </td>

                    <td>
                        <a class="btn btn-primary" href="/bookstore/update/{{ $bookstore->getId() }}"> Update </a>
                        <a class="btn btn-danger" href="/bookstore/remove/{{ $bookstore->getId()  }}" > Remove </a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

@stop