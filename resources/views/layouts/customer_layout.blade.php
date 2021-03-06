@extends('include.head')
@section('content')


    <div id="content">

        <!-- Revenues -->
        <section class="revenues padding-top-15 padding-bottom-30">
            <div class="container">

                <div class="row">
                    <!-- Revenues Sidebar -->
                    <div class="col-md-3">
                        <div class="job-sider-bar02">
                            <div class="side-bar-revenues">

                                <a href="{{url('customer/notification')}}" aria-expanded="false" id="first" class="head"><i
                                            class="fa fa-angle-double-right "></i> &nbsp;공지사항</a>


                                <a href="{{url('customer/man_to_man')}}" aria-expanded="false" id="fifth" class="head"><i
                                            class="fa fa-angle-double-right "></i> &nbsp;일대일 문의</a>

                                <a href="{{url('password/reset')}}" aria-expanded="false" id="sixth" class="head"><i
                                            class="fa fa-angle-double-right "></i> &nbsp;비밀번호 찾기</a>

                                <a href="{{route('agreement')}}" aria-expanded="false" id="third" class="head"><i
                                            class="fa fa-angle-double-right "></i> &nbsp;이용 약관</a>
                                <a href="{{route('personal_info')}}" aria-expanded="false" id="fourth" class="head"><i
                                            class="fa fa-angle-double-right "></i> &nbsp;개인정보 취급방침</a>
                            </div>
                        </div>
                    </div>

                    @yield('customer_centre')

                </div>
            </div>
        </section>
    </div>
    <script>
        $(function () {
            if ($("#first").hasClass('on'))
                $("#first").removeClass('on');
            if ($("#second").hasClass('on'))
                $("#second").removeClass('on');
            if ($("#third").hasClass('on'))
                $("#third").removeClass('on');
            if ($("#fourth").hasClass('on'))
                $("#fourth").removeClass('on');
            if ($("#fifth").hasClass('on'))
                $("#fifth").removeClass('on');
            if ($("#sixth").hasClass('on'))
                $("#sixth").removeClass('on');



            @if(starts_with(Route::getCurrentRoute()->getPath(), 'customer/notification'))
                $("#first").addClass("on");
            @elseif(starts_with(Route::getCurrentRoute()->getPath(), 'customer/introduction'))
                $("#second").addClass("on");
            @elseif(starts_with(Route::getCurrentRoute()->getPath(), 'agreement'))
                $("#third").addClass("on");
            @elseif(starts_with(Route::getCurrentRoute()->getPath(), 'personal_info'))
                $("#fourth").addClass("on");
            @elseif(starts_with(Route::getCurrentRoute()->getPath(), 'customer/man_to_man'))
                $("#fifth").addClass("on");
            @elseif(starts_with(Route::getCurrentRoute()->getPath(), 'password/reset'))
                $("#sixth").addClass("on");
            @endif
        });
    </script>

@include('include.footer')
@endsection

