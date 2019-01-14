@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="containe">
            <div class="row justify-content-center ">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header"><h3>Details Task</h3></div>
                        <div class="card-body ml-4">
                            <div class="row ">
                                <div class="col-4">
                                    <h4>Task Name : @if(!empty($task)) {{$task->name}}  @endif</h4>
                                    
                                    <h4>Description</h4>
                                    <p>@if(!empty($task)) {{$task->description}} @endif</p>
                                   
                                    <h4>Comments</h4>
                                    <p>@if(!empty($task)) {{$task->comment}} @endif</p>
                                   

                                </div>
                                <div class="col-4">
                                    <h4>Requested Date : @if(!empty($task)) {{\Carbon\Carbon::parse($task->requestedDate)->format('d/m/Y')}} @else {{"Default"}} @endif</h4>
                                    <h4>Est. Compl. Date : @if(!empty($task)) {{\Carbon\Carbon::parse($task->estcompletedDate)->format('d/m/Y')}} @else Default @endif</h4>
                                    <h4>Est. Days : @if(!empty($task)) {{$task->estDay}} @else Default @endif</h4>
                                    <h4>Est. Hours : @if(!empty($task)) {{$task->estHour}} @else Default @endif</h4>
                                </div>
                            </div>

                            <div class="row ">

                                 <div class="col-12">
                                    <hr>
                                    <h3>Status</h3>
                                    <h5>@if(!empty($task)) {{$task->status}} @endif</h5>
                                    
                                </div>
                                <div class="col-12">
                                    <hr>
                                    <h3>Employee Name</h3>
                                    <h5>@if(!empty($task)) {{$task->employe->first_name}}  @endif  @if(!empty($task)) {{$task->employe->last_name}}  @endif</h5>
                                    
                                </div>                                   
                                <div class="col-12">
                                    <hr>
                                    <h3>Project Name</h3>
                                    <h5>@if(!empty($task)) {{$task->project->name}}  @endif</h5>
                                     
                                </div>
                                @if (Auth::user()->position=="Technical Manager")
                                    @if(!empty($task))
                                    <div class="col-12 ">
                                        <div class="pull-right">
                                            <a  href="{{ route('editTask', ['id' => $task->id ] ) }}">
                                                <button type="submit" class="btn btn-success">Edit</button>
                                            </a>
                                            <a  href="{{ route('deleteTask', ['id' => $task->id ] ) }}">
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </a>
                                        </div>
                                    
                                    </div>
                                    
                                    @endif
                                @endif    
                            </div>


                        </div>
                    </div>
                </div>
            </div>
           

        </div>
    </div>
</div>
@endsection
