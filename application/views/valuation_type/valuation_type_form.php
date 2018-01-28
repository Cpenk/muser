<!-- Main row -->
<div class="row">
    <div class="col-md-6">
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo $button ?> Valuation_type</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
          <ul class="products-list product-list-in-box">
<!-- Batas Header -->

        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
                <label for="varchar">type <?php echo form_error('type') ?></label>
                <input type="text" class="form-control" name="type" id="type" placeholder="type" value="<?php echo $type; ?>" />
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <input type="hidden" name="p" value="<?php echo $_GET['p']; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="javascript:window.history.go(-1);" class="btn btn-default">Cancel</a>
	</form>
<!-- penutup -->
                </ul>
            </div>
        </div>
    </div>
<!-- end penutup -->
    </body>
</html>