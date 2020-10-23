@extends('frontend.layout')

@section('content')
    <section class="body pr">
        <div class="fixCen">
            <div class="groups">
                <div class="left-content">
                    <div class="steps">
                        <h2 class="rs"><a href="{{ url('/') }}" title="Trang chủ">Trang chủ</a></h2>
                        <span>|</span>
                        <h3 class="rs"><a href="{{ route('frontend.contact') }}" title="Liên hệ">Liên hệ</a></h3>
                    </div>
                    <div class="contact-content">

                        <form action="{{ route('frontend.save_contact') }}" method="POST" id="contact">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <label for="name">Họ và tên</label>
                                <input type="text" name="name" placeholder="Nhập họ và tên" required>
                            </div>
                            <div class="form-row">
                                <label for="phone">Điện thoại</label>
                                <input type="tel" name="phone" placeholder="Nhập số điện thoại" required>
                            </div>
                            <div class="form-row">
                                <label for="email">Email</label>
                                <input type="email" name="email" placeholder="Nhập email" required>
                            </div>

                            <div class="form-row">
                                <label for="content">Nội dung</label>
                                <textarea name="content" id="" cols="30" rows="10" placeholder="Nhập nội dung"></textarea>
                            </div>

                            <div class="contain-btn form-row">
                                <button id="sendForm" type="button">Gửi</button>
                                <button type="reset">Nhập lại</button>
                            </div>
                        </form>
                        <div class="address-group">
                            {{ \App\Helpers::configGet('company_address') }}
                        </div>
                        <div class="embed-ggmap">
                            <img src="/frontend/images/gg-map.jpg" alt="" class="imgFull" width="728" height="425">
                        </div>
                    </div>

                </div>
                @include('frontend.right')
            </div>
        </div>

    </section>
@endsection

@section('after_scripts')
    <script>
        $(function(){
            $('#sendForm').click(function(){
                $('#contact').submit();
                return false;
            });
        });
    </script>
@endsection