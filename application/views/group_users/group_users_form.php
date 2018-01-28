
      <script>
        $(document).ready(function() {
            $('form.jsform').on('submit', function(form){
                form.preventDefault();
                $.post('<?php echo $action;?>', $('form.jsform').serialize(), function(data){
                    $('section.content').html(data);
                });
            });
        });
        $(function () {
           $(".select2").select2();
        });
      </script>
<!-- Main row -->
<div class="row">
    <div class="col-md-6">
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo $button ?> Group_users</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
          <ul class="products-list product-list-in-box">
<!-- Batas Header -->

        <form action="" method="post" class="jsform">
	    <div class="form-group">
                <label for="varchar">group_name <?php echo form_error('group_name') ?></label>
                <input type="text" class="form-control" name="group_name" id="group_name" placeholder="group_name" value="<?php echo $group_name; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">create <?php echo form_error('create') ?></label>
                <input type="text" class="form-control" name="create" id="create" placeholder="create" value="<?php echo $create; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">read <?php echo form_error('read') ?></label>
                <input type="text" class="form-control" name="read" id="read" placeholder="read" value="<?php echo $read; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">update <?php echo form_error('update') ?></label>
                <input type="text" class="form-control" name="update" id="update" placeholder="update" value="<?php echo $update; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">delete <?php echo form_error('delete') ?></label>
                <input type="text" class="form-control" name="delete" id="delete" placeholder="delete" value="<?php echo $delete; ?>" />
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <input type="hidden" name="p" value="<?php echo $_GET['p']; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="#" onclick="opened_2('group_users', '<?=$_GET['p']?>');" class="btn btn-default">Cancel</a>
	</form>
<!-- penutup -->
                </ul>
            </div>
        </div>
    </div>
<!-- end penutup -->
    </body>
</html>