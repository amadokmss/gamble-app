<ul class="list-unstyled">
    @foreach ($gambles as $gamble)
        @if ($gamble->deadline > $now)
            <li class="media mb-3">
                <img class="mr-2 rounded" src="{{ Gravatar::src($gamble->user->email, 50) }}" alt="">
                <div class="media-body">
                    <div>
                        {!! link_to_route('gamble.show',$gamble->title, ['id' => $gamble->id]) !!} <span class="text-muted">posted at {{ $gamble->created_at }}</span>
                    </div>
                    <div>
                        <p class="mb-0">{!! nl2br(e($gamble->content)) !!}</p>
                        <p class="mb-0">{!! nl2br(e($gamble->deadline)) !!}</p>
                        <p class="mb-0">{!! $gamble->people !!}</p>
                    </div>
                </div>
            </li>
        @endif
    @endforeach
</ul>
{{ $gambles->links('pagination::bootstrap-4') }}

<div>
    {!! link_to_route('gamble.create',"New Gamble",[]) !!}
</div>