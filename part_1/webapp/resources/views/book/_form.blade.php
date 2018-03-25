<?php
$authors_array = [];
foreach($authors as $author)
{
    $authors_array[$author->getId()] = $author->getName();
}

$bookstores_array = [];
foreach($bookstores as $obj)
{
    $bookstores_array[$obj->getId()] = $obj->getName();
}
?>
{{ Form::open(array('url' => isset($book)?'book/updateBook':'book/addBook', 'method' => 'POST')) }}

    {{ Form::text('boo_id', (isset($book))?$book->getId():"",['class' => 'hidden']) }}
    <div class="form-group">
        {{ Form::label('boo_title', 'Title') }}
        {{ Form::text('boo_title',(isset($book))?$book->getTitle() :'') }}
    </div>

    <div class="form-group">
        {{ Form::label('boo_author', 'Author') }}
        {{ Form::select('boo_author', $authors_array,(isset($book))?$book->getAuthor()->getId():'') }}
    </div>

    <div class="form-group">
        {{ Form::label('boo_bookstore', 'Bookstore') }}
        {{ Form::select('boo_bookstore',$bookstores_array,(isset($book))?$book->getBookstore()->getId():'') }}
    </div>

    {{ Form::submit('Save',['class' => 'btn btn-primary']) }}
    {{ Form::reset('Clean',['class' => 'btn btn-danger']) }}

{{ Form::close() }}
