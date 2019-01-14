@extends('layouts.app')

@section('content')
<div class="content-wrapper mycontainer">
    <div class="container-fluid">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Add new Project</div>
                @if(Session::has('successproject'))
                    <div class="alert alert-success">
                    {{Session::get('successproject')}}
                    </div>     
                @endif
                @if(Session::has('errorproject'))
                    <div class="alert alert-danger">
                    {{Session::get('errorproject')}}
                    </div>     
                @endif
                <div class="card-body ml-4">
                    <form method="POST" action="{{ action('ProjectController@store') }}">
                        @csrf
                        @if(!empty($project)) 
                        <input id="id" type="hidden" name="id" value="@if(!empty($project)) {{$project->id}} @endif" >
                         @endif
                        <div class="form-group row">
                            <div class="col-md-6">
                            <div>Project Name</div>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="@if(!empty($project)) {{$project->name}} @endif" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                            <div>Project Type</div>
                            <select  name="projecttype" id="projecttype" class="form-control{{ $errors->has('employe_id') ? ' is-invalid' : '' }}">
                                @if(!empty($types))
                                    @foreach($types as $type)
                                    <option value="{{$type->id}}" @if(!empty($project)) @if($project->Type->id == $type->id) {{'selected'}} @endif @endif>{{$type->name}}</option>
                                    @endforeach
                                @endif
                                </select>
                                @if ($errors->has('position'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <div>Description</div>
                                <textarea id="description" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="description" value="@if(!empty($project)) {{$project->description}} @endif" rows="1">
                                @if(!empty($project)) {{$project->description}} @endif
                                </textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                            <div>Project Status</div>
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
                            <div class="col-md-4 " id="userblock">
                                <div>Assigned To</div>
                                <select  name="employe_id" id="employe_id" class="form-control{{ $errors->has('employe_id') ? ' is-invalid' : '' }}">
                                @if(!empty($employes))
                                     $position = $employes->first()->position;
                                @foreach($employes as $emp)
                                <option value="{{$emp}}"
                                 @if(!empty($project))
                                    @foreach($project->employes as $pemp) 
                                        @if($pemp->id == $emp->id && $pemp->pivot->employeStatus=="Actif") {{'selected'}} {{$eposmpl = $pemp}} @endif
                                    @endforeach 
                                 @endif>
                                 {{$emp->first_name.' '.$emp->last_name}}
                                 </option>
                                @endforeach
                                @endif
                                </select>
                                @if ($errors->has('employe_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('employe_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                            <div>Position</div>
                                <input desabled id="posit" type="texte" class="form-control{{ $errors->has('posit') ? ' is-invalid' : '' }}" name="posit" value="@if(!empty($eposmpl)) {{$eposmpl->position}} @endif" editable="false" >
                                @if ($errors->has('posit'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('posit') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                            <div>Assign/Reassigne</div>
                                <select name="type" id="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" @if(empty($project)) {{'disable'}} @endif>
                                <option value="Assigned"  
                                @if(!empty($eposmpl)) @if($pemp->pivot->type == 'Assigned'){{'selected'}} @endif @endif >Assisgned</option>
                                <option value="Reassigned" @if(!empty($eposmpl)) @if($pemp->pivot->type == 'Reassigned'){{'selected'}} @endif @endif>Reassigned</option>
                                </select>
                                @if ($errors->has('position'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-12  
                                 @if(!empty($eposmpl))
                                     @if($pemp->pivot->type == 'Reassigned'){{'visible'}}  @else {{'invisible'}} @endif
                                  @else {{'invisible'}} @endif" id="reassignedComment">
                                <div>Reassigenment raison</div>
                                <textarea id="commentreassigned" class="form-control{{ $errors->has('commentreassigned') ? ' is-invalid' : '' }}" name="commentreassigned" value="@if(!empty($project->employes)) {{$project->employes->first()->pivot->comment}} @endif" rows="1">
                                @if(!empty($project->employes)) {{$project->employes->first()->pivot->comment}} @endif
                                </textarea>
                                @if ($errors->has('commentreassigned'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('commentreassigned') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                            <div>Requested By</div>
                                <input id="requestor_name" type="text" class="form-control{{ $errors->has('requestor_name') ? ' is-invalid' : '' }}" name="requestor_name" value="@if(!empty($project)) {{$project->Client->name}} @endif" required >
                                <input id="requestor_id" type="hidden" class="form-control{{ $errors->has('requestor_id') ? ' is-invalid' : '' }}" name="requestor_id" value="@if(!empty($project)) {{$project->requestor_id}} @endif" required >
                                @if ($errors->has('requestor_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('requestor_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-md-4">
                                <div>Dept. Requestor</div>
                                <select name="department_id" id="department_id" class="form-control{{ $errors->has('department_id') ? ' is-invalid' : '' }}">
                                @if(!empty($departments))
                                @foreach($departments as $dep)
                                <option value="{{$dep->id}}" >{{$dep->name}}</option>
                                @endforeach
                                @endif
                                </select>
                                @if ($errors->has('dept_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('dept_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                            <div>Requestor phone</div>
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="@if(!empty($project)) {{$project->Client->phone}} @endif" required >
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                            <div>Requestor Email</div>
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="@if(!empty($project)) {{$project->Client->email}} @endif" required >
                                @if ($errors->has('contactAdresse'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                            <div>Contact Person</div>
                                <input id="contactName" type="text" class="form-control{{ $errors->has('requestor_id') ? ' is-invalid' : '' }}" name="contactName" value="@if(!empty($project)) {{$project->Client->contactName}} @endif" required >
                                @if ($errors->has('contactAdresse'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('contactName') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                            <div>Contact Phone</div>
                                <input id="contactPhone" type="text" class="form-control{{ $errors->has('contactPhone') ? ' is-invalid' : '' }}" name="contactPhone" value="@if(!empty($project)) {{$project->Client->contactPhone}} @endif" required >
                                @if ($errors->has('contactAdresse'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('contactPhone') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                            <div>Contact Email</div>
                                <input id="contactEmail" type="text" class="form-control{{ $errors->has('contactPhone') ? ' is-invalid' : '' }}" name="contactEmail" value="@if(!empty($project)) {{$project->Client->contactEmail}} @endif" required >
                                @if ($errors->has('contactAdresse'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('contactEmail') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                            <div>Contact Adresse</div>
                                <input id="contactAdresse" type="text" class="form-control{{ $errors->has('contactAdresse') ? ' is-invalid' : '' }}" name="contactAdresse" value="@if(!empty($project)) {{$project->Client->contactAdresse}} @endif" required >
                                @if ($errors->has('contactAdresse'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('contactAdresse') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-9">
                            <div>Comment project</div>
                                <textarea id="comment" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" value="@if(!empty($project)) {{$project->comment}} @endif" rows="1">
                                @if(!empty($project->employes)) {{$project->comment}} @endif
                                </textarea>
                                @if ($errors->has('comment'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            
                        </div>

                        <div class="form-group row mb-0" >
                            <div class="col-md-6 offset-md-4 ">
                            @if(!empty($project))
                                <button type="submit" class="btn btn-primary bouton">
                                    Update
                                </button>
                            @endif
                            @if(empty($project))
                                <button type="submit" class="btn btn-primary bouton">
                                    Create
                                </button>
                            @endif
                            
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

