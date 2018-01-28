<!--
Author : Hari Prasetyo
Website : harviacode.com
Create Date : 08/05/2015

You may edit this code, but please do not remove original information. Thanks :D
-->
<?php

//mkdir($target."views/".$table, 0777);

$path = $target."views/".$table."/" . $list_file;
        
$createList = fopen($path, "w") or die("Unable to open file!");

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY = 'PRI'");
$row = mysql_fetch_assoc($result2);
$primary = $row['COLUMN_NAME'];

$string = "
<?php
    if(empty(\$_GET['q'])){
        \$get_suffix =  '?p='.\$_GET['p'];
    }else{
        \$get_suffix =  '?q='.\$_GET['q'].'&p='.\$_GET['p'];
    }
?> 
  <script>
        \$(document).ready(function(){
            \$(\"#perpage\").change(function (){
                var url = \"<?php echo site_url('".$table."/index');?>/\"+\$(this).val()+\"<?=\$get_suffix?>\";
                \$('.content').load(url);
                return false;
            })
            \$('form.jsform').on('submit', function(form){
                form.preventDefault();
                \$.get(\"<?=base_url().uri_string().'/?p='.\$_GET['p']?>\", \$('form.jsform').serialize(), function(data){
                    \$('section.content').html(data);
                });
            });          
        });
  </script>
<!-- Main row -->
<div class=\"row\">
    <div class=\"col-md-12\">
  <!-- TABLE: LATEST ORDERS -->
  <div class=\"box box-info\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">Data ".ucfirst($table)."</h3>
      <div class=\"box-tools pull-right\">
        <button class=\"btn btn-box-tool\" data-widget=\"collapse\"><i class=\"fa fa-minus\"></i></button>
        <button class=\"btn btn-box-tool\" data-widget=\"remove\"><i class=\"fa fa-times\"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class=\"box-body\">
      <div class=\"table-responsive\">
<!-- Batas Header -->

        <div class=\"row\" style=\"margin-bottom: 10px\">
            <div class=\"col-md-4\">
            </div>
            <div class=\"col-md-4 text-center\">
                <div style=\"margin-top: 4px\"  id=\"message\">
                    <?php echo \$this->session->userdata('message') <> '' ? \$this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class=\"col-md-4 text-right\">
            <?php
                \$_menu = \$this->uri->segment(1, 0);
                \$this->db->where('link', \$_menu);
                \$_idmenu = \$this->db->get('sub_menu')->row();
                if(in_array(\$_idmenu->id_sub, explode(',', \$input_data)) or \$level_user=='administrator'){ ?>
                  <a href=\"#\" onclick=\"opened_2('".$table."/create', '<?=\$_GET['p']?>');\" class=\"btn btn-primary\">Create</a>
            <?php   
                }
            ?>";
if ($excel == 'create') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$controller."/excel'), 'Excel', 'class=\"btn btn-primary\"'); ?>";
}
if ($word == 'create') {
    $string .= "\n\t\t<?php echo anchor(site_url('".$controller."/word'), 'Word', 'class=\"btn btn-primary\"'); ?>";
}
$string .= "\n\t    </div>
        </div>
        <!-- Perpage -->
            <div class=\"col-lg-8\">
                <div class=\"input-group input-group-sm col-xs-4\">
                    <span class=\"input-group-addon\">Tampilkan</span>
                            <select type=\"text\" class=\"form-control\" name=\"perpage\" id=\"perpage\" placeholder=\"perpage\" >
                                <option value=\"10\" <?php if(\$perpage == '10'){echo\"selected\";}?>>10</option>
                                <option value=\"25\" <?php if(\$perpage == '25'){echo\"selected\";}?>>25</option>
                                <option value=\"50\" <?php if(\$perpage == '50'){echo\"selected\";}?>>50</option>
                                <option value=\"100\" <?php if(\$perpage == '100'){echo\"selected\";}?>>100</option>
                            </select>
                    <span class=\"input-group-addon\">Dari <?=\$total_rows?> Data</span>
                </div> 
            </div>  
            <div class=\"col-lg-4\">
                <?=form_open(site_url('menu_tree/index/'), array('method'=>'get', 'class'=>'jsform'))?>
                  <div class=\"input-group input-group-sm col-xs-13\">
                    <input type=\"text\" name=\"q\" class=\"form-control\" value=\"<?=\$q?>\" placeholder=\"Search...\">
                    <span class=\"input-group-btn\">
                      <button class=\"btn btn-info btn-flat\" name=\"p\" value=\"2\" type=\"submit\">Cari</button>
                    </span>
                  </div><!-- /input-group -->
                <?=form_close()?>
            </div>
        <!-- /perpage -->
        <table class=\"table table-bordered table-striped\" id=\"mytable\">
            <thead>
                <tr>
                    <th>No</th>";

$result2 = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row1 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t    <th>" . $row1['COLUMN_NAME'] . "</th>";
    }
}
$string .= "\n\t\t    <th>Action</th>
                </tr>
            </thead>";
$string .= "\n\t    <tbody>
            <?php
            \$start = 0;
            foreach ($" . $controller . "_data as \$$controller)
            {
                ?>
                <tr>";

$string .= "\n\t\t    <td><?php echo ++\$start ?></td>";

$result2 = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row1 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t    <td><?php echo $" . $controller ."->". $row1['COLUMN_NAME'] . " ?></td>";
    }
}

$string .= "\n\t\t    <td style=\"text-align:center\">"
        . "\n\t\t    <div class=\"btn-group\">"
        . "\n\t\t\t<a href=\"#\" onclick=\"opened_2('".$table."/read/<?=\$".$controller."->".$primary."?>', '<?=\$_GET['p']?>');\" class=\"btn btn-default btn-sm\" title=\"View\"><i class=\"fa fa-eye\"></i></a>"
        . "\n\t\t\t<?php "
        . "\n\t\t\tif(in_array(\$_idmenu->id_sub, explode(',', \$edit_data)) or \$level_user=='administrator'){ ?>"
        . "\n\t\t\t\t\t<a href=\"#\" onclick=\"opened_2('".$table."/update/<?=\$".$controller."->".$primary."?>', '<?=\$_GET['p']?>');\" class=\"btn btn-primary btn-sm\" title=\"Edit\"><i class=\"fa fa-pencil-square-o\"></i></a>"
        . "\n\t\t\t\t<?php } "
        . "\n\t\t\tif(in_array(\$_idmenu->id_sub, explode(',', \$delete_data)) or \$level_user=='administrator'){ ?>"
        . "\n\t\t\t\t\t<a href=\"#\" onclick=\"if(confirm('Are you sure?')) opened_2('".$table."/delete/<?=\$".$controller."->".$primary."?>', '<?=\$_GET['p']?>');\" class=\"btn btn-danger btn-sm\" title=\"Delete\"><i class=\"fa fa-trash-o\"></i></a> "
        . "\n\t\t\t\t<?php } "
        . "\n\t\t\t?>"
        . "\n\t\t    </div>"
        . "\n\t\t    </td>";

$string .=  "\n\t        </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
                <div class=\"box-footer clearfix\">
                  <ul class=\"pagination pagination-sm no-margin pull-right\">
                  <?=\$this->pagination->create_links()?>
                  </ul>
                </div>
    </body>
</html>";

fwrite($createList, $string);
fclose($createList);

$list_res = "<p>" . $path . "</p>";
?>