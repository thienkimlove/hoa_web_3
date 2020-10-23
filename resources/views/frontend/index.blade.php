@extends('frontend.layout')

@section('content')
    <section class="body pr">
        <div class="fixCen">
            @if ($focusPosts = \App\Helpers::getFocusIndexPosts())
                <div class="block-1 banner-post">
                @if ($firstFocus = $focusPosts->shift())
                <div class="banner-big pr">
                    <img src="{{ \App\Helpers::getImageUrlBySize($firstFocus->image, 507, 310) }}" alt="" width="507" height="310">
                    <div class="title">
                        <a href="{{ url($firstFocus->slug.'.html') }}" title="{{ $firstFocus->name }}">
                            {{ $firstFocus->name }}
                        </a>
                    </div>
                </div>
                @endif
                @if ($focusPosts->count() > 0)
                <div class="group-banner-sm">
                    @foreach ($focusPosts as $focusPost)
                        <div class="bn pr">
                        <img src="{{ \App\Helpers::getImageUrlBySize($focusPost->image, 226, 148) }}" alt="" width="226" height="148">
                        <div class="title">
                            <a href="{{ url($focusPost->slug.'.html') }}" title="{{ $focusPost->name }}">
                                {{ $focusPost->name }}
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @endif
            <div class="groups">
                <div class="left-content">
                    @if ($mainCateHavePosts = \App\Helpers::getMainCategoryHavePosts())
                        @foreach ($mainCateHavePosts as $mainCateHavePost)
                            @php
                               $childCates = ($mainCateHavePost->children->count() > 0)? $mainCateHavePost->children : [$mainCateHavePost];
                            @endphp
                            <div class="block-2 pr">

                                <ul class="tabs rs">
                                    @foreach ($childCates as $index => $childCate)
                                    <li class="tab-{{ $index+1 }} tab {{ $index==0? 'active' : "" }}" data-content="#tab-{{ $index+1 }}">
                                        <h3 class="rs">
                                            <a href="javascript:void(0)" title="{{ $childCate->name }}">{{ $childCate->name }}</a>
                                        </h3>
                                    </li>
                                    @endforeach
                                </ul>

                                <div class="tab-content">
                                    @foreach ($childCates as $index => $childCate)
                                    <div id="tab-{{ $index+1 }}" class="content {{ $index==0? 'active' : "" }}">
                                        @if ($catePosts = \App\Helpers::getCategoryPosts($childCate, 4))
                                            @if ($firstCatePost = $catePosts->shift())
                                                <div class="hot-news">
                                                    <div class="post">
                                                        <img src="{{ \App\Helpers::getImageUrlBySize($firstCatePost->image, 301, 183) }}" alt="" width="301" height="183">
                                                        <h4>
                                                            <a href="{{ url($firstCatePost->slug.'.html') }}"
                                                               class="title"
                                                               title="{{ $firstCatePost->name }}">
                                                                {{ \App\Helpers::truncateWords($firstCatePost->name, 50) }}
                                                            </a>
                                                        </h4>
                                                        <div class="sumary">
                                                            {{ \App\Helpers::truncateWords($firstCatePost->desc, 80) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($catePosts->count() > 0)
                                                <div class="news">
                                                    @foreach ($catePosts as $catePost)
                                                        <div class="post">
                                                        <img src="{{ url(\App\Helpers::getImageUrlBySize($catePost->image, 126, 90)) }}" alt="" width="126" height="90">
                                                        <div class="news-info">
                                                            <h4><a href="{{ url($catePost->slug.'.html') }}" class="title" title="{{ $catePost->name }}">{{ \App\Helpers::truncateWords($catePost->name, 50) }}</a></h4>
                                                            <div class="sumary">
                                                                {{ \App\Helpers::truncateWords($catePost->desc, 80) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
                @include('frontend.right')
            </div>
        </div>

    </section>
@endsection