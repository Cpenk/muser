<!-- Main row -->
<div class="row">
    <div class="col-md-12">
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Data Valuation_description</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="table-responsive">
<!-- Batas Header -->

        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 4px"  id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-4 text-right">
            <?php
                $_menu = $this->uri->segment(1, 0);
                $this->db->where('link', $_menu);
                $_idmenu = $this->db->get('sub_menu')->row();
                if(in_array($_idmenu->id_sub, explode(',', $input_data)) or $level_user=='administrator'){
                    echo anchor(site_url('valuation_description/create/?p='.$_GET['p']), 'Create', 'class="btn btn-primary"'); 
                }
            ?>
	    </div>
        </div>
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>description</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
//            $start = 0;
            foreach ($valuation_description_data as $valuation_description)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $valuation_description->description ?></td>
		    <td style="text-align:center">
		    <div class="btn-group">
			<?php 
			echo anchor(site_url('valuation_description/read/'.$valuation_description->id.'/?p='.$_GET['p']),'<i class="fa fa-eye"></i>', 'class="btn btn-default btn-sm"'); 
			if(in_array($_idmenu->id_sub, explode(',', $edit_data)) or $level_user=='administrator'){ 
					echo anchor(site_url('valuation_description/update/'.$valuation_description->id.'/?p='.$_GET['p']),'<i class="fa fa-pencil-square-o"></i>', 'class="btn btn-primary btn-sm"'); 
				} 
			if(in_array($_idmenu->id_sub, explode(',', $delete_data)) or $level_user=='administrator'){ 
					echo anchor(site_url('valuation_description/delete/'.$valuation_description->id.'/'.$_GET['p']),'<i class="fa fa-trash-o"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				} 
			?>
		    </div>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#mytable").dataTable();
            });
        </script>
    </body>
</html>