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
      <h3 class="box-title">Profile Users <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></h3>
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
                <label for="varchar">username <?php echo form_error('username') ?></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="username" value="<?php echo $username; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">password <?php echo form_error('password') ?></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="password" value="<?php echo $password; ?>" />
            </div>
        <div class="form-group">
                <label for="varchar">nama <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="nama" value="<?php echo $nama; ?>" />
            </div>
        <div class="form-group">
                <label for="varchar">email <?php echo form_error('email') ?></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="email" value="<?php echo $email; ?>" />
            </div>
	    <div class="form-group">
                <label for="varchar">level_user <?php echo form_error('level_user') ?></label>
                <input type="text" readonly class="form-control" name="level_user" id="level_user" placeholder="level_user" value="<?php echo $level_user; ?>" />
            </div>
	    <div class="form-group">
                <label for="enum">status <?php echo form_error('status') ?></label>
                <select type="text" readonly class="form-control select2" name="status" id="status" placeholder="status" disabled>
                    <option>Pilih Status</option>
                    <option value="Y" <?php if($status == 'Y'){echo"selected";}?>>Aktif</option>
                    <option value="N" <?php if($status == 'N'){echo"selected";}?>>Tidak Aktif</option>
                </select>
                <input type="hidden" class="form-control" name="status" id="status" placeholder="status" value="<?php echo $status; ?>" />
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <!-- <input type="hidden" name="p" value="<?php echo $_GET['p']; ?>" />  -->
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <button type="reset" class="btn btn-default">Reset</button> 
        <!-- <a href="#" onclick="opened_2('users');" class="btn btn-default">Cancel</a> -->
	</form>
<!-- penutup -->
                </ul>
            </div>
        </div>
    </div>
<!-- end penutup -->
    </body>
</html>