<?php

namespace App\Http\Controllers;

Use Session;
use Illuminate\Http\Request;
use App\Task;
use App\Project;
use App\Employe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class TaskController extends Controller
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
        $tasks = Task::all();
        
        return view('admin.indexTask',compact('tasks','employes','projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.createTask',
            [
               
                'projects'=>Project::all(),
                'employes'=>Employe::all()
            ]);

      //  $employes = Employe::all();
        //$projects = Project::all();
        //return view('admin.createTask',compact('tasks','employes','projects'));
    }

    public function edit($id)
    {
        $task = Task::where('id', $id)->first();
            return view('admin.updateTask',
                [
                    'task' => $task,
                    'projects' => Project::all(),
                    'employes' => Employe::all()
                ]

            );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
             $task = Task::create($request->all());

             return redirect()->route('tasks') ;
    }


    public function modif(Request $request)
    {
            $id=$request->get('id');

            $task =Task::where("id",$id)->first();

            $task->name = $request->get('name');
            $task->description = $request->get('description');
            $task->comment = $request->get('comment');
            $task->requestedDate = $request->get('requestedDate');
            $task->estcompletedDate = $request->get('estcompletedDate');
            $task->estDay = $request->get('estDay');
            $task->estHour = $request->get('estHour');
            $task->status = $request->get('status');
            $task->employe_id= $request->get('employe');
            $task->project_id= $request->get('project');
            $task->save();
 
           
            //return redirect()->route('tasks') ;
            return view('admin.indexTask',compact('tasks','employes','projects'));
        
    }

    public function storeEmpl(Request $request)
    {
         
             $employe = Employee::create($request->all());
            

    }


    public function storeProj(Request $request)
    {
       
            $project = Project::create($request->all());
       
    }

    public function findEmp(Request $request)
    {
    
               $first_name=$request->get('first_name');
               $employee =Employee::where("first_name",$first_name)->first();
    
   }

   public function findProj(Request $request)
    {
       
           $name=$request->get('name');
           $project =Project::where("name",$name)->first();
   }




    public function add() 
    {
    
           $task = new Task();

           $task->name = Input::get('name');
           $task->description = Input::get('description');
           $task->comment = Input::get('comment');
           $task->requestedDate = Input::get('requestedDate');
           $task->estcompletedDate = Input::get('estcompletedDate');
           $task->estDay = Input::get('estDay');
           $task->estHour = Input::get('estHour');
           $task->status = Input::get('status');
           $task->employe_id= Input::get('employe');
           $task->project_id= Input::get('project');
           $task->save();

           
            //return redirect('tasks');
           return view('admin.createTask',compact('tasks','employes','projects'));
          
   }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      // $project = Project::find($id);
        //$employes = Employe::all();
        $task = Task::find($id);

         return view('admin.showTask',compact('task','employes','projects'));
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    public function update()
    {
       
           $task = Task::where('id', Input::get('id'))->first();

           $task->name = Input::get('name');
           $task->description = Input::get('description');
           $task->comment = Input::get('comment');
           $task->requestedDate = Input::get('requestedDate');
           $task->estcompletedDate = Input::get('estcompletedDate');
           $task->estDay = Input::get('estDay');
           $task->estHour = Input::get('estHour');
           $task->status = Input::get('status');
           $task->employe_id= Input::get('employe');
           $task->project_id= Input::get('project');
           $task->save();


           //return redirect('tasks');
           return view('admin.indexTask',compact('tasks','employes','projects'));
           //return view('admin.createTask',compact('tasks','employes','projects'));
       
   }

    public function delete($id) 
    {
       
           $task = Task::where('id', $id)->first();
           $task->forceDelete();
          // return redirect('tasks');
          return view('admin.indexTask',compact('tasks','employes','projects'));
          
   }
}
