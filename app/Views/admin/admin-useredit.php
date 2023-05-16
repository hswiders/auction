<?php include ('include/header.php') ?>

<style>
    .dashboard {
        background-color: #5662a6;
    }
    span.nav-text {
        color: white;
    }
    .deznav {
        padding: 20px 5px 0px 5px !important;
    }
    li {
        padding-top: 5px;
        padding-bottom: 5px;
    }
    i.fa {
        color: white;
    }
    .row.forms {
        margin-right: 0px;
        margin-left: 0px;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .btn {
        font-family: 'MetaSerifPro';
        font-size: 14px;
    }
</style>
<div class="page-header">
	<div class="container">
		<div class="d-flex">
			<h1>Admin dashboard</h1>
		</div>
	</div>
</div>
<div class="admin-dash">
	<div class="container">
        <div class="row">
            <?php include ('include/sidebar.php') ?>
            <div class="col-md-9">
        		<div class="table-part">
                    
            			<h4>"<?= $edit['first_name']. ' ' .$edit['last_name']?>" Edit:
                        </h4>
            		
            		    <div class="table-responsive">		
            		      
                            <form id="user_update" action="#", method="post", onsubmit="return user_update()">
                                <input class="form-control" type="hidden" name="id" value="<?= $edit['id'] ?>">
                                <div class="row forms">
                                    <div class="col-md-6">
                                        <div><input class="form-control" type="text" name="first_name" value="<?= $edit['first_name'] ?>"></div>
                                    </div>
                                    <div class="col-md-6">     
                                        <div><input class="form-control" type="text" name="last_name" value="<?= $edit['last_name'] ?>"></div> 
                                    </div>
                                </div>
                                <div class="row forms">
                                    <div class="col-md-6">
                                        <div><input class="form-control" type="email" name="email" value="<?= $edit['email'] ?>" readonly></div>
                                    </div>
                                    <div class="col-md-6">     
                                        <div><input class="form-control" type="text" name="username" value="<?= $edit['username'] ?>" readonly></div> 
                                    </div>
                                </div>
                                
                                <div class="row forms">
                                    <div class="col-md-6">
                                <?php $currency = $this->common_model->GetAllData('currency' , '' ,  'id' , 'desc') ?>
                                <label class="col-md-6 m-0">Currency: </label>
                                <select class="form-control" name="currency">
                                    <option value="0">Select Currency</option>
                                    <?php
                                        foreach($currency as $value) {
                                            $selected = '';
                                            if($value['id'] == $edit['currency']) $selected = ' selected';
                                            ?>
                                            <option value="<?=$value['id']?>" <?=$selected?>><?=$value['title']?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                </div>
                                </div>
                                
                                <div class="form-group mb-4"> 
                              <div class="col-md-12 text-center">
                                <button type="submit" id="sub_btn" class="btn btn-primary btn-lg w-100">Update User Info</button>
                              </div>
                            </div>

                            </form>     
                        </div>
            	   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ('include/footer.php') ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcpNpTtV_czTWzF9IJzqDpAnmcMI3yUlY&libraries=places&callback=initMap" async defer></script>
<script type="text/javascript">
var selected = false;
function initMap() 
{
    //var input = document.getElementById('address');
    var input = document.getElementById('address');

    var autocomplete = new google.maps.places.Autocomplete(input);
   
   // autocomplete.setComponentRestrictions({'country': ['in']});     
    autocomplete.addListener('place_changed', function() 
    {
        var place = autocomplete.getPlace();
        console.log(place);
        selected = true;
          
      // document.getElementById('lattitude').value = place.geometry.location.lat();
      // document.getElementById('longitude').value = place.geometry.location.lng();
      
            if (place) 
      {
          var city = "";
          var state = "";
          var country = "";
          var zipcode = "";
          
         var address_components = place.address_components;
          
          for (var i = 0; i < address_components.length; i++) 
          {
             if (address_components[i].types[0] === "administrative_area_level_1" && address_components[i].types[1] === "political") {
                  state = address_components[i].long_name;    
              }
              if (address_components[i].types[0] === "locality" && address_components[i].types[1] === "political" ) {                                
                  city = address_components[i].long_name;   
              }
              
              if (address_components[i].types[0] === "postal_code" && zipcode == "") {
                  zipcode = address_components[i].long_name;

              }
              
              if (address_components[i].types[0] === "country") {
                  country = address_components[i].long_name;

              }
          }
        $('#city').val(city)
        $('#state').val(state)
        $('#country').val(country)
        $('#zip').val(zipcode)
     } 
     else 
     {
         window.alert('No results found');
     }
  });
   
}
$('#address').on('focus', function() {
  selected = false;
  }).on('blur', function() {
    if (!selected) {
      $(this).val('');
    }
  });
</script>

<script>
    
    $(document).ready(function() {
    $('.select2').select2();

    var val = new Array();
     <?php foreach ($languages as $key => $value): ?> 
     <?php $lang_data = explode(',', $edit['languages']); ?>
     <?php if(in_array($value['id'], $lang_data) ){

        ?>
        val.push(<?= $value['id'] ?>);
        <?php
     } ?> 
        
     <?php endforeach ?>
      $(".select2").select2().val(val).trigger('change.select2');
    
    });

    function user_update() {
      $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/Admin/Users/update_user',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:new FormData($('#user_update')[0]),
      dataType: 'json',
      beforeSend: function() {        
        $('#sub_btn').prop('disabled' , true);
        $('#sub_btn').text('Processing..');
      },
      success : function(res){
        $('#sub_btn').prop('disabled' , false);
        $('#sub_btn').text('Update');
        if (res.status == 1) {

           Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
            location.reload();
            })
          
        }
        else
        {
         
          $('#result').html(res.message);
          for (var err in res.validation) {
            
            $("[name='" + err + "']").after("<div  class='label alert-danger'>" + res.validation[err] + "</div>");
          }
        }
      }
    });
return false;
}

$('#dob').on('change', function(event) {
    dob = new Date($(this).val());

    age = _calculateAge(dob);
    $('#age').val(age)
});  
function _calculateAge(birthday) { // birthday is a date
    var ageDifMs = Date.now() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}
</script>