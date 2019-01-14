<?php

namespace App\Http\Controllers;

Use Session;
use Illuminate\Http\Request;
use App\Task;
use App\User;
use App\Comment;
use App\Employe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CommentController extends Controller
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
         $comments = Comment::all();
        
        return view('admin.showProject',compact('comments','task','user','projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.createComment',
        [
           
            'projects'=>Project::all(),
            'users'=>User::all(),
            'tasks'=>Task::all()
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = Comment::create($request->all());

             return redirect()->route('comments') ;
    }

    public function modif(Request $request)
    {
            $id=$request->get('id');

            $comment =Task::where("id",$id)->first();

            $comment->content= $request->get('content');
            $comment->user_id= $request->get('user');
            $comment->project_id= $request->get('project');
            $comment->task_id= $request->get('task');
            $comment->save();
 
           
            //return redirect()->route('tasks') ;
            return view('admin.showProject',compact('user','task','projects','comments'));
        
    }

    public function add() 
    {
    
       /* $project = Project::find(Input::get('project'));
        $employes = Employe::all();
        $teams = Team::all();

        $departments = Department::all();
        $clients = Client::all();
        $types = ProjectType::all();

        */
           $comment = new Comment();
           
           $comment->content= Input::get('content');
           $comment->user_id=Auth::user()->id;
           $comment->project_id=Input::get('project'); 
           $comment->task_id=Input::get('task'); 
           
         
            $comment->save();
            
            return view('admin.showProject',compact('project','user','task','comments'));
            ///return redirect()->route('admin.showProject');
        
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::where('id', $id)->first();
        return view('admin.updateComment',
            [
                'comment' => $comment,
                'projects' => Project::all(),
                'users' => User::all(),
                'tasks' => Task::all()
            ]

        );
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
    public function delete($id) 
    {
       
           $comment = Comment::where('id', $id)->first();
           $comment->forceDelete();
          // return redirect('tasks');
          return view('admin.showProject',compact('task','employes','projects','comments'));
          
   }
}
