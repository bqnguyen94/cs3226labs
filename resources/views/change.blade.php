@extends('layouts.template') <!-- use template from previous slide -->
@section('main') <!-- define a section called main -->

<div class="container-fluid">
	<table>
		<script>
			var x = 0;
		</script>
		<thead>
			<th>Name</th>
			<th>Change</th>
			<th>Button to switch role</th>
			<th>Button to update</th>
		</thead>
		<tbody>
		
			<tr>
				<td>User</td>
				<td>Role</td>
				<td>Retrieve current role
				<div>
					<p id="demo" onclick="myFunction()">Click me to change my text color.</p>

					<script>
						
						var x = 1;
					function myFunction() {
						x = (1 + x)%2;
						if(x == 1){
							document.getElementById("demo").style.color = "red";
						}else{
							document.getElementById("demo").style.color = "blue";
						}
					}
					</script>
				</div>
				
				</td>
				<td>Update changes to database
				
				<div>
						
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
@stop
