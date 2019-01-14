@extends('layouts.app')

@section('content')
<div class="content-wrapper mycontainer">
    <div class="container-fluid">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Update Task</div>
                @if(Session::has('successtask'))
                    <div class="alert alert-success">
                    {{Session::get('successtask')}}
                    </div>     
                @endif
                @if(Session::has('errortask'))
                    <div class="alert alert-danger">
                    {{Session::get('errortask')}}
                    </div>     
                @endif
                <div class="card-body ml-4">
                    <form method="POST" action="{{ route('updateTask') }}">
                        @csrf
                    
                        <input type="hidden" name="id" value="{{ $task->id }}">
                        <div class="form-group row">
                            <div class="col-md-6">
                            <div>Task Name</div>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $task->name }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            
                            <div class="col-md-9">
                                <div>Description</div>
                                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"  rows="1">
                                @if(!empty($task)) {{$task->description}} @endif
                                </textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-9">
                                <div>Comments</div>
                                <textarea id="comment" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" value="@if(!empty($task)) {{$task->comment}} @endif" rows="1">
                                @if(!empty($task)) {{$task->comment}} @endif
                                </textarea>
                                @if ($errors->has('comment'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>


                           
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                            <div>Requested Date</div>
                                <input id="requestedDate" type="date" class="form-control{{ $errors->has('requestedDate') ? ' is-invalid' : '' }}" name="requestedDate" value=@if(!empty($project)) {{$project->requestedDate}} @endif required @if(!empty($project)) {{'disabled'}} @endif>
                                @if ($errors->has('requestedDate'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('requestedDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                            <div>Est. Completed Date</div>
                                <input id="estcompletedDate" type="date" class="form-control{{ $errors->has('estcompletedDate') ? ' is-invalid' : '' }}" name="estcompletedDate" value=@if(!empty($project)) {{$project->estcompletedDate}} @endif required >
                                @if ($errors->has('requestedDate'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('estcompletedDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                            <div>Est. Days</div>
                                <input id="estDay" type="text" class="form-control{{ $errors->has('estDay') ? ' is-invalid' : '' }}" name="estDay" value="@if(!empty($project)) {{$project->estDay}} @endif"  disabled>
                                @if ($errors->has('estDay'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('estDay') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                            <div>Est. Hours</div>
                                <input id="estHour" type="text" class="form-control{{ $errors->has('estHour') ? ' is-invalid' : '' }}" name="estHour" value="@if(!empty($project)) {{$project->estHour}} @endif"  disabled>
                                @if ($errors->has('estDay'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('estHour') }}</strong>
                                    </span>
                                @endif
                            </div>

                             <div class="col-md-3">
                            <div>Task Status</div>
                                <select name="status" id="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" value="@if(!empty($project)) {{$project->status}} @endif">
                                <option value="Ongoing" @if(!empty($project)) @if($project->status == "Ongoing") {{'selected'}} @endif @endif>Ongoing</option>
                                <option value="Completed"  @if(!empty($project)) @if($project->status == "Completed") {{'selected'}} @endif @endif>Completed</option>
                                <option value="Cancelled"  @if(!empty($project)) @if($project->status == "Cancelled") {{'selected'}} @endif @endif>Cancelled</option>
                                <option value="Suspended"  @if(!empty($project)) @if($project->status == "Suspended") {{'selected'}} @endif @endif>Suspended</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="col-md-4">
                                <div>Assigned To </div>
                                <select name="employe" id="employee_id" class="form-control{{ $errors->has('employee_id') ? ' is-invalid' : '' }}">
                                    @if(!empty($employes))
                                        @foreach($employes as $emp)
                                         <option value="{{$emp->id}}" >{{$emp->first_name}} {{$emp->last_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('emp_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('emp_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4">
                                <div>Project </div>
                                <select name="project" id="project_id" class="form-control{{ $errors->has('project_id') ? ' is-invalid' : '' }}">
                                @if(!empty($projects))
                                @foreach($projects as $proj)
                                <option value="{{$proj->id}}" >{{$proj->name}}</option>
                                @endforeach
                                @endif
                                </select>
                                @if ($errors->has('proj_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('proj_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                                        
                        </div>

                        

                        <div class="form-group row mb-0" >
                            <div class="col-md-6 offset-md-4 ">
                            
                                <button type="submit" class="btn btn-primary bouton">
                                    Update
                                </button>
                        
                        
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection

