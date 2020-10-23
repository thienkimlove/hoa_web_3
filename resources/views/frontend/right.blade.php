<div class="right-content pr">
    @if ($rightVideos = \App\Helpers::getRightVideos())
    <div class="box-video">
        <h3 class="global-title">
            <a href="{{ url('video') }}">Góc video</a>
        </h3>
        <div class="box-bd">
            @if ($firstVideos = $rightVideos->shift())
            <div class="data">
                {!! \App\Helpers::getEmberCodeYoutube($firstVideos->link, '100%', 250) !!}
                <h3>
                    {{ $firstVideos->name }}
                </h3>
            </div>
            @endif
            @if ($rightVideos->count() > 0)
               @foreach ($rightVideos as $rightVideo)
                    <div class="item cf item-r">
                        <h3>
                            <a href="{{ url('video/'.$rightVideo->slug) }}">{{ $rightVideo->name }}</a>
                        </h3>
                    </div>
               @endforeach
            @endif
        </div>
    </div>
    @endif

</div>