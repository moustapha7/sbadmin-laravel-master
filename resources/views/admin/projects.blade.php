@extends('layouts.app')

@section('content')

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Projects</li>
      </ol>
      <div class="row mb-4">
      <div class="col-12 ">
      <span class="badge badge-primary">On going Project</span>
      <span class="badge badge-success">Completed Project</span>
      <span class="badge badge-warning">Suspended Project</span>
      <span class="badge badge-danger">Cancelled Project</span>
      </div>
      </div>
      <div class="row">
      @if(!empty($projects))
          @foreach($projects as $proj)
            <div class="col-xl-3 col-sm-6 mb-3">
                <div class="card text-white  o-hidden h-100 
                @if($proj->status=='Suspended')) {{'bg-warning'}}
                @elseif($proj->status=='Completed'))  {{'bg-success'}} 
                @elseif($proj->status=='Ongoing'))  {{'bg-primary'}}
                @elseif($proj->status=='Cancelled'))  {{'bg-danger'}}
                @else {{''}} 
                @endif"  >
                  <div class="card-header">
                    <div class="card-body-icon">
                      <i class="fa fa-fw fa-support"></i>
                    </div>
                    <div class="mr-5"><h5> {{$proj->name}}</h5></div>
                  </div>
                  <div class="card-body">
                    <h5>Type: {{$proj->Type->name}}</h5>
                    <h5>@foreach($proj->employes as $emp)
                      {{$emp->pivot->type.' To: '.$emp->first_name." ".$emp->last_name}} 
                    @endforeach </h5>
                    <h5>Requested By</h5>
                    <p class="pdes">{{$proj->Client->name." / Phone: ".$proj->Client->phone}}</p>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="project/{{$proj->id}}/show">
                    <span class="float-left">{{$proj->tasks->count()}} Tasks</span>
                    <span class="float-right">
                    View Tasks <i class="fa fa-angle-right"></i>
                    </span>
                  </a>
                  <a class="card-footer text-white clearfix small z-1" href="project/{{$proj->id}}/show">
                    <span class="float-left">View Projects Details</span>
                    <span class="float-right">
                      <i class="fa fa-angle-right"></i>
                    </span>
                  </a>
                </div>
            </div>
          @endforeach
        @endif
        </div>
    </div>
  </div>
@endsection