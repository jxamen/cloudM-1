@extends('layouts.master_layout')
@section('right_content')
    <div class="coupen padding-top-30 padding-bottom-30 margin-bottom-10">
        <span class="h3 text-bold">포트폴리오 관리</span>
        <p class="padding-top-5">체계적인 포트폴리오 관리를 통해 광고주의 선택을 받을 수 있습니다.</p>
    </div>

    <!-- Job Content -->
    <div id="accordion">

        <!-- Job Section -->
        <div class="job-content job-post-page">
            <!-- Job Tittle -->
            <div class="panel-group">
                <div class="panel panel-default">
                    <!-- PANEL HEADING -->
                    <div class="panel-heading">


                        <div class="job-tittle02 txt_color_g">
                            <h6 class="my_h6 margin-bottom-20 margin-top-20">포트폴리오</h6>

                            <a href="{{ url('profile/portfolio/create') }}" style="cursor:pointer" id="intro_edit_button" class="button002 signup002 margin-top-12">
                                추가하기
                            </a>
                            <div class="row">

                                @foreach($portfolios as $portfolio)
                                    <div class="col-md-4">
                                        <div class="thumbnail">
                                            <div class="thum_imgbox">
                                                <a href="{{ url('/profile/portfolio/'.$portfolio->id) }}"><img src="{{ $portfolio->image1 }}" alt="" class="img-responsive"></a>
                                            </div>
                                            <div class="caption">
                                                <a href="{{ url('/profile/portfolio/'.$portfolio->id) }}"><h3 class="thum_title">{{ $portfolio->title }}</h3></a>
                                                <p class="thum_category">{{ $portfolio->area }} > {{ $portfolio->category }}</p>
                                                <p><a href="{{ url('/profile/portfolio/'.$portfolio->id) }}" class="btn btn-primary margin-top-10" role="button">자세히보기</a></p>
                                            </div>
                                        </div>
                                    </div>



                                @endforeach

                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
