@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="containe">
            <div class="row justify-content-center ">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header"><h3>Details User</h3></div>
                        <div class="card-body ml-4">
                            <div class="row ">
                                <div class="col-4">
                                    <h4>First Name : @if(!empty($user)) {{$user->first_name}}  @endif</h4>
                                    <h4>Last Name : @if(!empty($user)) {{$user->name}}  @endif</h4>                      
                                </div>

                                
                                <a data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" class="btn btn-primary" href="{{ route('showUser', ['id' => $user->id ] ) }}">
                                @if(!empty($team)) Add team @else Edit  team  @endif 
                                </a>
                               
                                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add This user to Team</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('updateUser') }}" method="post">
                                                 @csrf
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">first Name</label>
                                                        <h4>{{ $user->first_name}}</h4>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Last Name</label>
                                                        <h4>{{ $user->name  }}</h4>
                                                    </div>

                                                    <input value="{{$user->id}} " type="hidden" id="id" name="id" />
                                                  

                                                    <input value="@if(!empty($user)) {{$user->first_name}}  @endif  " type="hidden" id="first_name" name="first_name" />
                                                    <input value="@if(!empty($user)) {{$user->name}} @endif" type="hidden" id="name" name="name" />
                                        
                                                    <input value="@if(!empty($user)) {{$user->phone}} @endif" type="hidden" id="phone" name="phone" />
                                                    <!--<input value="@if(!empty($user)) {{$user->position}} @endif" type="hidden" id="position" name="position" />
                                                    -->



                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Attribuer à un Team</label>
                                                        <select name="team_id" id="team_id" class="form-control{{ $errors->has('team') ? ' is-invalid' : '' }}">
                                                                <option>sélectionner un team...</option>    
                                                            @if(!empty($teams))
                                                                @foreach($teams as $team)
                                                                <option value="{{$team->id}}">{{$team->name}}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>

                                                    <input value="@if(!empty($user)) {{$user->email}} @endif" type="hidden" id="email" name="email" />
                                                   <!-- <input value="@if(!empty($user)) {{$user->password}} @endif" type="hidden" id="password" name="password" />
                                                    -->

                                                    <div class="form-group row mb-0" >
                                                        <div class="col-md-6 offset-md-4 ">
                                                        @if(empty($users))
                                                            <button type="submit" class="btn btn-primary bouton">
                                                               Save
                                                            </button>
                                                        @endif 

                                                       
                                                        
                                                          
                                                    
                                                        </div>
                                                    </div>

                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                    <script>
                                        $('#exampleModal').on('show.bs.modal', function (event) {
                                        var button = $(event.relatedTarget) // Button that triggered the modal
                                        var recipient = button.data('whatever') // Extract info from data-* attributes
                                        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                                        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                                        var modal = $(this)
                                        modal.find('.modal-title').text('New message to ' + recipient)
                                        modal.find('.modal-body input').val(recipient)
                                        })

                                    </script>
                               
                            </div>
                            <div class="row ">
                                <div class="col-12">
                                    <hr>
                                    <h4>Email  : @if(!empty($user)) {{$user->email}}  @endif</h4>
                                    <h4>Phone : @if(!empty($user)) {{$user->phone}}  @endif</h4>                      
                                </div>
                               
                            </div>

                            <div class="row ">

                                <div class="col-12">
                                    <hr>
                                    <h3>Position</h3>
                                    <h5>@if(!empty($user)) {{$user->position}} @endif</h5>
                                </div>

                                 <div class="col-12">
                                    <hr>
                                    <h3>Team :</h3>
                                    <h5>@if(!empty($user)) {{$user->team_id}} @endif</h5>
                                </div>

                                
                            </div>


                        </div>
                    </div>
                </div>
            </div>
           

        </div>
    </div>
</div>
@endsection
