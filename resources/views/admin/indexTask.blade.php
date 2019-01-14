@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 text-right">
            @if (Auth::user()->position=="Technical Manager")
                <div class="">
                    <a class="btn btn-default" href="/admin/createTask">Ajouter</a>
                </div>
            @endif    
        </div>
    </div><hr>
    <div class="row">
        <div class="col-12">

            <div class="col-12 offset-2">
                
                @if (count($tasks) > 0)
                    <table class="table table-responsive" style="background-color:white;">
                        <thead>
                            <th with="80px">No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Request Date</th>
                            <th>Est Date</th>
                            <th>Status</th>
                            <th>Employes </th>
                            <th>Projects </th>
   
                            <th>Action</th>
                        </thead>
                        <tbody>

                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{$task->id }}</td>
                                <td>{{$task->name }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{$task->requestedDate }}</td>
                                <td>{{$task->estcompletedDate}}</td>
                                <td>{{ $task->status}}</td> 

                                <td> @if(!empty($task)) {{$task->employe->first_name}}  @endif  @if(!empty($task)) {{$task->employe->first_name}}  @endif</td>
                                <td> @if(!empty($task)) {{$task->project->name}}  @endif</td> 
                               
                                
                                <td>


                                    <a class="btn btn-primary" href="{{ route('showTask', ['id' => $task->id ] ) }}">
                                        show
                                    </a>

                                    @if (Auth::user()->position=="Technical Manager")
                                    <a class="btn btn-warning" href="{{ route('editTask', ['id' => $task->id ] ) }}">
                                        edit
                                    </a>
                                    @endif
                                   
                                </td>
                               
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">
                        <strong>Pas de task dans la base de données</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
