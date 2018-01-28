          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MANU</li>
            <!-- Optionally, you can add icons to the links -->
            <li <?php if($this->uri->segment(1, 0)=='dashboard'){?> class="active" <?php }?> >
              <a href="#" onclick="dashboard('dashboard/dashboard');">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <!-- From database -->
            <!-- TreeView -->
            <?php
              $user_access = "3,4,5";
              $this->db->select("mt.*, sm.*");
              $this->db->select("i.icon as mt_logo, sm.link as sm_link");
              $this->db->from("sub_menu sm");
              $this->db->join("menu_tree mt", "sm.id_menu = mt.id_menu", "left");
              $this->db->join("icon i", "mt.logo = i.id", "left");
              if($level_user=='administrator')
                {}else{ 
                  if(!$access){
                    $this->db->where("sm.id_sub in (1)");}else{
                    $this->db->where("sm.id_sub in (".$access.")");
                    
                  }
                }
              $this->db->where("sm.status", "Y");
              $this->db->where("mt.status", "Y");
              $this->db->group_by("sm.id_menu");
              $this->db->order_by("mt.urut", "ASC"); 
              $menu_tree = $this->db->get();
              foreach ($menu_tree->result() as $tree_menu)
              {
            ?>
            <li class="treeview<?php if(isset($_GET['p'])){ if($_GET['p']==$tree_menu->id_menu){ echo" active"; } }?>">
              <a href="<?=base_url($tree_menu->sm_link)."/?p=".$tree_menu->id_menu;?>"><i class="fa <?=$tree_menu->mt_logo?>"></i> <span><?=$tree_menu->menu?></span> <i class="fa fa-angle-left pull-right"></i></a>

              <ul class="treeview-menu">
              <!-- TreeViewmMenu -->
              <?php
                $this->db->where("id_menu", $tree_menu->id_menu); 
                if($level_user=='administrator')
                {}else{
                  if(!$access){
                    $this->db->where("id_sub in (1)");}else{
                    $this->db->where("id_sub in (".$access.")");                   
                  }
                }
                $this->db->where("status", "Y"); 
                $this->db->order_by("urut", "asc"); 
                $menu_sub = $this->db->get('sub_menu');
                foreach ($menu_sub->result() as $sub_menu)
                {
              ?>
                <li <?php if($this->uri->segment(1, 0)==$sub_menu->link){?> class="active" <?php }?>>
                  <a href="#" onclick="opened('<?=$sub_menu->link;?>', '<?=$sub_menu->id_menu;?>');"><?=$sub_menu->sub_menu?></a>
                </li>
                <!-- <li><a href="#">Link in level_user 2</a></li> -->
              <?php
                }
              ?>
              </ul>
            </li>
            <?php
              }
            ?>
            <!-- /.From datebase -->
          </ul>
          <!-- /.sidebar-menu -->
