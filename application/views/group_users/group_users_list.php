
<?php
    if(empty($_GET['q'])){
        $get_suffix =  '?p='.$_GET['p'];
    }else{
        $get_suffix =  '?q='.$_GET['q'].'&p='.$_GET['p'];
    }
?> 
  <script>
        $(document).ready(function(){
            $("#perpage").change(function (){
                var url = "<?php echo site_url('group_users/index');?>/"+$(this).val()+"<?=$get_suffix?>";
                $('.content').load(url);
                return false;
            })
            $('form.jsform').on('submit', function(form){
                form.preventDefault();
                $.get("<?=base_url().uri_string().'/?p='.$_GET['p']?>", $('form.jsform').serialize(), function(data){
                    $('section.content').html(data);
                });
            });          
        });
  </script>
<!-- Main row -->
<div class="row">
    <div class="col-md-12">
  <!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Data Group_users</h3>
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
                if(in_array($_idmenu->id_sub, explode(',', $input_data)) or $level_user=='administrator'){ ?>
                  <a href="#" onclick="opened_2('group_users/create', '<?=$_GET['p']?>');" class="btn btn-primary">Create</a>
            <?php   
                }
            ?>
	    </div>
        </div>
        <!-- Perpage -->
            <div class="col-lg-8">
                <div class="input-group input-group-sm col-xs-4">
                    <span class="input-group-addon">Tampilkan</span>
                            <select type="text" class="form-control" name="perpage" id="perpage" placeholder="perpage" >
                                <option value="10" <?php if($perpage == '10'){echo"selected";}?>>10</option>
                                <option value="25" <?php if($perpage == '25'){echo"selected";}?>>25</option>
                                <option value="50" <?php if($perpage == '50'){echo"selected";}?>>50</option>
                                <option value="100" <?php if($perpage == '100'){echo"selected";}?>>100</option>
                            </select>
                    <span class="input-group-addon">Dari <?=$total_rows?> Data</span>
                </div> 
            </div>  
            <div class="col-lg-4">
                <?=form_open(site_url('menu_tree/index/'), array('method'=>'get', 'class'=>'jsform'))?>
                  <div class="input-group input-group-sm col-xs-13">
                    <input type="text" name="q" class="form-control" value="<?=$q?>" placeholder="Search...">
                    <span class="input-group-btn">
                      <button class="btn btn-info btn-flat" name="p" value="2" type="submit">Cari</button>
                    </span>
                  </div><!-- /input-group -->
                <?=form_close()?>
            </div>
        <!-- /perpage -->
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th>No</th>
		    <th>group_name</th>
		    <th>create</th>
		    <th>read</th>
		    <th>update</th>
		    <th>delete</th>
		    <th>Action</th>
                </tr>
            </thead>
	    <tbody>
            <?php
//            $start = 0;
            foreach ($group_users_data as $group_users)
            {
                ?>
                <tr>
		    <td><?php echo ++$start ?></td>
		    <td><?php echo $group_users->group_name ?></td>
		    <td><?php echo $group_users->create ?></td>
		    <td><?php echo $group_users->read ?></td>
		    <td><?php echo $group_users->update ?></td>
		    <td><?php echo $group_users->delete ?></td>
		    <td style="text-align:center">
		    <div class="btn-group">
			<a href="#" onclick="opened_2('group_users/read/<?=$group_users->id?>', '<?=$_GET['p']?>');" class="btn btn-default btn-sm" title="View"><i class="fa fa-eye"></i></a>
			<?php 
			if(in_array($_idmenu->id_sub, explode(',', $edit_data)) or $level_user=='administrator'){ ?>
					<a href="#" onclick="opened_2('group_users/update/<?=$group_users->id?>', '<?=$_GET['p']?>');" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
				<?php } 
			if(in_array($_idmenu->id_sub, explode(',', $delete_data)) or $level_user=='administrator'){ ?>
					<a href="#" onclick="if(confirm('Are you sure?')) opened_2('group_users/delete/<?=$group_users->id?>', '<?=$_GET['p']?>');" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash-o"></i></a> 
				<?php } 
			?>
		    </div>
		    </td>
	        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                  <?=$this->pagination->create_links()?>
                  </ul>
                </div>
    </body>
</html>