

<footer class="footer-16 py-5">
<div class="container BeIdeaFooter"data-aos="fade-down" data-aos-offset="300">
        <!-- copyright -->
<div class="below-section text-center">
	<p class="CopyRights copy-text"> &copy; 2022 Game Xchange | All Rights Reserved</p>
</div> 
</div>
</footer>    
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="<?= base_url() ?>/assets/js/counter.js"></script> 
<script src="<?= base_url() ?>/assets/js/owl.carousel.js"></script>
<script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script> 
<script src="<?= base_url() ?>/assets/js/select2.min.js"></script> 
<script src="<?= base_url() ?>/assets/js/sweetalert2.all.min.js"></script> 
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js" ></script> -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" ></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js" ></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js" ></script>

<script src="<?= base_url() ?>/assets/js/jquery.blockUI.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> 
<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=9z08z5aqanygfxzk92cz4hqmy8v15zhnl49ofjsabc4hucse"></script>
<script>tinymce.init({ selector: '.textarea', height:480, plugins: [  "advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste" ], toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image", setup: function (editor) { editor.on('change', function () { tinymce.triggerSave(); }); }});</script>
<script>
$(document).ready(function() {
    $('.select2').select2();

    var val = new Array();
     <?php foreach ($languages as $key => $value): ?> 
     <?php $lang_data = explode(',', $userData['languages']); ?>
     <?php if(in_array($value['id'], $lang_data) ){

        ?>
        val.push(<?= $value['id'] ?>);
        <?php
     } ?> 
        
     <?php endforeach ?>
      $(".select2").select2().val(val).trigger('change.select2');
    
}); 
function blockui(action='show') {
          if (action == 'show') 
          {
            $.blockUI({message:'<div class="spinner-border text-primary" role="status"></div>',css:{backgroundColor:"transparent",border:"0"},overlayCSS:{backgroundColor:"#fff",opacity:.8}})
          }
          else
          {
             $.unblockUI()
          }
        }
</script>
<script> 
$(document).ready(function () {
	$("#owl-demo1").owlCarousel({
		loop: true,
		margin: 20,
		autoplay: true,
		dots: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 1000,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1,
				nav: true
			},
			600: {
				items: 1,
				nav: false
			},
			1000: {
				items: 1, 
				loop: true
			}
		}
	})
});
</script> 
<script>
$(document).ready(function () {
	$(".team-slider").owlCarousel({
		loop: true,
		margin: 20,
		nav : true,
		dots: false,
		autoplay: true,
		autoplayTimeout: 5000,
		autoplaySpeed: 1000,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1 
			},
			600: {
				items: 2
			},
			1000: {
				items: 4 
			}
		}
	})
});
</script> 
<script>
$(document).ready(function () {
	$(".mycompanions").owlCarousel({
		loop: false,
		margin: 20,
		nav : true,
		dots: false,
		autoplay: false, 
		responsiveClass: true,
		responsive: {
			0: {
				items: 1 
			},
			600: {
				items: 2
			},
			1000: {
				items: 4 
			}
		}
	})
});
</script> 
<script>
$(document).ready(function () {
	$(".waitcompanions").owlCarousel({
		loop: false,
		margin: 20,
		nav : true,
		dots: false,
		autoplay: false, 
		responsiveClass: true,
		responsive: {
			0: {
				items: 1 
			},
			600: {
				items: 2
			},
			1000: {
				items: 2 
			}
		}
	})
});
</script>  
<script>
$(document).ready(function () {
	$(".group-chedah").owlCarousel({
		loop: false,
		margin: 10,
		nav : true,
		dots: false,
		autoplay: false, 
		responsiveClass: true,
		responsive: {
			0: {
				items: 1 
			},
			600: {
				items: 1
			},
			1000: {
				items: 1 
			}
		}
	})
});
</script> 
<script>
$(document).ready(function () {
	$(".videousdwe").owlCarousel({
		loop: false,
		margin: 10,
		nav : true,
		dots: false,
		autoplay: false, 
		responsiveClass: true,
		responsive: {
			0: {
				items: 1 
			},
			600: {
				items: 3
			},
			1000: {
				items: 5 
			}
		}
	})
});
</script> 
<script>
$(document).ready(function () {
	$(".three-Member").owlCarousel({
		loop: false,
		margin: 10,
		nav : true,
		dots: false,
		autoplay: false, 
		responsiveClass: true,
		responsive: {
			0: {
				items: 1 
			},
			600: {
				items: 3
			},
			1000: {
				items: 3
			}
		}
	})
});
</script> 
<script>
    $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 80) {
            $("#site-header").addClass("nav-fixed");
        } else {
            $("#site-header").removeClass("nav-fixed");
        }
    });

    //Main navigation Active Class Add Remove
    $(".navbar-toggler").on("click", function () {
        $("header").toggleClass("active");
    });
    $(document).on("ready", function () {
        if ($(window).width() > 991) {
            $("header").removeClass("active");
        }
        $(window).on("resize", function () {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
        });
    });
</script> 
<script>
    $(function () {
        $('.navbar-toggler').click(function () {
            $('body').toggleClass('noscroll');
        })
    });
$(document).ready(function() {
<?php if (@$export): ?>
   
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
       {
           extend: 'pdf',
           footer: true,
           exportOptions: {
            columns: ':not(:last-child)',
          }
           // exportOptions: {
           //      columns: [1,2,3,4,5]
           //  }
       },
       
       {
           extend: 'csv',
           footer: true,
           exportOptions: {
            columns: ':not(:last-child)',
          }
           // exportOptions: {
           //      columns: [1,2,3,4,5]
           //  }
       },
       {
           extend: 'print',
           footer: true,
           exportOptions: {
            columns: ':not(:last-child)',
          }
           // exportOptions: {
           //      columns: [1,2,3,4,5]
           //  }
       }         
    ]  
    } );

<?php else : ?>
    $('#myTable').dataTable();
<?php endif ?>
} );



$(document).ready(function() {
  $(document).on('click' , '.make_read' , function() {
  var url = $(this).data('url')
  markAsRead('0' , url);
  })

  $('.admin-dash').find('.container').addClass('container-fluid').removeClass('container')
});

function markAsRead(id , url) {
    $.ajax({
          url: '<?= base_url() ?>/Home/markAsRead',
          type: 'POST',
          cache:false,
          data:{'user_id':id},
          dataType: 'html',
          beforeSend: function() {
          },
          success : function(res){
          	if (url == '#') {
          		location.reload()
          	}
          	else
          	{
          		window.location.href = url
          	}
            
          }
        });

}

$(function(){
    var current = location.pathname;
    $('#menu li a').each(function(){
        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('active');
            if ($this.hasClass('collapse-item')) 
            {
            	$this.parent('div').addClass('show')
            }
        }
    })
})
function printData(id)
{
   var divToPrint= $(id).find('.modal-body');
   newWin= window.open("");
   newWin.document.write(divToPrint.html());
   newWin.print();
   newWin.close();
}
</script> 
<script>
  
   async function  deleteData (fun , id) 
  {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
       
      form = new FormData();
      form.append('id' , id);
      $.ajax({
      url: '<?= base_url() ?>/'+fun+'/do_delete',
      type: 'POST',
      cache:false,
      contentType: false,
      processData: false,
      data:form,
      dataType: 'json',
      beforeSend: function() 
      {        
        blockui('show')
      },
      success : function(res){
        blockui('hide')
        if (res.status == 1) 
        {
            Swal.fire({
               title: "Success", 
               text: res.message, 
               icon: "success"
             }).then(function (result) {
            location.reload();
            })
           
          }
        
        }
      });
      }
      else
      {
        return false;
      }
    })
      
}
</script>
</body> 
</html>