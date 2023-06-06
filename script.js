
//form animation
$("#signUp").click(function(){
	$("#container").addClass("right-panel-active");
  });


$("#signIn").click(function(){
	$("#container").removeClass("right-panel-active");
  });



//sign up submit
//using ajax to send the form data to backend and getting response
var form = $('#sign-up');
form.submit(function (e) {
    e.preventDefault();
	$("#name,#email,#password,#secpassword").html('');

  const formData = new FormData(e.target);
  const formProps = Object.fromEntries(formData);
  var signUp = JSON.stringify(formProps);
 $.post('api.php',{signUp}).then(res=>{
if(res[0]==1){
	Swal.fire(
		'Signed Up.',
		'You successfully signed up!',
		'success'
	  ).then((value) => {
	  window.location.replace("http://localhost/project");})
}else{
	console.log(res)
    var errors=JSON.parse(res);

    $.each(errors, function( index, value ) {
        if(!value==""){
            console.log(index)
            $('#'+index).html(value)
        }
      });
}
res=null;
add=null;

    });
});



//sign in button
//using ajax to send the form data to backend and getting response
var form = $('#sign-in');
form.submit(function (e) {
    e.preventDefault();
	$("#in-email,#in-password").html('');

  const formData = new FormData(e.target);
  const formProps = Object.fromEntries(formData);
  var signIn = JSON.stringify(formProps);
 $.post('api.php',{signIn}).then(res=>{
if(res[0]==1){
	Swal.fire(
		'welcome back!.',
		'You successfully signed in!',
		'success'
	  ).then((value) => {
	  window.location.replace("http://localhost/project");})
}else{
	console.log(res)
    var errors=JSON.parse(res);

    $.each(errors, function( index, value ) {
        if(!value==""){
            console.log(index)
            $('#in-'+index).html(value)
        }
      });
}
res=null;
add=null;

    });
});

