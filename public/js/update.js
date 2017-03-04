$('#user_id').change(updateEmail);

function updateEmail() {
	for(var i=0;i<userlist.length;i++){
		if($('#user_id').val()==userlist[i].id){
			var email=userlist[i].email;
			break;
		}
	}
    $('#user_email').val(email);
}

$('#user_id').change(updateRole);

function updateRole() {
	for(var i=0;i<userlist.length;i++){
		if($('#user_id').val()==userlist[i].id){
			var role=userlist[i].role;
			break;
		}
	}
    $('#user_role').val(role);
}