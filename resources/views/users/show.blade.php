@extends('layouts.app')

@section('content')
    @include('commons.error_messages')
    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                    <h5 class="text-right">{{ $user->point }}</h5>
                </div>
                <div class="card-body">
                    <img class="rounded img-fluid" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                </div>
                <div class="card-footer">
                    <h5>charge</h5>
                    {!! Form::open(['route' => 'user.charge']) !!}
                        <div class="form-group">
                            {!! Form::input('text','charge') !!}
                            {!! Form::submit('Charge', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </aside>
        <div class="col-sm-8">
            <h2>Participating gambles</h2>
            @foreach ($user->get_gambles as $gamble)
                <table class="table table-striped table-bordered">
                    <tr>
                        <td>Title</td>
                        <td class="text-center">@if ($gamble->deadline > $now) {!! link_to_route('gamble.show', nl2br(e($gamble->title)),['id'=>$gamble->id]) !!}@else {!! $gamble->title !!} @endif</td>
                    </tr>
                    <tr>
                        <td>Presentor</td>
                        <td class="text-center">{!! $gamble->user->name !!}</td>
                    </tr>
                    <tr>
                        <td>Your Answer</td>
                        <td class="text-center">@if($gamble->pivot->choice === 1) Yes @else No @endif</td>
                    </tr>
                    <tr>
                        <td>Participants</td>
                        <td class="text-center">{!! $gamble->people !!}</td>
                    </tr>
                    <tr>
                        <td>Odds</td>
                        <td class="text-center">{!! $odds[$loop->index] !!}</td>
                    </tr>
                    @if($gamble->pivot->check === 1)
                        <tr>
                            <td>result</td>
                            <td class="text-center">{!! $answers[$loop->index] !!}</td>
                        </tr>
                        <tr>
                            <td>Return</td>
                            <td class="text-center">{!! $gamble->pivot->return - $gamble->pivot->point !!}</td>
                        </tr>
                    @endif
                </table>
            @endforeach
            
        </div>
    </div>
@endsection