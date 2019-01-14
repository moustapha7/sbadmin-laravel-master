@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12 text-right">
            <div class="">
               
            </div>
        </div>
    </div><hr>
    <div class="row">
        <div class="col-12">

            <div class="col-12 offset-2">
                
                @if (count($users) > 0)
                    <table class="table table-responsive" style="background-color:white;">
                        <thead>
                            <th with="80px">No</th>
                            <th>first Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Position</th>
                            <th>Email</th>
                            
                            <th>Action</th>
                        </thead>
                        <tbody>

                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->name  }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->position }}</td>
                                <td>{{ $user->email }}</td> 

                                <td>
                                
                                    <a class="btn btn-primary" href="{{ route('showUser', ['id' => $user->id ] ) }}">
                                        show
                                    </a>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-danger">
                        <strong>Pas d'utilisateur  dans la base de données</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
