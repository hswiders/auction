<?php include ('include/header.php') ?> 
<style type="text/css">
	input.ex_remove {
    position: absolute;
    top: 0;
    left: 0;
}
</style>
<div class="account-page">
	<div class="row">
		<div class="col-sm-3">
			<?php include ('include/sidebar.php') ?> 
		</div>
		<div class="col-sm-9">
			<div class="right-side">
				<div class="rightjhead">
					<h1>My Exchange List</h1>
					<a href="<?= base_url('add-exchange') ?>" class="btn btn-primary" style="background: #5662a6;order-color: #5662a6;">Add game to list +</a>
					
					<a href="javascript:;" onclick="select_all()" class="btn btn-primary" style="background: #5662a6;order-color: #5662a6;">Select All</a>
					<a href="javascript:;" onclick="unselect_all()" class="btn btn-primary" style="background: #5662a6;order-color: #5662a6;">Unselect All</a>
					<a href="javascript:;" onclick="remove_selected()" class="btn remove_selected_btn btn-primary disabled" style="background: #5662a6;order-color: #5662a6;">Remove Selected</a>
 				</div>
				<div class="infoaccount">
					
						<?= $this->session->getFlashdata('msg'); ?>
							<?= view('loop/product', ['products'=>$products , 'col'=>3 , 'is_sell'=>1]);  ?>
					
				</div>
			</div>
		</div>
	</div>
</div>
<?php include ('include/footer.php') ?>
<script type="text/javascript">
	function remove_selected() {
		var boxes = $(".ex_remove:checked");
		 boxes.each(function(index, el) {
		 	addToEx(el.value)
		 }).promise().done(function(){
	location.reload()
});
	}
	function select_all() {
		$(".ex_remove").prop('checked' , true);
		 $('.remove_selected_btn').removeClass('disabled')
	}
	function unselect_all() {
		$(".ex_remove").prop('checked' , false);
		 $('.remove_selected_btn').addClass('disabled')
	}

	$(document).on('change', '.ex_remove', function(event) {
		event.preventDefault();
		var boxes2 = $(".ex_remove:checked");
		 if (boxes2.length > 0) {
		 	$('.remove_selected_btn').removeClass('disabled')
		 }
		 else
		 {
		 	$('.remove_selected_btn').addClass('disabled')
		 }
	});
 
</script>