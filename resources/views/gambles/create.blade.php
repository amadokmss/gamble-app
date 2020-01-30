@extends('layouts.app')

@section('content')
    @include('commons.error_messages')
    <div class="col-sm-8">
        {!! Form::open(['route' => 'gamble.store']) !!}
            <div class="form-group">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>{!! Form::label("title","Title")!!}</td>
                        <td class="text-right">{!! Form::text('title',old('title'),['class'=>'form-control','rows'=>'2']) !!}</td>
                    </tr>
                    <tr>
                        <td>{!! Form::label("content","Content")!!}</td>
                        <td class="text-right">{!! Form::textarea('content',old('content'),['class'=>'form-control','rows'=>'2']) !!}</td>

                    </tr>
                    <tr>
                        <td>{!! Form::label("deadline","Deadline")!!}</td>
                        <td class="text-right">{!! Form::input('number','deadline') !!}</td>

                    </tr>
                    <tr>
                        <td>{!! Form::label("minimumpoint","MinimumPoint")!!}</td>
                        <td class="text-right">{!! Form::input('number','minpoint') !!}</td>
                    </tr>
                    
                </table>
                {!! Form::submit('Make Gamble', ['class' => 'btn btn-primary btn-block']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection