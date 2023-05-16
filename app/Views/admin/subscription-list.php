
<?php include ('include/header.php') ?>

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
                    <div>
        			    <h4 class="d-flex justify-content-between">Subscription management:</h4>
                    </div>
                    <?= $this->session->getFlashdata('msg'); ?>
                    <div id="result"></div>
        		
        		    <div class="table-responsive">		
        		        <table id="example3" class="display dataTable dataTables_wrapper" style="width:100%">
                            <thead>     
                                <tr>
                                    <th>S. No.</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($subscription_list)) { 
                                    $i=1; 
                                    foreach ($subscription_list as $key => $value) { ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $value['email']?></td>
                                    <td> <button type="button" class="btn btn-danger btn-sm" onclick="deleteData('Admin/AdminDashboard' , <?= $value['id'] ?>)">Delete</button> </td>
                                </tr>
                               <?php  $i++; }  }?>
                                
                            </tbody> 
                        </table>
        	       </div>
        	   </div>
            </div>
        </div>
    </div>
</div>
<?php include ('include/footer.php') ?> 
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
