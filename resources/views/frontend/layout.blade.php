<!DOCTYPE html>
<html lang="en">
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

    <link rel="stylesheet" href="/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/frontend/css/owl.carousel.css">
    <link rel="stylesheet" href="/frontend/css/common.css">
    <link rel="stylesheet" type="text/css" href="/frontend/css/font-awesome.min.css" media="all">
    {!! \App\Helpers::configGet('webmaster') !!}
</head>
<body>
{!! \App\Helpers::configGet('analytics') !!}


<div class="wrapper home pr">

    <header class="pr">
        <div class="bg-top">
            <a href="javascript:void(0)" class="miniMenu-btn pa open-main-nav" data-menu="#main-nav"></a>
        </div>
        <div class="fixCen head-info">
            <h1 class="rs"><a href="{{ url('/') }}" class="logo" title="Viêm gan" target="_blank">
                    <img src="{{ url(\App\Helpers::configGet('website_logo_pc')) }}" alt="{{ \App\Helpers::configGet('website_name') }}" class="imgFull">
                </a>
            </h1>

            <div class="hotline hidden-sm hidden-xs">

                <div class="block block-search">
                    <form action="{{ route('frontend.search') }}" method="GET" class="form-inline mt-2 mt-md-0">
                        <input class="form-control mr-sm-2" name="q" type="text" placeholder="Search" aria-label="Search">
                        <button type="submit"> <i class="fa fa-search"> </i></button>
                    </form>
                </div>
            </div>
        </div>
        <nav id="main-nav" class="menu-mb">
            <ul class="fixCen pr rs">
                <li>
                    <a class="{{(isset($page) && $page == 'index') ? 'active' : ''}}" href="{{ url('/') }}" title="Trang chủ">Home</a>
                </li>

                @if ($headerCategories = \App\Helpers::getMainCategories())
                    @foreach ($headerCategories as $headerCategory)
                        <li class="parentMenu">
                            <a class="{{(isset($page) && ($page == $headerCategory->slug || in_array($page, $headerCategory->children->pluck('slug')->all()))) ? 'active' : ''}}" href="{{url($headerCategory->slug)}}">{{$headerCategory->name}}</a>
                            @if ($headerCategory->children->count() > 0)
                                <ul class="submenu">
                                    @foreach ($headerCategory->children as $childCategory)
                                        <li><a class="{{(isset($page) && $page == $childCategory->slug) ? 'active' : ''}}" href="{{url($childCategory->slug)}}">{{$childCategory->name}}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                @endif


                <li><a class="{{(isset($page) && $page == 'video') ? 'active' : ''}}" href="{{ route('frontend.video') }}">Videos</a></li>
                <li><a class="{{(isset($page) && $page == 'lien-he') ? 'active' : ''}}" href="{{ route('frontend.contact') }}">Liên hệ</a></li>
            </ul>
        </nav>
    </header>

    @yield('content')

    <!-- Start footer -->
    <footer>
        <div class="fixCen">
            <div class="listSocial">
                <div> <a href="{{ \App\Helpers::configGet('facebook_link') }}"> <i class="fa fa-facebook"> </i></a> </div>
                <div> <a href="{{ \App\Helpers::configGet('google_link') }}"> <i class="fa fa-google-plus"> </i></a></div>
                <div> <a href="{{ \App\Helpers::configGet('youtube_link') }}"> <i class="fa fa-youtube"> </i></a> </div>
            </div>
        </div>
    </footer>

</div>
</body>
<script src="/frontend/js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="/frontend/js/SmoothScroll.js" type="text/javascript"></script>
<script src="/frontend/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="/frontend/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="/frontend/js/common.js" type="text/javascript"></script>
@yield('after_scripts')

</html>