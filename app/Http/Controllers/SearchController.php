<?php

namespace App\Http\Controllers;


use App\Comments;
use App\Project;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use App\Http\Requests;


class SearchController extends Controller
{

    public function p_search()
    {
//        $projects = Project::all();
//        $test = new Builder(DB::table('projects'));
//        $test2 = $test->paginate(5);
//        $projects = DB::table('projects')->paginate(5);

        return view('p_search/p_search');
//        return view('p_search', compact('projects'));
//        return view('p_search', ['todos'=> $todos]);

    }

    public function detail($id)
    {
        $detailProject = Project::where('id', '=', $id)->get();
        $comment = Comments::where('project_id', '=', $id)->get();
        return view('p_detail', compact('detailProject', 'comment'));
    }

    public function pagination($start, $end)
    {
        return view('pagination', ['start' => $start, 'end' => $end]);
    }


    public function get_p_list($SearchOption, $page, $sort, $keyword = "%")
    {
        $SearchOption = intval($SearchOption);
        $page = intval($page);
//        $keyword1 ="";
//        $keyword2 = "";
        $keyword3 = "";

        if($keyword != "%"){
//            $keyword1 = $keyword."%";
//            $keyword2 = "%".$keyword;
            $keyword3 = "%".$keyword."%";
        }

        if ($SearchOption == 0) {

//            $projects = Project::all();
            $projects = Project::where("step", "!=", "검수")
                ->where('title','LIKE', $keyword)
//                ->union(Project::where("step", "!=", "검수")->where('title','LIKE', $keyword1))
//                ->union(Project::where("step", "!=", "검수")->where('title','LIKE', $keyword2))
                ->union(Project::where("step", "!=", "검수")->where('title','LIKE', $keyword3))
                ->get();

            $count = $projects->count();

            //sort
            if ($sort == "3") {
                $projects = $projects->sortBy('updated_at');
            } else {
                $projects = $projects->sortBy('updated_at');
            }

            $projects = $projects->forPage($page, 10);
            $projects['count'] = $count;

            return view('p_search/p_searchSort', compact('projects'));
        }


        $optionArr = [];
        $projects = new Collection();

        if (($SearchOption & 1) == true) {
            $optionArr[] = "광고 의뢰";
            $query = Project::where('area','=','광고 의뢰')->get();

            foreach ($query as $q){
                $projects = $projects->push($q);
            }
        }
        if (($SearchOption & 2) == true) {
            $optionArr[] = "운영 대행";
            $query = Project::where('area','=','운영 대행')->get();

            foreach ($query as $q){
                $projects = $projects->push($q);
            }
        }
        if (($SearchOption & 4) == true) {
            $optionArr[] = "Viral";
            $query = Project::where('area','=','Viral')->get();

            foreach ($query as $q){
                $projects = $projects->push($q);
            }
        }
        if (($SearchOption & 8) == true) {
            $optionArr[] = "1회성 프로젝트";
            $query = Project::where('area','=','1회성 프로젝트')->get();

            foreach ($query as $q){
                $projects = $projects->push($q);
            }
        }
        if (($SearchOption & 16) == true) {
            $optionArr[] = "의료";
            $query = Project::where('category','=','의료')->get();

            foreach ($query as $q){
                $projects = $projects->push($q);
            }
        }
        if (($SearchOption & 32) == true) {
            $optionArr[] = "법률";
            $query = Project::where('category','=','법률')->get();

            foreach ($query as $q){
                $projects = $projects->push($q);
            }
        }
        if (($SearchOption & 64) == true) {
            $optionArr[] = "스타트업";
            $query = Project::where('category','=','스타트업')->get();

            foreach ($query as $q){
                $projects = $projects->push($q);
            }
        }
        if (($SearchOption & 128) == true) {
            $optionArr[] = "프랜차이즈";
            $query = Project::where('category','=','프랜차이즈')->get();

            foreach ($query as $q){
                $projects = $projects->push($q);
            }
        }
        if (($SearchOption & 256) == true) {
            $optionArr[] = "교육/대학교";
            $query = Project::where('category','=','교육/대학교')->get();

            foreach ($query as $q){
                $projects = $projects->push($q);
            }
        }
        if (($SearchOption & 512) == true) {
            $optionArr[] = "쇼핑몰";
            $query = Project::where('category','=','쇼핑몰')->get();

            foreach ($query as $q){
                $projects = $projects->push($q);
            }
        }



//        for ($i = 0; $i < count($optionArr); $i++) {
//            if ($i == 0) {
//                $query = $query->where('category', '=', $optionArr[$i])->where('step', '!=', '검수');
//            } else {
//                $query = $query->union(Project::where('category', '=', $optionArr[$i])
//                    ->where('step', '!=', '검수'));
//            }
//        }

//        $projects = $query->get();


        if ($sort == 3) {
            $projects = $projects->sortByDesc('updated_at');
        }
        $count = $projects->count();
        $projects = $projects->forPage($page, 10);
        $projects['count'] = $count;

        return view('p_search/p_searchSort', compact('projects'));
        //blade view에서 projects 를 foreach문으로 돌리기로 했으므로 반드시 projects를 넘겨줘야 함

//        $projects = DB::table('projects')->whereln('category', $optionArr)-get();
//        $projects = Project::where('category','=',$eachcate)->union($projects);

//        $projects = Project::where('category','=',"바이럴")->get();


//        $projects = $projects->get()->sortBy('created_at');


//        $listrequest = $request->input('some');
//        $projectlist = Project:: where
//        return compact('projects');


    }

//    public function get_p_list($list)
//    {
//        $projects = Project::all();
//        return compact('projects');
//    }

    public function postcomment(Request $request)
    {
        $input = new Comments();
        $input->project_id = $request->input('project_id');
        $input->comment = $request->input('comment');
        $input->save();
        return back();
    }
}
