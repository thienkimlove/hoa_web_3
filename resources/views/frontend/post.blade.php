@extends('frontend.layout')

@section('content')
    <section class="section vis">
        <div class="container">
            <div class="contentLeft">
                <ul class="breadCrumb clearFix">
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li class="active">{{ $post->category->name }}</li>
                </ul>
                <div class="boxDetails">
                    <div class="headBox">
                        <h3 class="titleBox">{{ $post->name }}</h3>
                        <span class="datePost">
                            Ngày đăng: {{ $post->updated_at->format('d/m/Y') }}
                        </span>
                        <span class="view">Lượt xem: {{ $post->views }}</span>
                    </div>
                     {!! $post->content !!}
                    <!-- /endTab03 -->
                </div>

                <div class="boxNews">
                    <h3 class="globalTitle"><a href="#">Bài mới nhất</a></h3>
                    <div class="listNews clearFix">
                        @foreach($latestNews as $latestNew)
                            <div class="item">
                            <a href="{{ $latestNew->slug.'.html' }}" class="thumb">
                                <img src="{{ \App\Helpers::getImageUrlBySize($latestNew->image, 130, 80) }}" alt="List news">
                            </a>
                            <p>
                               <a href="{{ $latestNew->slug.'.html' }}">{{ $latestNew->name }}</a>
                            </p>
                            <span class="datePost">{{ $latestNew->updated_at->format('d/m/Y') }}</span>
                            <span class="countView">{{ $latestNew->views }} lượt xem</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @include('frontend.right')
        </div>
    </section>
@endsection