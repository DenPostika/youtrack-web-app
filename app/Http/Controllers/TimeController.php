<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use YouTrack\Connection;
use App\Http\Models\TimeModel;
use Carbon\Carbon;

use DB;


class TimeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->timeModel = new TimeModel();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function save(Request $request)
    {
      $user = Auth::user();

      $time = $request->input('time');
      $what_action = $request->input('what_action');
      $today = Carbon::now()->format('Y-m-d');

      $tracker_info = array (
				'user_id'			  	 => $user->id,
				'date'             => $today,
				'what_action'      => $what_action,
				'time'				 => $time,
      );

      $this->timeModel->insertTime( $tracker_info );

      DB::table('users')->where('id', $user->id)->update(array(
        'all_time'               => (int)$user->all_time + (int)$time,
      ));

    }

    public function postTimeToSystem(Request $request)
    {
      $user = Auth::user();

      $time = $request->input('time');
      $issueId = $request->input('issueId');
      $today = Carbon::now()->timestamp;

      $youtrack =  new Connection(
          $user->youtrack_url,
          $user->youtrack_email,
          $user->youtrack_password
        );

      $succes = $youtrack->addWorkitem($issueId, $today, $time);
      DB::table('users')->where('id', $user->id)->update(array(
        'all_time'               => (int)$user->all_time - (int)$time,
      ));

    }

    public function getTimeForDate(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::now()->format('Y-m-d');

        $where = array(
          ['user_id', '=', $user->id],
          ['date', '=', $today],
        );

        $today_issues = $this->timeModel->getTimeWhere( $where );
        return json_encode($today_issues);
    }

    public function getTimeForDates(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::now()->format('Y-m-d');

        $where = array(
          ['user_id', '=', $user->id]
        );

        $today_issues = $this->timeModel->getTimeWhere( $where );
        return json_encode($today_issues);
    }

    public function getTimeForChart(Request $request){
        $user = Auth::user();
        $today = Carbon::now()->format('Y-m-d');

        $where = array(
          ['user_id', '=', $user->id]
        );

        $issues = $this->timeModel->getTimeWhere( $where );
        $result = [];
        $middles = [];

        foreach($issues as $issue){
          $unix = Carbon::parse($issue->date)->timestamp;
          $result[$unix][] = $issue;
        }

        foreach($result as $key => $issuesForDate) {
          $middle = 0;
          $count = 0;
          foreach ($issuesForDate as $issue) {
            $middle += (int)$issue->time;
            $count++;
          }
           if ($count){
             $middles[$key] = $middle / $count;
           } else $middles[$key] = 0;
        }

        return json_encode($middles);
    }


}
