@extends('layouts.template') <!-- use template from previous slide -->
@section('main') <!-- define a section called main -->

<div class="alert alert-info"> Updating in progress...</div>
<div class="container-fluid">
	<table class="table table-bordered table-striped text-center table-condensed table-hover">
		<thead>
			<th > No.</th>
			<th >Name</th>
			<th >Role</th>
			<th >Email</th>
			<th >Switch role</th>
			<th >Update</th>
		</thead>
		<tbody>
			<script>
			var count = 1;
			</script>
		@foreach($users as $user)
			
			<tr id="rowHeight">
				<td>{{$user-> id}}</td>
				
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->role}}</td>
				
				
				<td>
				<div>
					<button type ="button" id="demo" onclick="myFunction(this)">Change Role</button>

					<script>
						
						var userID = "";
						var newRole;
						var userEmail = "";
						
						var roleType;
						var currentId;
						
						//var x = 1;
						var USER = 1;
						var MOD = 0;
						var admin = 2;
						var x = {{$user->role}}-1;
						var newId = "demo" + parseInt(count);
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
					

					<button type ="button" onclick="updateToDatabase(this)" id="update"><p>Click here to update.</p></button>

					
<!--
					<div id="mybox" style="display:visible"> 
					<p>testing</p>
						{!! Form::open() !!} 
						<div class="form-group"> 
						 

												<--?php 

						echo Form::text('email', $email, ['class' => 'form-control']); 


						?>

					  	{!! Form::radio('mcq', '9', false, ['class' => 'form-control']) !!}A.9
						  {!! Form::radio('mcq', '10', false, ['class' => 'form-control']) !!}B.10
						  {!! Form::radio('mcq', '11', false, ['class' => 'form-control']) !!}C.11
							
							
							
							
						</div>
							
					</div>

					<div class="form-group">
						<button id="formSubmitId" type="submit" class="btn btn-success" style="display:visible" >Submit</button>
						</div>
						{!! Form::close() !!}	
-->

					<script>
						var newId = "update" + parseInt(count);
						var newId2 = "mybox" + parseInt(count);
						var newId3 = "formSubmitId" + parseInt(count);
						var rowH = "rowHeight" + parseInt(count);
						
						document.getElementById("update").setAttribute("id",newId);
						
						document.getElementById("mybox").setAttribute("id",newId2);
						document.getElementById("formSubmitId").setAttribute("id",newId3);
						
						document.getElementById("rowHeight").setAttribute("id", rowH);
						
						document.getElementById(rowH).innerHeight="50px";
						document.getElementById(newId).setAttribute("tag",count);
						
						
						
			
					function updateToDatabase(element) {
						var elementId = element.id;
						var rowNum = parseInt(element.getAttribute("tag"));
						
						var formId = "formSubmitId" + rowNum;
						
						var rowH = "rowHeight" + rowNum;
						roleType = element.getAttribute("textContent");
						currentId = rowNum;
						
						if(rowNum == 0){
							document.getElementById(elementId).textContent = "Updated.";
						}else{
							document.getElementById(elementId).className = "btn btn-info";
							console.log(rowNum);
							console.log(elementId);
							document.getElementById(elementId).setAttribute("tag","0");
							document.getElementById(rowH).innerHeight="300px";
							document.getElementById(formId).style.display = 'table-cell';
							
					
							 
						}
						
					}
						
					
					</script>	
				
				
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
