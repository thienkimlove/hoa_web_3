<div class="contentRight">
    @if ($rightVideos = \App\Helpers::getRightVideos())
        <div class="boxVideo">
            <h3 class="globalTitle">
                <a href="#">Góc Video</a>
            </h3>
            @if ($firstVideos = $rightVideos->shift())
                <div class="content">
                    {!! \App\Helpers::getEmberCodeYoutube($firstVideos->link, '100%', 250) !!}

                    @if ($rightVideos->count() > 0)
                    <ul class="listVideo">
                        @foreach ($rightVideos as $rightVideo)
                            <li>
                                <a href="{{ url('video/'.$rightVideo->slug) }}">
                                    {{ $rightVideo->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            @endif
        </div>
    @endif
    <!-- /endVideo -->
    <div class="boxSale">
        <h3 class="globalTitle">
            <a href="#">Facebook Page</a>
        </h3>
        <div class="Social">
            <img src="/frontend/imgs/facebook_page.png" />
            {{--<div class="fb-page" data-href="https://www.facebook.com/tuelinh.vn" data-width="100%" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/tuelinh.vn"><a href="https://www.facebook.com/tuelinh.vn">Tuệ Linh</a></blockquote>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
    </div>
    <!-- /endSale -->
</div>