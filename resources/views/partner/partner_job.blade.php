@extends('layouts.partner_layout')
@section('right_content')
        <!-- Job Content -->
<div id="accordion">

    <!-- Job Section -->
    <div class="job-content job-post-page">
        <!-- Job Tittle -->
        <div class="panel-group">
            <div class="panel panel-default">
                <!-- PANEL HEADING -->
                <div class="panel-heading">
                    <div class="job-tittle02">
                        <h6 class="partner_title">{{ $partner->user->nick }} 님의 전문분야 입니다.</h6>

                        @if($partner->job()->get()->isEmpty())
                            <div class="text-center panel-body">
                                <p class="text-center padding-bottom-15"><i class="fa fa fa-wrench fa-5x"></i></p>
                                전문분야가 없습니다
                            </div>
                        @else
                        <div class="panel02 panel-default02 margin-top-20">
                            <table class="table_01" width=100% cellpadding=0 cellspacing=0>
                                <col style="width:16.6%;"/>
                                <col style="width:16.6%;"/>
                                <col style="width:16.6%;"/>

                                <tr>
                                    <th>종류</th>
                                    <th>숙련도</th>
                                    <th>경험</th>

                                </tr>
                                <tbody id="skill_list">
                                @foreach($partner->job()->get() as $job)
                                    <tr>
                                        <td>{{ $job->job }}</td>
                                        <td>{{ $job->number }}</td>
                                        <td>{{ $job->experience }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection