{{ Form::open([
    'url' => $url,
    'method' => 'POST'
]) }}
    {{ Form::text('books_id',$bookstore->getId(),['class' => 'hidden'])}}
    <div class="form-group">
        {{ Form::text('books_name',$bookstore->getName(),['placeholder' => 'Name']) }}
    </div>

    <h3>Address</h3>

    {{ Form::textarea('books_address',$bookstore->getAddress(),
        [
            'placeholder' => 'Address',
            'style' => 'overflow:hidden;resize:none'
        ]) }}

    <div class="form-group">
        {{ Form::submit('Send',['class'=>'btn btn-primary']) }}
        {{ Form::reset('Clean',['class'=>'btn btn-danger']) }}
    </div>

{{ Form::close() }}