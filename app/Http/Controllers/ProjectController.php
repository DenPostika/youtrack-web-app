<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;
use YouTrack\Connection;


class ProjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      	$user = Auth::user();

        $youtrack =  new Connection(
            $user->youtrack_url,
            $user->youtrack_email,
            $user->youtrack_password
          );

        $project_name = $request->input('project_name');

        $isues = $youtrack->getIssuesByFilter($project_name);

        return view('isueses' , array( 'user' => $user, 'isues' => $isues ) );
    }

}
