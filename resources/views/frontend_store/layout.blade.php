<!DOCTYPE html>
<html lang="vi" class="no-js">
<head>
    <meta content='GCL' name='generator'/>
    <title>{{$meta_title}}</title>

    <meta property="og:title" content="{{$meta_title}}">
    <meta property="og:description" content="{{$meta_desc}}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{$meta_url}}">
    <meta property="og:image" content="{{$meta_image}}">
    <meta property="og:site_name" content="{{ \App\Helpers::configGet('website_name') }}">
    <meta property="fb:app_id" content="{{ \App\Helpers::configGet('facebook_app_id') }}" />

    <meta name="twitter:card" content="Card">
    <meta name="twitter:url" content="{{$meta_url}}">
    <meta name="twitter:title" content="{{$meta_title}}">
    <meta name="twitter:description" content="{{$meta_desc}}">
    <meta name="twitter:image" content="{{$meta_image}}">


    <meta itemprop="name" content="{{$meta_title}}">
    <meta itemprop="description" content="{{$meta_desc}}">
    <meta itemprop="image" content="{{$meta_image}}">

    <meta name="ABSTRACT" content="{{$meta_desc}}"/>
    <meta http-equiv="REFRESH" content="1200"/>
    <meta name="REVISIT-AFTER" content="1 DAYS"/>
    <meta name="DESCRIPTION" content="{{$meta_desc}}"/>
    <meta name="KEYWORDS" content="{{$meta_keywords}}"/>
    <meta name="ROBOTS" content="index,follow"/>
    <meta name="AUTHOR" content="{{ \App\Helpers::configGet('website_name') }}"/>
    <meta name="RESOURCE-TYPE" content="DOCUMENT"/>
    <meta name="DISTRIBUTION" content="GLOBAL"/>
    <meta name="COPYRIGHT" content="Copyright 2013 by Goethe"/>
    <meta name="Googlebot" content="index,follow,archive" />
    <meta name="RATING" content="GENERAL"/>

    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-570f69bb385fe2f2"></script>
    <link rel="stylesheet" href="/frontend/css/vitaminc.css" type="text/css"/>
    <script src="/frontend/js/modernizr.js" type="text/javascript"></script>
</head>
<body>
<div class="menuIcon pc">
    <div class="listIcons">
        <ul>
            <li>
                <a href="#" class="iSearch">Search</a>
                <div class="box-find" id="box-find">
                    <form action="{{ url('search') }}" method="GET">
                        <input type="text" placeholder="Từ khóa tìm kiếm" name="q" class="txt"/>
                        <input type="submit" value="" name="submit" class="btn-find"/>
                    </form>
                </div>
            </li>
            <li><a href="{{ \App\Helpers::configGet('youtube_link') }}" class="iYou">Youtube</a></li>
            <li><a href="{{ \App\Helpers::configGet('skype_link') }}" class="iSkype">Skype</a></li>
            <li><a href="{{ \App\Helpers::configGet('google_link') }}" class="iGoogle">Google</a></li>
        </ul>
    </div>
</div>
<div class="hotLine sp">
    <img src="/frontend/imgs/hot.png" alt="Hot">
</div>
<header class="header">
    <div class="container">
        <h1 class="clearFix">
            <a href="#" class="logo" title="Logo">
                <img src="{{ url(\App\Helpers::configGet('website_logo_pc'))  }}" alt="Vitamin C" width="225" height="125" class="pc">
                <img src="{{ url(\App\Helpers::configGet('website_logo_sp')) }}" alt="Vitamin C" width="295" height="100" class="sp">
            </a>
        </h1>
        <ul id="globalNav" class="pc">
            <li>
                <a class="{{(isset($page) && $page == 'index') ? 'active' : ''}}" href="{{url('/')}}" title="">TRANG CHỦ</a>
            </li>

            @if ($headerCategories = \App\Helpers::getMainCategories())
                @foreach ($headerCategories as $headerCategory)
                    <li>
                        <a class="{{(isset($page) && ($page == $headerCategory->slug || in_array($page, $headerCategory->children->pluck('slug')->all()))) ? 'active' : ''}}" href="{{url($headerCategory->slug)}}">{{$headerCategory->name}}</a>
                        @if ($headerCategory->children->count() > 0)
                            <ul>
                                @foreach ($headerCategory->children as $childCategory)
                                    <li><a class="{{(isset($page) && $page == $childCategory->slug) ? 'active' : ''}}" href="{{url($childCategory->slug)}}">{{$childCategory->name}}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            @endif

            <li><a href="{{ route('frontend.video') }}">Videos</a></li>
            <li><a href="{{ route('frontend.contact') }}">Liên hệ</a></li>
        </ul>
        <a href="#" title="Menu" class="sp btnMenu" id="btnMenu">Menu</a>
    </div>
</header>
<!-- /endHeader -->
@if ($focusPosts = \App\Helpers::getFocusIndexPosts())
    <section class="boxSlidePage bg">
        <div class="container">
            <h3 class="globalTitle noneAfter">
                <a href="#">
                    <span class="highLight">&nbsp;</span>
                    <span class="bgLight">Tiêu điểm</span>
                </a>
            </h3>
            <div class="listSlidePage clearFix">
                <div class="owl-carousel" id="slidePage">
                    @foreach ($focusPosts as $focusPost)
                        <div class="item wow slideInLeft" data-wow-duration="0.8s" data-wow-delay="1s">
                            <a href="{{ url($focusPost->slug.'.html') }}" title="">
                                <img src="{{ \App\Helpers::getImageUrlBySize($focusPost->image, 274, 174) }}" width="274" height="174" alt=""/>
                            </a>
                            <h3>
                                <a href="{{ url($focusPost->slug.'.html') }}">
                                    {{ $focusPost->name }}
                                </a>
                            </h3>
                            <p>
                                {{ $focusPost->desc }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

@yield('content')

<!-- /endSection -->
<footer class="footer">
    <div class="container">
        <div class="boxFooter clearFix">
            <div class="areaSocial">
                <ul class="listSocial clearFix">
                    <li><a href="{{ \App\Helpers::configGet('youtube_link') }}" class="yu">Youtube</a></li>
                    <li><a href="{{ \App\Helpers::configGet('skype_link') }}" class="sk">Skype</a></li>
                    <li><a href="{{ \App\Helpers::configGet('google_link') }}" class="go">googleplus</a></li>
                </ul>
            </div>
            <div class="areaLink">
                <ul class="listCategory clearFix">
                    <li>
                        <a class="{{(isset($page) && $page == 'index') ? 'active' : ''}}" href="{{url('/')}}" title="">TRANG CHỦ</a>
                    </li>

                    @if ($headerCategories = \App\Helpers::getMainCategories())
                        @foreach ($headerCategories as $headerCategory)
                            <li>
                                <a class="{{(isset($page) && ($page == $headerCategory->slug || in_array($page, $headerCategory->children->pluck('slug')->all()))) ? 'active' : ''}}" href="{{url($headerCategory->slug)}}">{{$headerCategory->name}}</a>
                            </li>
                        @endforeach
                    @endif

                    <li><a href="{{ route('frontend.video') }}">Videos</a></li>
                    <li><a href="{{ route('frontend.contact') }}">Liên hệ</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="copyRight">
        <div class="container">
            <p class="copy">{{ \App\Helpers::configGet('company_copyright') }}</p>
            <p class="address">
                {{ \App\Helpers::configGet('company_contact') }}
            </p>
        </div>
    </div>
</footer>
<!-- /endboxNews -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.4";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script type="text/javascript" src="/frontend/js/jquery-1.10.2.min.js"></script>
<script src="/frontend/js/wow.min.js"></script>
<script type="text/javascript" src="/frontend/js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="/frontend/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="/frontend/js/scrollReveal.js"></script>
<script type="text/javascript" src="/frontend/js/common.js"></script>
@yield('after_scripts')
</body>
</html>