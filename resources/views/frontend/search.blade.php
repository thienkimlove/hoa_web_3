@extends('frontend.layout')

@section('content')
    <section class="body pr">
        <div class="fixCen">
            <div class="groups">
                <div class="left-content">
                    <div class="steps">
                        <h2 class="rs"><a href="{{ url('/') }}" title="Trang chủ">Trang chủ</a></h2>
                        <span>|</span>
                        <h3 class="rs"><a href="{{ url('search/?q='.$keyword) }}" title="{{ $keyword }}">Tìm kiếm với từ khóa {{ $keyword }}</a></h3>
                    </div>
                    <div class="list-news">
                        @foreach ($posts as $post)
                        <div class="news">
                            <div class="post post-news">
                                <a href="{{ url($post->slug.'.html') }}" title="{{ $post->name }}" class="img-title">
                                    <img src="{{ url(\App\Helpers::getImageUrlBySize($post->image, 276, 157)) }}" alt="" width="276" height="157">
                                </a>
                                <div class="right">
                                    <a href="{{ url($post->slug.'.html') }}" class="title" title="{{ $post->name }}">
                                        {{ $post->name }}
                                    </a>
                                    <div class="sumary">
                                        {{ \Illuminate\Support\Str::limit($post->desc, 200)  }}
                                    </div>
                                    <a href="{{ url($post->slug.'.html') }}" class="view-detail" title="Xem chi tiết">Xem chi tiết >></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @include('frontend.pagination', ['paginate' => $posts])
                </div>
                @include('frontend.right')
            </div>
        </div>
    </section>
@endsection