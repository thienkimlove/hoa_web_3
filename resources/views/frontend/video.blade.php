@extends('frontend.layout')

@section('content')
    <section class="body pr">
        <div class="fixCen">
            <div class="groups">
                <div class="left-content">
                    <div class="steps">
                        <h2 class="rs">
                            <a href="{{ url('/') }}" title="Trang chủ">Trang chủ</a>
                        </h2>
                        <span>|</span>
                        <h3 class="rs"><a href="{{ url('video') }}" title="Video">Video</a></h3>
                    </div>
                    <div class="video-content">
                        @if ($mainVideo)
                        <div class="video" id="bigVideo">
                            < {!! \App\Helpers::getEmberCodeYoutube($mainVideo->link, 720, 425) !!}

                        </div>
                        @endif
                        @if ($videos)
                        <div class="thumb-video">
                            @foreach ($videos as $video)
                            <a href="{{ url('video', $video->slug)  }}" title="{{ $video->name }}">
                                <img src="{{ \App\Helpers::getYoutubeImage($video->link) }}" alt="{{ $video->name }}" width="190" height="129" class="imgFull">
                                <span class="title">{{ $video->name }}</span>
                            </a>
                            @endforeach
                        </div>
                        @endif

                        @include('frontend.pagination', ['paginate' => $videos])
                    </div>
                </div>
                @include('frontend.right')
            </div>
        </div>

    </section>
@endsection