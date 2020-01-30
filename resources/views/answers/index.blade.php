@extends('layouts.app')

@section('content')
    <table class="table table-striped table-bordered">
        <tr>
            <td>GambleID</td>
            <td>Answer</td>
            <td></td>
        </tr>
        @foreach($answers as $answer)
            <tr>
                <td>{!! $answer->gamble_id !!}</td>
                <td>{!! $answer->content !!}</td>
                <td>
                    {!! Form::open(['route' => ['answer.destroy', $answer->id], 'method' => 'delete']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
@endsection