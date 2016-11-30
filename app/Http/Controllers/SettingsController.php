<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;
use YouTrack\Connection;


class SettingsController extends Controller
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

        return view('settings' , array( 'user' => $user, 'activeMenu' => 'settings' ) );
    }


    public function save(Request $request)
    {
      	$user = Auth::user();

      try {
        
        $youtrack =  new Connection(
            $request->input('youtrack_url'),
            $request->input('youtrack_email'),
            $request->input('youtrack_password')
          );

          DB::table('users')->where('id', $user->id)->update(array(
            'name'               => $request->input('name'),
            'email'              => $request->input('email'),
            'youtrack_url'       => $request->input('youtrack_url'),
            'youtrack_email'     => $request->input('youtrack_email'),
            'youtrack_password'  => $request->input('youtrack_password'),
          ));

        return redirect('/settings');
      } catch (\Exception $e) {
        return view('/settings' , array( 'user' => $user, 'error' => '404', 'activeMenu' => 'settings') );
      }
    }
}
