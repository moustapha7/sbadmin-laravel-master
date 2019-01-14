<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>HELIX Project Management Tool</title>
    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- Custom fonts for this template-->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> <!-- latest 5.0.13 june 2018, needs update -->
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin.css" rel="stylesheet">
</head>

@isset($bodyclass)
    <body class="{{$bodyclass}}" id="page-top">
@endisset
@empty($bodyclass)
    <body class="fixed-nav sticky-footer bg-dark" id="page-top">
@endempty


@yield('content')

@empty($hidenav)
    @include('layouts.nav')
@endempty

<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<!-- Core plugin JavaScript <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"> </script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.compatibility.js" integrity="sha256-MWsk0Zyox/iszpRSQk5a2iPLeWw0McNkGUAsHOyc/gE=" crossorigin="anonymous"></script>

<!-- Page level plugin JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js" integrity="sha256-JG6hsuMjFnQ2spWq0UiaDRJBaarzhFbUxiUTxQDA9Lk=" crossorigin="anonymous"></script>

<script src="/../../assets/js/jquery-ui.js"></script>

<script src="/vendor/datatables/jquery.dataTables.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom scripts for all pages-->
<script src="/js/sb-admin.js"></script>

<!-- Custom scripts for this page-->
<script src="/js/sb-admin-datatables.js"></script>
<script src="/js/sb-admin-charts.js"></script>

<script>
    $('#toggleNavPosition').click(function() {
        $('body').toggleClass('fixed-nav');
        $('nav').toggleClass('fixed-top static-top');
    });

    $('#toggleNavColor').click(function() {
        $('nav').toggleClass('navbar-dark navbar-light');
        $('nav').toggleClass('bg-dark bg-light');
        $('body').toggleClass('bg-dark bg-light');
    });
</script>

<script>
   var name = $('#name').val();
   if(name.trim() == ''){
    document.getElementById("requestedDate").valueAsDate = new Date();
    document.getElementById("estcompletedDate").valueAsDate = new Date();
        var start = new Date($('#requestedDate').val());
        var end = new Date($('#estcompletedDate').val());
        // end - start returns difference in milliseconds 
        var diff = new Date(end - start);
        // get days
        var days = diff/1000/60/60/24;
        var hours = diff/1000/60/60;
        $('#estDay').val(days);
        $('#estHour').val(hours);
   }
    
    $('#employe_id').change(function() {
        var obj = JSON.parse(this.value);
        $('#posit').val(obj.position);
    });

   /*$('#employe_id').autocomplete({
       source: "{URL::route('/admin/autocompletion')}",
       minLength: 4,
       select: function(event, ui){
           alert(ui.item.value);
           $('#employe_id').val(ui.item.value);
       }
    });*/

    $('#estcompletedDate').change(function(){
        var start = new Date($('#requestedDate').val());
        var startdays = start/1000/60/60/24;
        var end = new Date(this.value);
        var enddays = end/1000/60/60/24;
        if(startdays > enddays){
            document.getElementById("estcompletedDate").valueAsDate = new Date();
            alert('Requested date can\' be upper Est. Completed Date');
        }else{
        // end - start returns difference in milliseconds 
        var diff = new Date(end - start);
        // get days
        var days = diff/1000/60/60/24;
        var hours = diff/1000/60/60;
        $('#estDay').val(days);
        $('#estHour').val(hours);
       // alert(startdays);
    }
    });

    $('#requestedDate').change(function(){
        var start = new Date(this.value);
        var startdays = start/1000/60/60/24;
        var end = new Date($('#estcompletedDate').val());
        var enddays = end/1000/60/60/24;
        if(startdays > enddays){
            document.getElementById("requestedDate").valueAsDate = new Date();
            alert('Requested date can\' be upper Est. Completed Date');
        }else{
        
        // end - start returns difference in milliseconds 
        var diff = new Date(end - start);
        // get days and hours
        var days = diff/1000/60/60/24;
        var hours = diff/1000/60/60;
        $('#estDay').val(days);
        $('#estHour').val(hours);
        //alert(diff);
        }
    });

     $('#type').change(function(){
       // 
       // 
        if(this.value =='Reassigned'){
            $('#reassignedComment').toggleClass('invisible');
        }else{
            $('#reassignedComment').toggleClass('invisible');
        }
    });
</script>

</body>
</html>

<style type="text/css">
.visible{
    display: block;
    opacity:1;
    visibility: visible;
}
.invisible{
    display: none;
    opacity:0;
    visibility: invisible;
}
</style>