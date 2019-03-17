
function submitlogin() {
var form = document.login;
if(form.username.value == "") {
alert( "Enter username." );
return false;
}
else if(form.password.value == ""){
alert( "Enter password." );
return false;
}
}

