<!-- Main row -->
<div class="row">
    <div class="col-md-6">
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">View Profile</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
          <ul class="products-list product-list-in-box">
<!-- Batas Header -->

        <table class="table">
	    <tr><td>nama_aplikasi</td><td><?php echo $nama_aplikasi; ?></td></tr>
	    <tr><td>nama_logo</td><td><?php echo $nama_logo; ?></td></tr>
	    <tr><td>dashboard</td><td><?php echo $dashboard; ?></td></tr>
	    <tr><td>copyright</td><td><?php echo $copyright; ?></td></tr>
	    <tr><td></td><td><a href="javascript:window.history.go(-1);" class="btn btn-default">Cancel</button></td></tr>
	</table>
<!-- penutup -->
                </ul>
            </div>
        </div>
    </div>
<!-- end penutup -->
    </body>
</html>