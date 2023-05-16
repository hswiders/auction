

<footer class="footer-16 py-5">
<div class="container pt-md-4 BeIdeaFooter"data-aos="fade-down" data-aos-offset="300">

        <!-- copyright -->
<div class="below-section text-center pt-lg-4 mt-3">
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
<script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=y8edi4divxwsplcdd28rzuyx245zbzdndm22yzhuaanemki5"></script>
<script>tinymce.init({ selector: '.textarea', height:480, plugins: [  "advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste" ], toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image", setup: function (editor) { editor.on('change', function () { tinymce.triggerSave(); }); }});</script>
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

</script>
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
</script>
</body> 
</html>