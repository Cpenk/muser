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
      <h3 class="box-title"><?php echo $button ?> Sub_menu</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
          <ul class="products-list product-list-in-box">
<!-- Batas Header -->

        <?=form_open($action, array('class'=>'jsform'))?>
	    <div class="form-group">
                <label for="int">id_menu <?php echo form_error('id_menu') ?></label>
    <!--            <input type="text" class="form-control" name="id_menu" id="id_menu" placeholder="id_menu" value="<?php echo $id_menu; ?>" /> -->
                <?=select('id_menu', 'menu_tree', 'menu', 'id_menu', $id_menu, 'Pilih Menu Utama')?>
            </div>
	    <div class="form-group">
                <label for="varchar">sub_menu <?php echo form_error('sub_menu') ?></label>
                <input type="text" class="form-control" name="sub_menu" id="sub_menu" placeholder="sub_menu" value="<?php echo $sub_menu; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">logo <?php echo form_error('logo') ?></label>
                <input type="text" class="form-control" name="logo" id="logo" placeholder="logo" value="<?php echo $logo; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">link <?php echo form_error('link') ?></label>
                <input type="text" class="form-control" name="link" id="link" placeholder="link" value="<?php echo $link; ?>" />
            </div>
	    <div class="form-group">
                <label for="int">urut <?php echo form_error('urut') ?></label>
                <input type="text" class="form-control" name="urut" id="urut" placeholder="urut" value="<?php echo $urut; ?>" />
            </div>
	    <div class="form-group">
                <label for="enum">status <?php echo form_error('status') ?></label>
                <input type="text" class="form-control" name="status" id="status" placeholder="status" value="<?php echo $status; ?>" />
            </div>
	    <input type="hidden" name="id_sub" value="<?php echo $id_sub; ?>" /> 
	    <input type="hidden" name="p" value="<?php echo $_GET['p']; ?>" /> 
	    <button type="submit" id="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="#" onclick="opened_2('sub_menu', '<?=$_GET['p']?>');" class="btn btn-default">Cancel</a>
	<?=form_close()?>
<!-- penutup -->
                </ul>
            </div>
        </div>
    </div>
<!-- end penutup -->
    </body>
</html>