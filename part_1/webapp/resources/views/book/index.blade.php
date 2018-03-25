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

    <h1 class="text-center">Books</h1>

    <div class="main-div">

        <a class="btn btn-success" href="/book/insert">New Book</a>
        <table class="table table-responsive">
            <thead>
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Bookstore</th>
            <th scope="col"></th>
            </thead>
            <tbody>
            @foreach($dataProvider as $book)
                <tr scope="row">
                    <td>
                        {{ $book->getId() }}
                    </td>
                    <td>
                        <a href="/book/details/{{ (isset($book))?$book->getId():'' }}">
                            {{ $book->getTitle() }}
                        </a>
                    </td>
                    <td>
                        <span >{{ $book->getAuthor()->getName() }} </span>
                    </td>
                    <td>
                        <span >{{ $book->getBookstore()->getName() }} </span>
                    </td>

                    <td>
                        <a class="btn btn-primary" href="/book/update/{{ $book->getId() }}"> Update </a>
                        <a class="btn btn-danger" href="/book/remove/{{ $book->getId()  }}" > Remove </a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

@stop