@extends('include.head')
@section('content')
    <!-- Content -->
    <div id="content">

        <!-- Job -->
        <section class="job padding-top-15 padding-bottom-70">
            <div class="container">
                <!-- Side Bar -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="job-sider-bar003">
                            @if($loginUser->PorC == "P")
                                <h5 class="side-tittle">파트너스</h5>
                            @else
                                <h5 class="side-tittle">클라이언트</h5>
                            @endif
                            <div>
                                <div class="col-md-3">
                                    @if($loginUser->profileImage != null)
                                        <img class="partner_profile02" src="{{ URL::asset($loginUser->profileImage) }}">
                                    @else
                                        <img class="partner_profile02" src="/images/p_img02.png">
                                    @endif
                                </div>
                                <div class="col-md-9">
                                    <p class="side-title-name">{{ $loginUser->name }}</p>
                                    <a href="#.">
                                        <div id="tag02">
                                            <div class="button">기본정보수정</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="job-sider-bar02">
                            <table class="history_table">
                                <tbody>
                                <tr>
                                    <th><a href="{{ url('/setting/profile') }}">개인정보수정</a></th>
                                </tr>
                                <tr>
                                    <th><a href="{{ url('/setting/auth') }}">신원인증</a></th>
                                </tr>
                                <tr>
                                    <th><a href="{{ url('/setting/bank') }}">계좌관리</a></th>
                                </tr>
                                <tr>
                                    <th><a href="{{ url('/setting/password') }}">비밀번호 변경</a></th>
                                </tr>
                                <tr>
                                    <th><a href="{{ url('/setting/notification') }}">알림설정</a></th>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <!-- Job  Content -->
                    <div class="col-md-9 job-right">
                        <div class="coupen padding-top-30 padding-bottom-30 margin-bottom-10">
                            <span class="h3 text-bold">계좌 관리</span>
                            <p class="padding-top-5">프로젝트 비용을 정산받을 계좌를 등록해주세요.</p>
                        </div>


                        <!-- Job Content -->
                        <div id="accordion">
                            <div class="job-content job-post-page ">

                                <div class="panel-heading">
                                    <h5 class="panel-title">계좌 정보</h5>
                                </div>
                                <div class="panel-body padding-right-30">
                                    <form action="{{ url('/setting/bankEdit') }}" method="POST" role="form" class="form-horizontal"  accept-charset="UTF-8">
                                        {!! csrf_field() !!}

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="inputEmail3"><span class="symbol required"></span> 은행 </label>
                                            <div class="col-sm-8">
                                                <select name="bank" class="form-control"
                                                        id="bank" required="required">
                                                    <option value="">은행 선택</option>
                                                    <option value="1">국민은행</option>
                                                    <option value="2">기업은행</option>
                                                    <option value="3">우리은행</option>
                                                    <option value="4">신한은행</option>
                                                    <option value="5">하나은행</option>
                                                    <option value="6">농협</option>
                                                    <option value="7">단위농협</option>
                                                    <option value="8">SC은행</option>
                                                    <option value="9">외환은행</option>
                                                    <option value="10">한국씨티은행</option>
                                                    <option value="11">우체국</option>
                                                    <option value="12">한국산업은행</option>
                                                    <option value="13">경남은행</option>
                                                    <option value="14">광주은행</option>
                                                    <option value="15">대구은행</option>
                                                    <option value="16">도이치</option>
                                                    <option value="17">부산은행</option>
                                                    <option value="18">산림조합</option>
                                                    <option value="19">산업은행</option>
                                                    <option value="20">상호저축은행</option>
                                                    <option value="21">새마을금고</option>
                                                    <option value="22">수협</option>
                                                    <option value="23">신협중앙회</option>
                                                    <option value="24">전북은행</option>
                                                    <option value="25">제주은행</option>
                                                    <option value="26">BOA</option>
                                                    <option value="27">HSBC</option>
                                                    <option value="28">JP모간</option>
                                                    <option value="29">교보증권</option>
                                                    <option value="30">대신증권</option>
                                                    <option value="31">대우증권</option>
                                                    <option value="32">동부증권</option>
                                                    <option value="33">동양증권</option>
                                                    <option value="34">메리츠증권</option>
                                                    <option value="35">미래에셋</option>
                                                    <option value="36">부국증권</option>
                                                    <option value="37">삼성증권</option>
                                                    <option value="38">솔로몬투자증권</option>
                                                    <option value="39">신영증권</option>
                                                    <option value="40">신한금융투자</option>
                                                    <option value="41">우리투자증권</option>
                                                    <option value="42">유진투자은행</option>
                                                    <option value="43">이트레이드증권</option>
                                                    <option value="44">키움증권</option>
                                                    <option value="45">하나대투</option>
                                                    <option value="46">하이투자</option>
                                                    <option value="47">한국투자</option>
                                                    <option value="48">한화증권</option>
                                                    <option value="49">현대증권</option>
                                                    <option value="50">HMC증권</option>
                                                    <option value="51">LIG투자증권</option>
                                                    <option value="52">NH증권</option>
                                                    <option value="53">SK증권</option>
                                                    <option value="54">비엔비파리바은행</option>
                                                </select>

                                                <p class="validation-error">{{ $errors->first('bank') }}</p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="inputEmail3"><span class="symbol required"></span> 예금주 </label>
                                            <div class="col-sm-8">
                                                <input class="form-control" required="required" type="text" name="account_holder"
                                                       placeholder=""
                                                       value="{{$loginUser->account_holder}}">

                                                <p class="validation-error">{{ $errors->first('account_holder') }}</p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="inputEmail3"><span class="symbol required"></span> 계좌번호 </label>
                                            <div class="col-sm-8">
                                                <input class="form-control" required="required" type="text" name="account_number"
                                                       placeholder=""
                                                       value="{{$loginUser->account_number}}">

                                                <p class="validation-error">{{ $errors->first('account_number') }}</p>
                                            </div>
                                        </div>
                                        <div class="form-group margin-top-20 padding-right-50">
                                            <div class="col-sm-offset-10 col-sm-10">
                                                <button class="btn btn-o btn-primary" type="submit">
                                                    저장하기
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script> $(function(){  $("#bank").val("{{$loginUser->bank}}"); });</script>


    @include('include.footer')
@endsection
