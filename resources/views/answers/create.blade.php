@extends('layouts.app')

@section('content')
    @include('commons.error_messages')
    <div class="col-sm-8">
        {!! Form::open(['route' => 'answer.store']) !!}
            <div class="form-group">
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>{!! Form::label("id","id")!!}</td>
                        <td class="text-right">{!! Form::text('gamble_id','',['class'=>'form-control','rows'=>'2']) !!}</td>

                    </tr>
                    <tr>
                        <td>{!! Form::label("content","Content")!!}</td>
                        <td class="text-right">{!! Form::textarea('content',old('content'),['class'=>'form-control','rows'=>'2']) !!}</td>

                    </tr>
                </table>
                {!! Form::submit('Answer Check', ['class' => 'btn btn-primary btn-block']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <button class="btn" type="button">{!! link_to_route('answer.index','Index') !!}</button>
@endsection