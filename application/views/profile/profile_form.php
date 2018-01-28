
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
    <div class="col-md-9">
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Profile Program <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></h3>
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
                <label for="char">Nama Depan Aplikasi <?php echo form_error('nama_aplikasi') ?></label>
                <input type="text" class="form-control" name="nama_aplikasi" id="nama_aplikasi" placeholder="nama_aplikasi" value="<?php echo $nama_aplikasi; ?>" />
            </div>
      <div class="form-group">
                <label for="varchar">Nama Belakang Aplikasi <?php echo form_error('nama_logo') ?></label>
                <input type="text" class="form-control" name="nama_logo" id="nama_logo" placeholder="nama_logo" value="<?php echo $nama_logo; ?>" />
            </div>
      <div class="form-group">
                <label for="varchar">Nama Kepala Desa <?php echo form_error('nama_kades') ?></label>
                <input type="text" class="form-control" name="nama_kades" id="nama_kades" placeholder="nama_kades" value="<?php echo $nama_kades; ?>" />
            </div>
      <div class="form-group">
                <label for="varchar">NIP Kepala Desa <?php echo form_error('nip') ?></label>
                <input type="text" class="form-control" name="nip" id="nip" placeholder="nip" value="<?php echo $nip; ?>" />
            </div>
	    <div class="form-group">
                <label for="dashboard">Dashboard <?php echo form_error('dashboard') ?></label>
                <textarea class="form-control" rows="3" name="dashboard" id="editor1" placeholder="dashboard"><?php echo $dashboard; ?></textarea>
            </div>
      <div class="form-group">
                <label for="varchar">Copyright <?php echo form_error('copyright') ?></label>
                <input type="text" class="form-control" name="copyright" id="copyright" placeholder="copyright" value="<?php echo $copyright; ?>" />
            </div>
      <div class="form-group">
                <label for="varchar">Vertion <?php echo form_error('vertion') ?></label>
                <input type="text" class="form-control" name="vertion" id="vertion" placeholder="vertion" value="<?php echo $vertion; ?>" />
            </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <input type="hidden" name="p" value="<?php echo $_GET['p']; ?>" /> 
      <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	</form>
<!-- penutup -->
                </ul>
            </div>
        </div>
    </div>
<!-- end penutup -->
    </body>
</html>