<!-- Main row -->
<div class="row">
    <div class="col-md-6">
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">View Users</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
          <ul class="products-list product-list-in-box">
<!-- Batas Header -->

        <table class="table">
	    <tr><td>username</td><td><?php echo $username; ?></td></tr>
      <tr><td>nama</td><td><?php echo $nama; ?></td></tr>
      <tr><td>email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>level_user</td><td><?php echo $level_user; ?></td></tr>
	    <tr><td>status</td><td><?php echo $status; ?></td></tr>
	    <tr><td></td><td>
      <a href="#" onclick="opened_2('users', '<?=$_GET['p']?>');" class="btn btn-default">Cancel</a>
      </td></tr>
	</table>
<!-- penutup -->
                </ul>
            </div>
        </div>
    </div>
<!-- end penutup -->
    </body>
</html>