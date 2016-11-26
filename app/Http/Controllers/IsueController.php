<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;
use YouTrack\Connection;


class IsueController extends Controller
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

        $id = $request->input('id');

        $isue = $youtrack->getIssue($id);

        //var_dump($isue);die();

        return view('isue' , array( 'user' => $user, 'isueInfo' => $isue, 'activeMenu' => 'projects' ) );
    }
}
