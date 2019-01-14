@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">New Team</div>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                    {{Session::get('success')}}
                    </div>     
                @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                    {{Session::get('error')}}
                    </div>     
                @endif
                <div class="card-body ml-4">
                    <form method="POST" action="{{ action('EmployeController@store') }}">
                        @csrf
                        @if(!empty($employe)) 
                        <input id="id" type="hidden" name="id" value="@if(!empty($employe)) {{$employe->id}} @endif" >
                         @endif
                        <div class="form-group row">
                            <div class="col-md-8">
                            <div>First Name</div>
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="@if(!empty($employe)) {{$employe->first_name}} @endif" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                            <div>Last Name</div>
                                <input id="last_name" type="text" class="form-control{{ $errors->has('lastt_name') ? ' is-invalid' : '' }}" name="last_name" value="@if(!empty($employe)) {{$employe->last_name}} @endif" required >

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                            <div>Position</div>
                                <select name="position" id="position" class="form-control{{ $errors->has('position') ? ' is-invalid' : '' }}">
                                <option value="Technical Manager" >Technical Manager</option>
                                <option value="Programmer" >Programmer</option>
                                <option value="Analyst" >Analyst</option>
                                <option value="Project Manager" >Project Manager</option>
                                <option value="Sr System PA" >Sr System PA</option>
                                <option value="Sr Analyst" >Sr Analyst</option>
                                <option value="Other" >Other</option>
                                </select>
                                @if ($errors->has('position'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                            <div>Team</div>
                                <select name="team_id" id="team_id" class="form-control{{ $errors->has('team_id') ? ' is-invalid' : '' }}">
                                <option value="0" ></option>
                                @if(!empty($teams))
                                @foreach($teams as $team)
                                <option value="{{$team->id}}" >{{$team->name}}</option>
                                @endforeach
                                @endif
                                
                                </select>
                                @if ($errors->has('team_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('team_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                            @if(!empty($employe))
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                            @endif
                            @if(empty($employe))
                                <button type="submit" class="btn btn-primary">
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
