@extends('layouts.app')

@section('content')
    @include('commons.error_messages')
    <table class="table table-striped table-bordered">
        <tr>
            <td>Title</td>
            <td class="text-center">{{$gamble->title}}</td>
        </tr>
        <tr>
            <td>Content</td>
            <td class="text-center">{{$gamble->content}}</td>
        </tr>
        <tr>
            <td>DeadLine</td>
            <td class="text-center">{{$gamble->deadline}}</td>
        </tr>
        <tr>
            <td>MinimumPoint</td>
            <td class="text-center">{{$gamble->minpoint}}P</td>
        </tr>
        <tr>
            <td>Participants</td>
            <td class="text-center">{{$gamble->people}}</td>
        </tr>
    </table>
    
    <div class="col-sm-8">
        {!! Form::open(['route' => ['user_gamble.store', $gamble->id],'method'=>"post"]) !!}
            <div class="form-group">
                {!! Form::text('money',$gamble->minpoint,[]) !!}
                <br>
                <label>Yes</label>
                {!! Form::radio('res',"1", ['class' => 'form-control', 'rows' => '2']) !!}
                <label>No</label>
                {!! Form::radio('res',"2", ['class' => 'form-control', 'rows' => '2']) !!}
                {!! Form::submit('Decide', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    
    <div class="border-bottom"></div>
    <br>
    
    <div class="row">
        <aside class="col-sm-4">
            {!! Form::open(['route' => ['comment.store', $gamble->id],'method'=>"post"]) !!}
                <div class="form-group">
                    <label>Comment Here!</label>
                    {!! Form::text('content',old('content'),['class' => 'form-control', 'rows' => '2']) !!}
                    <br>
                    {!! Form::submit('Decide', ['class' => 'btn btn-primary btn-block']) !!}
                </div>
            {!! Form::close() !!}
        </aside>
        
        <div class="col-sm-8">
            @if($comments->count() > 0)
                @foreach ($comments as $comment)
                    <div class="card">
                            
                        <div class="card-body">
                            <h5>{{ $comment->content }}</h5>
                            <h6>{{ $comment->get_user()->name }}</h6>
                            <p>{{ $comment->created_at}}</p>
                            @if($comment->get_user()->id === Auth::user()->id)
                                {!! Form::open(['route' => ['comment.destroy', $comment->id],'method'=>"delete"]) !!}
                                    {!! Form::submit('Delete!!', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection