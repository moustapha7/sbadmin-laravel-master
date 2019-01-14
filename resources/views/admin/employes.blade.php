@extends('layouts.app')

@section('content')

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Employes</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
        <div class="card-body">
          <i class="fa fa-table"></i> Employes Tables </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Position</th>
                  <th>Team</th>
                  <th colspan="2">Action</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                <th>First Name</th>
                  <th>Last Name</th>
                  <th>Position</th>
                  <th>Team</th>
                  <th colspan="2">Action</th>
                </tr>
              </tfoot>
              <tbody>
              @if(!empty($employes))
              @foreach($employes as $emp)
                <tr>
                  <td>{{$emp->first_name}}</td>
                  <td>{{$emp->last_name}}</td>
                  <td>{{$emp->position}}</td>
                  <td>@if($emp->Team){{$emp->Team->name}}@endif</td>
                  <td><a href="{{action('EmployeController@show',$emp->id)}}">Edit</a></td>
                  <td><button class="btn btn-danger">Delete</button></td>
                </tr>
                
              @endforeach
              @endif
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Helix Technology Groupe 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection