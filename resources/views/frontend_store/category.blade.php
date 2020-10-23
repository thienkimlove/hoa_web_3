@extends('frontend_store.layout')

@section('content')
    <section class="section vis">
        <div class="container">
            <div class="contentLeft">
                <ul class="breadCrumb clearFix">
                    <li><a href="{{ url('/') }}">Trang chủ</a></li>
                    <li class="active">{{ $category->name }}</li>
                </ul>
                <div class="boxNews clearFix">
                    <h3 class="globalTitle">
                        <a href="{{ url($category->slug) }}">{{ $category->name }}</a>
                    </h3>
                    @if ($firstPost = $posts->shift())
                        <div class="topNews clearFix">
                            <a href="{{ url($firstPost->slug.'.html') }}" class="thumb">
                                <img src="{{ \App\Helpers::getImageUrlBySize($firstPost->image, 400, 289) }}" alt="">
                            </a>
                            <h3>
                                <a href="{{ url($firstPost->slug.'.html') }}">
                                    {{ $firstPost->name }}
                                </a>
                            </h3>
                            <p>
                                {{ $firstPost->desc }}
                            </p>
                        </div>
                    @endif
                    @if ($posts->count() > 0)
                        <div class="listNews fullWidth">
                            @foreach ($posts as $post)
                                <div class="item clearFix">
                                    <a href="{{ url($post->slug.'.html') }}" class="thumb">
                                        <img src="{{ \App\Helpers::getImageUrlBySize($post->image, 320, 180) }}" alt="List news" width="320" height="180">
                                    </a>
                                    <h3><a href="{{ url($post->slug.'.html') }}">{{ $post->name }}</a></h3>
                                    <span class="date">{{ $post->updated_at->format('d/m/Y')  }}</span> | <span class="tag">
                                        @foreach ($post->tags as $tag)
                                            <a href="{{url('tag/'.$tag->slug)}}">{{ $tag->name }}</a>,
                                        @endforeach
                                    </span>
                                    <p>
                                       {{ $post->desc }}
                                    </p>
                                    <a href="{{ url($post->slug.'.html') }}" class="readMore">Chi tiết</a>
                                </div>
                            @endforeach
                            <!-- /paging -->
                            <div class="boxPaging">
                                @include('frontend_store.pagination', ['paginate' => $posts])
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /endboxNews -->
            </div>
            @include('frontend_store.right')
        </div>
    </section>
@endsection