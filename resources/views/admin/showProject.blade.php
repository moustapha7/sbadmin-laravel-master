@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="containe">
            <div class="row justify-content-center ">
                <div class="col-md-12">
                    <div class="card card-default text-white 
                         @if($project->status=='Suspended')) {{'bg-warning'}}
                         @elseif($project->status=='Completed'))  {{'bg-success'}} 
                         @elseif($project->status=='Ongoing'))  {{'bg-primary'}}
                         @elseif($project->status=='Cancelled'))  {{'bg-danger'}}
                         @else {{''}} 
                         @endif ">
                        <div class="card-header"><h3>@if(!empty($project)) {{$project->status." project ".$project->name}} @else Nothing to Show @endif</h3></div>
                        <div class="card-body ml-4">
                            <div class="row ">
                                <div class="col-4">
                                    <h4>Project Type : @if(!empty($project)) {{$project->type->name}} @else {{"Default"}} @endif</h4>
                                    <h4>Description</h4>
                                    <p>@if(!empty($project)) {{$project->description}} @else Default @endif</p>
                                    @if(!empty($project)) 
                                    @foreach($project->employes as $emp)
                                    <h4>{{$emp->pivot->type.' To : '.$emp->first_name." ".$emp->last_name}}</h4>
                                    @if($emp->pivot->type == "Assigned") {{'Assigend Date: '.\Carbon\Carbon::parse($emp->pivot->assignedDate)->format('d/m/Y')}} @endif
                                    @if($emp->pivot->type == "Reassigned") 
                                    {{'Reassigend Date: '.\Carbon\Carbon::parse($emp->pivot->reassignedDate)->format('d/m/Y')}} 
                                    <h5>Reassignment Raison</h5>
                                    {{$emp->pivot->comment}} 
                                    @endif
                                    @endforeach 
                                    @else {{'Default'}} 
                                    @endif

                                </div>
                                <div class="col-4">
                                    <h4>Requested Date : @if(!empty($project)) {{\Carbon\Carbon::parse($project->requestedDate)->format('d/m/Y')}} @else {{"Default"}} @endif</h4>
                                    <h4>Est. Compl. Date : @if(!empty($project)) {{\Carbon\Carbon::parse($project->estcompletedDate)->format('d/m/Y')}} @else Default @endif</h4>
                                    <h4>Est. Days : @if(!empty($project)) {{$project->estDay}} @else Default @endif</h4>
                                    <h4>Est. Hours : @if(!empty($project)) {{$project->estHour}} @else Default @endif</h4>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-12">
                                    <hr>
                                    <h3>Requestor Information</h3>
                                    <h5>Name : @if(!empty($project)) {{$project->Client->name." / Phone: ".$project->Client->phone." / E-mail: ".$project->Client->email}} @else {{"Default"}} @endif</h5>
                                    <h5>Contact name : @if(!empty($project)) {{$project->Client->contactAdresse." / Phone: ".$project->Client->contactPhone." / E-mail: ".$project->Client->contactEmail}} @else {{"Default"}} @endif</h5>
                                </div>
                                <div class="col-12 ">
                                    <div class="pull-right">
                                        <a  href="{{ action('ProjectController@edit', $project->id) }}">
                                            <button type="submit" class="btn btn-default">Edit</button>
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

            
           







            <a class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Views Comments </a>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Comments Lists</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                         @if (count($comments) > 0)
                            <div class="row ">
                            @foreach ($comments as $comment)
                                 <div class="col-12">
                                    <hr>
                                    <h3>@if(!empty($comment)) {{$comment->user->name}} @endif</h3>
                                    <h6><strong>Project Name :</strong> @if(!empty($comment))                                     {{$comment->project->name}} @endif</h6>

                                    <h6>@if(!empty($comment)) {{$comment->content}} @endif</h6>
                                    
                                    <div class="pull-right">
                                        <a  href="{{ route('deleteComment', ['id' => $comment->id ] ) }}" >
                                             <i class="fa fa-trash-o" style="font-size:24px;color:red" title="Delete this commentaire"></i>            
                                        </a>
                                    </div>
                                    
                                </div>
                            @endforeach    
                                                                
                            </div>
                        @endif 
                       
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



             <div class="row">
                <div class="col-md-6" style="padding=0.5em;">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('createComment') }}">
                                @csrf
                            
                                <input value="@if(!empty($project)) {{$project->id}} @endif" type="hidden" id="project" name="project" />
                                <input value="@if(!empty($task)) {{$task->id}} @endif" type="hidden" id="task" name="task" />
                                

                                <div class="form-group row mb-4 pull-rigth" >
                                    <label>Add new comments</label>
                                    <textarea id="comment" class="form-control{{ $errors->has('commentreassigned') ? ' is-invalid' : '' }}" name="content" value="" rows="3">
                                    </textarea>
                                </div>
                                <div class="form-group row mb-0 pull-rigth" >
                                    <div class="">
                                        <button type="submit" class="btn btn-primary bouton">
                                            Comment
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card comment"> 
                        <div class="card-body">

                            @if (count($comments) > 0)
                                <div class="row ">
                                @foreach ($comments as $comment)
                                    <div class="col-12">
                                        <hr>
                                        <h3>@if(!empty($comment)) {{$comment->user->name}} @endif</h3>
                                        <h6><strong>Project Name :</strong> @if(!empty($comment)) {{$comment->project->name}} @endif</h6>

                                        <h6>@if(!empty($comment)) {{$comment->content}} @endif</h6>
                                        
                                        <div class="pull-right">
                                            <a  href="{{ route('deleteComment', ['id' => $comment->id ] ) }}" >
                                                <i class="fa fa-trash-o" style="font-size:24px;color:red" title="Delete this commentaire"></i>            
                                            </a>
                                        </div>
                                        
                                    </div>
                                @endforeach    
                                                                    
                                </div>
                            @endif  

                        </div>
                    </div>
                </div>
            </div>


           

        </div>
    </div>
</div>
@endsection
