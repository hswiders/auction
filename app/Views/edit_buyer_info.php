<?php include ('include/header.php') ?>
<style type="text/css">
	@media screen and (min-width: 48em)
	{
		.css-1mqb8fg-component-container 
		{
       	max-width: 33%;
       	min-width: 500px;
		}
		.css-1ivirvl 
		{
    	 font-size: clamp(28px, calc(1.8518518519vw + 21.3333333333px), 48px);
		}
      .css-11k3riy {
          font-size: 1.25rem;
      }
      .css-ll5aml {
          height: 35px;
      }

	}
	@media screen and (min-width: 30em)
	{
		.css-1mqb8fg-component-container {
		   max-width: 90%;
		   min-width: 0px;
		}
		.css-1ivirvl 
		{
   		 font-size: clamp(24px, calc(0.7407407407vw + 21.3333333333px), 32px);
		}
      .css-11k3riy {
          font-size: var(--chakra-fontSizes-lg);
      }
	}
.css-1mqb8fg-component-container {
 max-width: 90%;
 min-width: 0px;
 margin: auto;
}
.css-d1s72j {
    padding-top: 2rem;
    padding-bottom: 2rem;
}

.css-1ivirvl {
    font-weight: 500;
    font-size: clamp(24px, calc(0.7407407407vw + 21.3333333333px), 32px);
    line-height: 1.3;
    min-height: 0vw;
}
.css-11k3riy {
    font-weight: 400;
    font-size: 1.125rem;
    line-height: 1.3;
    min-height: 0vw;
    margin-bottom: 2.5rem;
}
.css-fnqqvq {
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-appearance: none;
    -moz-appearance: none;
    -ms-appearance: none;
    appearance: none;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    position: relative;
    white-space: nowrap;
    vertical-align: middle;
    outline: 2px solid transparent;
    outline-offset: 2px;
    width: auto;
    line-height: 1.375;
    border-radius: 0px;
    font-weight: 400;
    font-style: normal;
    -webkit-padding-start: 1rem;
    padding-inline-start: 1rem;
    -webkit-padding-end: 1rem;
    padding-inline-end: 1rem;
    padding-top: 0.375rem;
    padding-bottom: 0.375rem;
    height: 32px;
    min-width: auto;
    background: #e0e0e0;
    border: 1px solid #e0e0e0;
    background-color: #fff;
    width: 100%;
    font-weight: 500;
    margin: 10px 0px;
    padding: 12px 18px;
    height: unset;
    font-size: 1em;
    display: -webkit-box;
    display: -webkit-unset;
    display: -ms-unsetbox;
    display: unset;
}
.css-70qvj9 {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-align-items: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}
.css-ll5aml {
    height: 24px;
    margin: 5px;
    
}
.css-1kw2fa0 {
    margin-left: 0.75rem;
}
</style>
<div class="account-page">
	<div class="row">
		<div class="col-sm-12">
			<div class="css-1mqb8fg-component-container">
   <div data-testid="payment-selection-wrapper" class="css-d1s72j">
      <h2 class="chakra-heading css-1ivirvl">Billing/Shipping</h2>
      <h3 class="chakra-heading css-11k3riy">Please choose your payment method</h3>
      <div class="payment-options">
         
         <button type="button" class="chakra-button css-fnqqvq" data-testid="payment-btn-paypal" onclick="do_create_agreement(event)">
            <div class="css-70qvj9">
               <img alt="Paypal" src="<?= base_url('assets/img/badge-paypal.png') ?>" class="chakra-image css-ll5aml">
               <div class="css-1kw2fa0">PayPal</div>
               <div style="flex: 1 1 0%; width: 100%; display: flex; justify-content: flex-end; align-items: center;">
                  <svg width="15" height="7" xmlns="http://www.w3.org/2000/svg">
                     <path fill="black" id="svg_1" d="m7.53083,6.89884c0.10873,-0.00632 0.21178,-0.04931 0.29333,-0.12138l6.47343,-5.82608c0.10051,-0.08471 0.1631,-0.20608 0.17195,-0.33757c0.00948,-0.13086 -0.03477,-0.26046 -0.12201,-0.35843c-0.08787,-0.09799 -0.21178,-0.15615 -0.34264,-0.1612c-0.13149,-0.00506 -0.25983,0.04362 -0.35465,0.13402l-6.14975,5.53284l-6.14975,-5.53284c-0.09483,-0.0904 -0.22316,-0.13908 -0.35465,-0.13402c-0.13086,0.00506 -0.25476,0.06322 -0.34264,0.1612c-0.08724,0.09799 -0.13149,0.22757 -0.12201,0.35843c0.00885,0.13149 0.07144,0.25287 0.17195,0.33757l6.47343,5.82608c0.09735,0.08661 0.22442,0.13023 0.35402,0.12138l0,0z"></path>
                  </svg>
               </div>
            </div>
         </button>
      </div>
      <div class="css-1v7r4tf"></div>
      <div class="css-aaoa5p"><a href="<?= base_url('account-settings') ?>" class="btn btn-primary" type="button" >Cancel</a></div>
   </div>
</div>
			</div>
		</div>
	</div>

<?php include ('include/footer.php') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
>


<script>
  var _window = '';
  function do_create_agreement (e) 
  {

    e.preventDefault();
      $('.alert-danger').remove();
      $.ajax({
      url: '<?= base_url() ?>/User/do_create_agreement',
      type: 'POST',
      dataType: 'json',
      beforeSend: function() {        
        $.blockUI()
      },
      success : function(res){
         $.unblockUI()
        _window = window.open(res.links[0].href, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=500,height=600");
        var timer = setInterval(function() { 
         html = $(_window.document.body).text();
         if (html == 'cancelled') {
            _window.close()
         }
         if (html == 'success') {
            _window.close()
            Swal.fire({
               title: "Success", 
               text: 'Payment Updated successfully', 
               icon: "success"
             }).then(function (result) {
               window.location.href = '<?= base_url('account-settings') ?>'
            })
         }
          if(_window.closed) {
            
            console.log(html)
              clearInterval(timer);
              //alert('closed');
          }
      }, 1000);
      }
    });


}

</script>