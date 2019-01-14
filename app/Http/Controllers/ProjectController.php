<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Employe;
use App\Team;
use App\Client;
use App\Project;
use App\Department;
use App\ProjectType;
use App\Comment;
use \Carbon\Carbon;
class ProjectController extends Controller
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
        $projects = Project::all();
        /*foreach($projects as $proj){
            dd($proj->employeProject());
        }*/

        $commentss = Comment::all();
        $comments = array();
        foreach($commentss as $com)
        {
            array_push($comments,$com->with('task'));
        }
        
        $teams = Team::all();
        $departments = Department::all();
        $clients = Client::all();
         return view('admin.projects',compact('projects','teams','departments','clients','comment'));


      
         
        
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employes = Employe::all();
        $teams = Team::all();
        $departments = Department::all();
        $clients = Client::all();
        $types = ProjectType::all();
         return view('admin.newProject',compact('employes','teams','departments','clients','types'));
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
            $project = Project::find($request->id);
            if($request->team_id != ""){
                $team = Team::find($request->team_id);
                $pp = $project->team()->associate($team);
            }
            if($request->projecttype != ""){
               // dd($project);
                $type = ProjectType::find($request->projecttype);
                $project->type()->associate($type);
            }
            if($request->requestor_id != ""){
                $client = Client::find($request->requestor_id);
                $client->name = $request->requestor_name;
                $client->phone = $request->phone;
                $client->email = $request->email;
                $client->contactName = $request->contactName;
                $client->contactPhone = $request->contactPhone;
                $client->contactEmail = $request->contactEmail;
                $client->contactAdresse = $request->contactAdresse;
               // dd($client);
                if($client->Department->id != $request->department_id){
                    $dep = Department::find($request->department_id);
                    $client->department()->sync($dep);
                }
                $client->save();
               // $project->client()->sync($client);
            }else{
                if($request->requestor_name !=""){
                   $client = new Client();
                   $client->name = $request->requestor_name;
                   $client->phone = $request->phone;
                   $client->email = $request->email;
                   $client->contactName = $request->contactName;
                   $client->contactPhone = $request->contactPhone;
                   $client->contactEmail = $request->contactEmail;
                   $client->contactAdresse = $request->contactAdresse;
                   $dep = Department::find($request->department_id);
                   $client->department()->associate($dep);
                   $project->client()->associate($client);
                }
            }
            $empl =  $request->employe_id;
            $emp = Employe::find($empl[6]);
            //$project->save();
            empty($request->commentreassigned) ? $comment = 'New Assignment' : $comment = $request->commentreassigned ;
           // dd($comment);
           $reassighedDate = null;
           $assigntype = $request->type;
           if(!$project->employes->contains($emp->id)){
                $reassighedDate = new Carbon();
                $assigntype = 'Reassigned';
               // dd($reassighedDate);
               //dd($project->employes);
            if($project->employes()->attach([$emp->id => ['comment'=>$comment,'type'=>$assigntype,'assignedDate'=>$reassighedDate,'reassignedDate'=>$project->assignedDate]])){
                // dd($project);
                $project->name = $request->name;
             $project->description = $request->description;
             $project->comment = $request->comment;
             $project->estcompletedDate = $request->estcompletedDate;
             $project->status = $request->status;
             $debut = new Carbon($project->requestedDate);
             $fin = new Carbon($request->estcompletedDate);
             $project->estDay = $debut->diffInDays($fin); // A calculer
             $project->estHour = $debut->diffInHours($fin);
             $project->save();
                 Session::flash('successproject','Project update successful');
             }else{
                 Session::flash('errorproject','Project update error');
             }
 
           }else{
               //dd($project->employes);
            if($project->employes()->sync([$emp->id => ['comment'=>$comment,'type'=>$assigntype,'assignedDate'=>$reassighedDate,'reassignedDate'=>$project->assignedDate]])){
                // dd($project);
                $project->name = $request->name;
             $project->description = $request->description;
             $project->comment = $request->comment;
             $project->estcompletedDate = $request->estcompletedDate;
             $project->status = $request->status;
             $debut = new Carbon($project->requestedDate);
             $fin = new Carbon($request->estcompletedDate);
             $project->estDay = $debut->diffInDays($fin); // A calculer
             $project->estHour = $debut->diffInHours($fin);
             $project->save();
                 Session::flash('successproject','Project update successful');
             }else{
                 Session::flash('errorproject','Project update error');
             }
 

           }

        }else{
            $project = new Project();
            $project->name = $request->name;
            $project->description = $request->description;
            $project->comment = $request->comment;
            $project->requestedDate = $request->requestedDate;
            $project->estcompletedDate = $request->estcompletedDate;
            $project->status = $request->status;
            $project->assignedDate = Carbon::now(); // A verifier
            $debut = new Carbon($request->requestedDate);
            $fin = new Carbon($request->estcompletedDate);
            $project->estDay = $debut->diffInDays($fin); // A calculer
            $project->estHour = $debut->diffInHours($fin); // A calculer
            if($request->team_id != 0){
                $team = Team::find($request->team_id);
                 $project->team()->associate($team);
            }
            if($request->projecttype != ""){
                $type = ProjectType::find($request->projecttype);
                //dd($type);
                $project->type()->associate($type);
            }
            if($request->requestor_id != ""){
                $client = Client::find($request->requestor_id);
                $client->name = $request->requestor_name;
                $client->phone = $request->phone;
                $client->email = $request->email;
                $client->contactName = $request->contactName;
                $client->contactPhone = $request->contactPhone;
                $client->contactEmail = $request->contactEmail;
                $client->contactAdresse = $request->contactAdresse;
                if($client->Department->id != $request->department_id){
                    $dep = Department::find($request->department_id);
                    $client->department()->sync($dep);
                }
                $project->client()->associate($client);
            }else{
                if($request->requestor_name != ""){
                   $client = new Client();
                   $client->name = $request->requestor_name;
                   $client->phone = $request->phone;
                   $client->email = $request->email;
                   $client->contactName = $request->contactName;
                   $client->contactPhone = $request->contactPhone;
                   $client->contactEmail = $request->contactEmail;
                   $client->contactAdresse = $request->contactAdresse;
                   $dep = Department::find($request->department_id);
                  // dd($client);
                   $client->department()->associate($dep)->save();;
                   $project->client()->associate($client);
                  // dd($project);
                }
            }
             // 
            
             $empl =  $request->employe_id;
             $emp = Employe::find($empl[6]);
             empty($request->commentreassigned) ? $comment = 'New Assignment' : $comment = $request->commentreassigned ;
           // dd($request->type);
            if($project->save()){
                $project->employes()->attach($emp->id, ['comment'=>$comment,'assignedDate'=>new Carbon(),'type'=>$request->type]);
                Session::flash('successproject','Project create Successful');
                return view('admin.showProject',compact('project'));
            }else{
                Session::flash('errorproject','Project create Unsuccessful');
                return view('admin.newProject');
            }
            
        }
        return view('admin.showProject',compact('project'));
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
        $project = Project::find($id);
        $employes = Employe::all();
        $teams = Team::all();

        $departments = Department::all();
        $clients = Client::all();
        $types = ProjectType::all();


        $comments= Comment::all();

         return view('admin.showProject',compact('project','employes','teams','departments','clients','types','comments','task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
       // dd($project->requestedDate);
        $employes = Employe::all();
        $teams = Team::all();
        $departments = Department::all();
        $clients = Client::all();
        $types = ProjectType::all();
         return view('admin.newProject',compact('project','employes','teams','departments','clients','types'));
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


    

    public function autocomplete(Request $request)
    {
        $name = $request->requestor_id;
        $clients = Client::where('name','LIKE','%'.$name.'%')->take(10)->get();
        $result = array();
        foreach($clients as $client => $cli){
            $result[] = ['id'=>$cli->id, 'value'=>$cli->name." Email: ".$cli->email." Tel: ".$cli->phone];
        }
        dd($result);
        return response()->json($result);
    }




}