@extends('layouts.template') <!-- use template from previous slide -->
@section('main') <!-- define a section called main -->
<div class="alert alert-info"> Updating in progress...</div>
<div class="container-fluid">
	<table class="table table-bordered table-striped text-center table-condensed table-hover">
		<thead>
			<th>Name</th>
			<th>Role</th>
			<th>Button to switch role</th>
			<th>Button to update</th>
		</thead>
		<tbody>
			<script>
			var count = 1;
			</script>
		@foreach($users as $user)
			
			<tr>
				<td>{{$user->name}}</td>
				<td>{{$user->role}}</td>
				
				
				<td>
				<div>
					<button type ="button" id="demo" onclick="myFunction(this)">Click to select the role you want this user to change to.</button>

					<script>
						
						//var x = 1;
						var USER = 1;
						var MOD = 0;
						var admin = 2;
						var x = {{$user->role}}-1;
						var newId = "demo" + parseInt(count);
						document.getElementById("demo").setAttribute("id",newId);
						document.getElementById("demo").setAttribute("id",newId);
						document.getElementById(newId).setAttribute("tag",count);
					function myFunction(element) {
						x = (1 + x)%3;
						var newId = element.id;
						
						if(x == 1){
							
							document.getElementById(newId).className = "btn btn-info";
							document.getElementById(newId).textContent="USER";
							//document.getElementById("demo").setAttribute("id",newId);
						}else if(x == 0){
							document.getElementById(newId).className = "btn btn-warning";
							document.getElementById(newId).textContent="MOD";
							//document.getElementById("demo").setAttribute("id",newId);
						}
						else if(x == 2){
							document.getElementById(newId).className = "btn btn-danger";
							document.getElementById(newId).textContent="ADMIN";
							//document.getElementById("demo").setAttribute("id",newId);
						}else{
							document.getElementById(newId).className = "btn btn-default";
							document.getElementById(newId).textContent="ERROR";
							//document.getElementById("demo").setAttribute("id",newId);
						}
					}
					</script>
				</div>
				
				</td>
				<td>
				
				<div>
					<button type ="button" id="update" onclick="updateToDatabase"><p id="updateButton">Update</p></button>

					<script>
//					function updateToDatabase() {
//						document.getElementById("demo").className = "btn btn-info";
//						
//					}
					</script>	
				</div>
				
				</td>
			</tr>
			<script>count = count + 1;</script>
			@endforeach
			
		</tbody>
	</table>
</div>                
@stop

@section('script')
<script type="text/javascript" src="/js/index.js">
</script>

 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@stop
