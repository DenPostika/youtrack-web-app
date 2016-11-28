<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;
use YouTrack\Connection;


class ProjectsController extends Controller
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
    public function index()
    {
      	$user = Auth::user();

        try {
          $youtrack =  new Connection(
              $user->youtrack_url,
              $user->youtrack_email,
              $user->youtrack_password
            );

          $projects = $youtrack->getAccessibleProjects();

          return view('projects' , array( 'user' => $user, 'projects' => $projects, 'activeMenu' => 'projects') );
        } catch (\Exception $e) {
          return view('projects' , array( 'user' => $user, 'error' => '404') );
        }
    }

}
