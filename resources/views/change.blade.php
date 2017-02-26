@extends('layouts.template') <!-- use template from previous slide -->
@section('main') <!-- define a section called main -->
<div class="alert alert-info"> It's WORKING!!</div>
<div class="container-fluid">
	<table class="table table-bordered table-striped text-center table-condensed table-hover">
		<thead>
			<th>Name</th>
			<th>Change</th>
			<th>Button to switch role</th>
			<th>Button to update</th>
		</thead>
		<tbody>
		
			<tr>
				<td>User</td>
				<td>Role
				<script>
					
				var x = 2;	
				</script>
				
				</td>
				<td>
				<div>
					<button type ="button" id="demo" onclick="myFunction()"><p id="demo2">Change Role?</p></button>

					<script>
						
						//var x = 1;
						var USER = 1;
						var MOD = 0;
						var admin = 2;
						
					function myFunction() {
						x = (1 + x)%3;
						if(x == 1){
							document.getElementById("demo").className = "btn btn-info";
							document.getElementById("demo").textContent="USER";
						}else if(x == 0){
							document.getElementById("demo").className = "btn btn-warning";
							document.getElementById("demo").textContent="MOD";
						}
						else if(x == 2){
							document.getElementById("demo").className = "btn btn-danger";
							document.getElementById("demo").textContent="ADMIN";
						}else{
							document.getElementById("demo").className = "btn btn-default";
							document.getElementById("demo").textContent="ERROR";
						}
					}
					</script>
				</div>
				
				</td>
				<td>Update changes to database
				
				<div>
					<button type ="button" id="update" onclick="updateToDatabase"><p id="demo2">Update</p></button>

					<script>
						
						
					function updateToDatabase() {
						document.getElementById("demo").className = "btn btn-info";
						
					}
					</script>	
				</div>
				
				</td>
			</tr>
			
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
