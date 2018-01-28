<!-- Main row -->
<div class="row">
    <div class="col-md-6">
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">View Sub_menu</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
          <ul class="products-list product-list-in-box">
<!-- Batas Header -->

        <table class="table">
	    <tr><td>id_menu</td><td><?php echo $id_menu; ?></td></tr>
	    <tr><td>sub_menu</td><td><?php echo $sub_menu; ?></td></tr>
	    <tr><td>logo</td><td><?php echo $logo; ?></td></tr>
	    <tr><td>link</td><td><?php echo $link; ?></td></tr>
	    <tr><td>urut</td><td><?php echo $urut; ?></td></tr>
	    <tr><td>status</td><td><?php echo $status; ?></td></tr>
	    <tr><td></td><td>
      <a href="#" onclick="opened_2('sub_menu', '<?=$_GET['p']?>');" class="btn btn-default">Cancel</a>
	</table>
<!-- penutup -->
                </ul>
            </div>
        </div>
    </div>
<!-- end penutup -->
    </body>
</html>