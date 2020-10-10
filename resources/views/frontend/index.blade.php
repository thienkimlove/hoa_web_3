@extends('frontend.layout')

@section('content')

    <section class="section mb0">
        <div class="container">
            <div class="contentLeft">
                <!-- /endboxRecommended -->
                <div class="boxNews clearFix">
                    <h3 class="globalTitle">
                        <a href="#">Bài viết mới nhất</a>
                    </h3>
                    @if ($latestPosts = \App\Helpers::getLatestPosts())
                        @foreach ($latestPosts->chunk(3) as $latest3Posts)
                            <div class="listNews clearFix">
                                @foreach ($latest3Posts as $latest3Post)
                                    <div class="item">
                                        <a href="{{ url($latest3Post->slug.'.html') }}" class="thumb">
                                            <img src="{{ \App\Helpers::getImageUrlBySize($latest3Post->image, 130, 80)  }}" alt="{{ $latest3Post->name }}">

                                        </a>
                                        <p>
                                            <a href="{{ url($latest3Post->slug.'.html') }}">
                                                {{ $latest3Post->name }}
                                            </a>
                                        </p>
                                        <span class="datePost">{{ $latest3Post->updated_at->format('d/m/Y') }}</span>
                                        <span class="countView">{{ $latest3Post->views }} lượt xem</span>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- /endboxNews -->
                <div class="boxConsult">
                    <div class="titleConsult">
                        <h3 class="globalTitle">
                            <a href="#">Bài viết nổi bật</a>
                        </h3>
                    </div>
                </div>
                <div class="boxQuestion clearFix">
                    <div class="areaQuestion">
                        @if ($highlightPosts = \App\Helpers::getHighLightIndexPosts())
                            <ul class="listQuestion" id="listQuestion">
                                @foreach ($highlightPosts as $highlightPost)
                                    <li>
                                        <a href="{{ url($highlightPost->slug.'.html') }}">
                                            {{ $highlightPost->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            @include('frontend.right')
        </div>
    </section>
@endsection
@section('after_scripts')
@endsection