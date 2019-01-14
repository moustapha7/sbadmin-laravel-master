@extends('layouts.app')

@section('content')
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
                    <form method="POST" action="{{ action('TeamController@store') }}">
                        @csrf
                        @if(!empty($team)) 
                        <input id="id" type="hidden" name="id" value="@if(!empty($team)) {{$team->id}} @endif" >
                         @endif
                        <div class="form-group row">

                            <div class="col-md-8">
                            <div>Name</div>
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="@if(!empty($team)) {{$team->name}} @endif" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                       
                            <div class="col-md-8">
                            <div>Description</div>
                                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="@if(!empty($team)) {{$team->description}} @endif" required>
                                @if(!empty($team)) {{$team->description}} @endif
                                </textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                            @if(!empty($team))
                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                            @endif
                            @if(empty($team))
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
@endsection
