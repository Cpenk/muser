<!-- Main row -->
<div class="row">
    <div class="col-md-6">
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">View Group_users</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
          <ul class="products-list product-list-in-box">
<!-- Batas Header -->

        <table class="table">
	    <tr><td>group_name</td><td><?php echo $group_name; ?></td></tr>
	    <tr><td>create</td><td><?php echo $create; ?></td></tr>
	    <tr><td>read</td><td><?php echo $read; ?></td></tr>
	    <tr><td>update</td><td><?php echo $update; ?></td></tr>
	    <tr><td>delete</td><td><?php echo $delete; ?></td></tr>
	    <tr><td></td><td><a href="#" onclick="opened_2('group_users', '<?=$_GET['p']?>');" class="btn btn-default">Cancel</a></td></tr>
	</table>
<!-- penutup -->
                </ul>
            </div>
        </div>
    </div>
<!-- end penutup -->
    </body>
</html>