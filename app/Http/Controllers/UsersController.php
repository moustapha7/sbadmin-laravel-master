<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Team;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
         $users = User::all();
        
        return view('admin.listeUsers',compact('users'));
    }

    public function create()
    {
        //
        return view('admin.showUser');
    }


    public function show($id)
    {
        $teams = Team::all();
      
        $user = User::find($id);
       

         return view('admin.showUser',compact('user','teams'));
   
    }

    public function store(Request $request)
    {
             $users = User::create($request->all());

             return redirect()->route('users') ;
    }



    public function edit($id)
    {
        $user = User::where('id', $id)->first();
            return view('admin.showUser',
                [
                    'users' => $user,
                    'teams' => Team::all()
                   
                ]

            );
    }




    public function modif(Request $request)
    {
            $id=$request->get('id');

            $user =User::where("id",$id)->first();

            $user->first_name = $request->get('first_name');
           $user->name = $request->get('name');
           $user->phone = $request->get('phone');
           //$user->position = $request->get('position');
            $user->team_id = $request->get('team_id');
           // $user->email = $request->get('email');
         //  $user->password = $request->get('password');
           
            $user->save();
 
    
            return view('admin.showUser');
        
    }

    public function update()
    {
       
        //$user=new User();
           $user = User::where('id', Input::get('id'))->first();

           $user->first_name = Input::get('first_name');
           $user->name = Input::get('name');
           $user->phone = Input::get('phone');
        //   $user->position = Input::get('position');
           $user->team_id = Input::get('team_id');
          // $user->email = Input::get('email');
          // $user->password = Input::get('password');
           
           $user->save();

           return view('admin.showUser',compact('user','teams'));
           
   }

}
