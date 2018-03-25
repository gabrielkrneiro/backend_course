@extends('index')

@section('conteudo')

    <h2 class="text-center">
        @if(isset($author))
            {{ 'Updating' }}
        @else
            {{ 'Adding' }}
        @endif
    </h2>



    <br>
    <div class="text-center" id="author-form">
        <form action="{{  (isset($author))?'/author/updateAuthor':'/author/addAuthor'  }}" method="post">
            <input type="hidden" name="_token" value=" {{ csrf_token() }} ">
            <input type="hidden" name="author_id" id="author_id" value="{{ (isset($author)) ? $author->getId() : ''}}">
            <div class="form-group">
                <label for="author_name">Name</label>
                <input type="text" name="author_name" id="author_name" value="{{ (isset($author)) ? $author->getName() : ''}}" required>
            </div>
            <button class="btn btn-primary">Save</button>
            <button type="reset" class="btn btn-danger">Clean</button>
        </form>
    </div>
@stop