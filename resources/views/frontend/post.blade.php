@extends('frontend.layout')

@section('content')
    <section class="body pr">
        <div class="fixCen">
            <div class="groups">
                <div class="left-content">
                    <div class="steps">
                        <h2 class="rs"><a href="{{ url('/') }}" title="Trang chủ">Trang chủ</a></h2>
                        <span>|</span>
                        <h3 class="rs"><a href="{{ url($post->category->slug) }}" title="{{ $post->category->name }}">{{ $post->category->name }}</a></h3>
                        <span>|</span>
                        <h4>{{ $post->name }}</h4>
                    </div>
                    <div class="detail-content">
                        <article class="detail">
                            <div class="info">
                                <span class="date"> Ngày đăng: {{ $post->updated_at->format('d/m/Y') }} </span> | <span class="view"> Lượt xem: {{ $post->views }} views</span>
                            </div>
                            <span class="detail-title">{{ $post->name }}</span>
                            <div class="detail-tab-content">
                                <div class="content">
                                    <article>
                                       {!! $post->content !!}
                                    </article>
                                </div>
                            </div>
                        </article>

                        <div class="box-tags">
                            <span>Từ khóa: </span>
                            @foreach ($post->tags as $tag)
                            <a href="{{ url('tag/'.$tag->slug) }}" title="{{ $tag->name }}">{{ $tag->name }}</a>
                            @endforeach
                        </div>

                        <div class="news-bt">
                            <div class="box-usual-ques">
                                <div class="custom-global-title">
                                    <a href="#"> TIN LIÊN QUAN</a>
                                </div>

                                <div class="box-bd">
                                    @foreach($latestNews as $latestNew)
                                    <div class="item cf item-r">
                                        <h3>
                                            <a href="{{ $latestNew->slug.'.html' }}">{{ $latestNew->name }}</a>
                                        </h3>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                @include('frontend.right')
            </div>
        </div>
    </section>
@endsection