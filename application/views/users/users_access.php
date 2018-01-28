      <script>
        $(document).ready(function() {
            $('form.jsform').on('submit', function(form){
                form.preventDefault();
                var input_id = $('input[name="input_id[]"]:checked').map(function(){
                  return this.value;
                }).get()
                var access_id = $('input[name="access_id[]"]:checked').map(function(){
                  return this.value;
                }).get()
                var edit_id = $('input[name="edit_id[]"]:checked').map(function(){
                  return this.value;
                }).get()
                var delete_id = $('input[name="delete_id[]"]:checked').map(function(){
                  return this.value;
                }).get()
                // data: { input_id: input_id };
                // var test = { $('form.jsform').serialize(), input_id }

                $.post('<?php echo $action;?>', $('form.jsform').serialize() + '&input_id='+input_id + '&access_id='+access_id + '&edit_id='+edit_id + '&delete_id='+delete_id, function(data){
                    $('section.content').html(data);
                });
            });
        });
        $(function () {
           $(".select2").select2();
        });
      </script>

            <div class="col-md-13">
              <!-- Custom Tabs (Pulled to the right) -->
             
              <div class="nav-tabs-custom">

                <ul class="nav nav-tabs pull-right">

                <?php
                  $this->db->where('status', 'Y');
                  $this->db->order_by('urut', 'DESC');
                  $query = $this->db->get('menu_tree');
                  foreach ($query->result() as $tree)
                  {
                ?>
                  <li class=""><a aria-expanded="false" href="#<?=$tree->id_menu?>" data-toggle="tab"><?=$tree->menu?></a></li>
                  <?php }?>
                  <li class="active"><a aria-expanded="false" href="#dash" data-toggle="tab">Dashboard</a></li>
                  <li class="dropdown">
                    <a aria-expanded="false" class="dropdown-toggle" data-toggle="dropdown" href="#">
                      Dropdown <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                      <li role="presentation" class="divider"></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                    </ul>
                  </li>
                  <li class="pull-left header"><i class="fa fa-th"></i> Access Users</li>
                </ul>
                <div class="tab-content col-md-5">
                <form action="" method="post" class="jsform">
                <b>Users Detail</b>
                  <table class="table">
                    <tr><td>Nama User</td><td><?php echo $nama; ?></td></tr>
                    <tr><td>level_user User</td><td><?php echo $level_user; ?></td></tr>
                    <tr><td>Group User</td><td><?php echo "-"; ?></td></tr>
                    <tr><td>Status</td><td><?php echo "Active"; ?></td></tr>
                    <input type="hidden" name="p" value="<?=$_GET['p']?>">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <tr><td></td><td><button type="submit" class="btn btn-primary">Save</button> 
                    <a href="#" onclick="opened_2('users', '<?=$_GET['p']?>');" class="btn btn-default">Cancel</a>
                    </td></tr>
                  </table>

                </div>
                <div class="tab-content col-md-7">

                  <div class="tab-pane active" id="dash">
                    <p>Exactly like the original bootstrap tabs except you should use
                      the custom wrapper <code>.nav-tabs-custom</code> to achieve this style.</p>
                    A wonderful serenity has taken possession of my entire soul,
                    like these sweet mornings of spring which I enjoy with my whole heart.
                    I am alone, and feel the charm of existence in this spot,
                    which was created for the bliss of souls like mine. I am so happy,
                    my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                    that I neglect my talents. I should be incapable of drawing a single stroke
                    at the present moment; and yet I feel that I never was a greater artist than now.
                  </div><!-- /.tab-pane -->

                <?php
                  $this->db->where('status', 'Y');
                  $this->db->order_by('urut', 'DESC');
                  $query_tree = $this->db->get('menu_tree');
                  foreach ($query_tree->result() as $menu_tree)
                  {
                ?>
                  <div class="tab-pane" id="<?=$menu_tree->id_menu?>">
                    <b>Menu <?=$menu_tree->menu?></b>

                      <table class="table table-bordered table-striped" >
                              <tbody>
                              <?php
                              $this->db->where('id_menu = '.$menu_tree->id_menu);
                              $sub = $this->db->get('sub_menu');
                              foreach ($sub->result() as $sub_m)
                              {
                                  ?>
                                  <tr>
                                      <td>
                                      <input type="checkbox" name="input_id[]" id="input_id" value="<?=$sub_m->id_sub?>" <?php if(in_array($sub_m->id_sub, explode(',', $input_user))){?> checked="checked" <?php }?>>C
                                      <input type="checkbox" name="access_id[]" id="access_id" value="<?=$sub_m->id_sub?>" <?php if(in_array($sub_m->id_sub, explode(',', $access_user))){?> checked="checked" <?php }?>>R
                                      <input type="checkbox" name="edit_id[]" id="edit_id" value="<?=$sub_m->id_sub?>" <?php if(in_array($sub_m->id_sub, explode(',', $edit_user))){?> checked="checked" <?php }?>>U
                                      <input type="checkbox" name="delete_id[]" id="delete_id" value="<?=$sub_m->id_sub?>" <?php if(in_array($sub_m->id_sub, explode(',', $delete_user))){?> checked="checked" <?php }?>>D
                                      <span class="label label-success"><?=$sub_m->sub_menu ?></span></td>
                                  </tr>
                                  <?php
                              }
                              ?>
                              </tbody>
                    </table>
                  </div><!-- /.tab-pane -->
                  <?php }?>
                  
                  <div><hr></hr></div>
                  </form>
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
              
            </div>
            
            