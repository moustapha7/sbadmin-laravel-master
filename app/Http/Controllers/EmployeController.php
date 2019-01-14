<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Employe;
use App\Team;

class EmployeController extends Controller
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
        //
        $employes = Employe::all();
         return view('admin.employes',compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $teams = Team::all();
       // dd($teams);
        return view('admin.newEmploye',compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->id){
            $employe = Employe::find($request->id);
            $employe->first_name = $request->first_name;
            $employe->last_name = $request->last_name;
            $employe->position = $request->position;
            if($request->team_id != 0){
                $team = Team::find($request->team_id);
                $emp = $employe->team()->associate($team)->save();
            }else{
                $emp = $employe->save();
            }
            if($emp){
                Session::flash('success','Employe update successful');
            }else{
                Session::flash('error','Employe update error');
            }

        }else{
            $employe = new Employe();
            $employe->first_name = $request->first_name;
            $employe->last_name = $request->last_name;
            $employe->position = $request->position;
            if($request->team_id != 0){
                $team = Team::find($request->team_id);
                $emp = $employe->team()->associate($team)->save();
            }else{
                $emp = $employe->save();
            }
            if($emp){
                Session::flash('success','Employe create successful');
            }else{
                Session::flash('error','Employe create error');
            }
        }
        return view('admin.newEmploye');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $employe = Employe::find($id);
        $teams = Team::all();
        return view('admin.newEmploye',compact('employe','id','teams'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
