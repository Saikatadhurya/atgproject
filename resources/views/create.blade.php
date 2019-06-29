@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
  .card{max-width:800px;
  }
</style>

<div class="card uper">
  <div class="card-header">
    Add Details
  </div>
  <div class="card-body">

 <div class="alert alert-success" style="display:none"></div>
  <div class="alert alert-danger" style="display:none"></div>
      <form method="post" name="myform" onsubmit="return validateform()">
{!! csrf_field() !!}
          <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" name="name"/>
          </div>
          <div class="form-group">
              <label for="email">Email :</label>
              <input type="email" class="form-control" id="email" name="email"/>
          </div>
          <div class="form-group">
              <label for="pincode">Pincode :</label>
              <input type="number" class="form-control" id="pincode" name="pincode"/>
          </div>
          <input type="submit" class="btn btn-primary" id="ajaxSubmit" value="Submit Entry"/>
      </form>
  </div>
</div>
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
             integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
             crossorigin="anonymous">
    </script>

<script>  
function validateform(){  
var name=document.myform.name.value;  
var pincode=document.myform.pincode.value;  
var email=document.myform.email.value;  
if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
{
  return (true)
}else
{
  alert("Enter Valid Email Address");  
  return false;  
} 
if(pincode.length == 5){  
  alert("Pincode must be 6 characters long.");  
  return false;  
  }  
}  
</script> 

    <script>
       jQuery(document).ready(function(){
          jQuery('#ajaxSubmit').click(function(e){
             e.preventDefault();
             $('.alert-danger').hide();
        $('.alert-danger').html('');
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
             jQuery.ajax({
                url: "{{ url('form') }}",
                method: 'post',
                
                data: {
                   name: jQuery('#name').val(),
                   email: jQuery('#email').val(),
                   pincode: jQuery('#pincode').val()
                },
                success: function(result){

                 if(result.success) 
                 {
                   jQuery('.alert-success').show();
                   jQuery('.alert-danger').hide();
                   jQuery('.alert-success').html(result.success);
                 }
                 if(result.errors) 
                 {
                jQuery.each(result.errors, function(key, value){
                  jQuery('.alert-success').hide();
                  			jQuery('.alert-danger').show();
                  			jQuery('.alert-danger').append('<p>'+value+'</p>');
                        
                 });
                
                 }
                }
             
              });
             });
          });
    </script>
    
@endsection
