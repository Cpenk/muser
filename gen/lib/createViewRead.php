<!--
Author : Hari Prasetyo
Website : harviacode.com
Create Date : 08/05/2015

You may edit this code, but please do not remove original information. Thanks :D
-->
<?php

//mkdir($target."views/".$table, 0777);

$path = $target."views/".$table."/" . $read_file;

$createRead = fopen($path, "w") or die("Unable to open file!");

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY = 'PRI'");
$row = mysql_fetch_assoc($result2);
$primary = $row['COLUMN_NAME'];

$string = "<!-- Main row -->
<div class=\"row\">
    <div class=\"col-md-6\">
  <!-- TABLE: LATEST ORDERS -->
  <div class=\"box box-info\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\">View ".ucfirst($table)."</h3>
      <div class=\"box-tools pull-right\">
        <button class=\"btn btn-box-tool\" data-widget=\"collapse\"><i class=\"fa fa-minus\"></i></button>
        <button class=\"btn btn-box-tool\" data-widget=\"remove\"><i class=\"fa fa-times\"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class=\"box-body\">
          <ul class=\"products-list product-list-in-box\">
<!-- Batas Header -->

        <table class=\"table\">";
$result2 = mysql_query("SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row1 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t    <tr><td>".$row1["COLUMN_NAME"]."</td><td><?php echo $".$row1["COLUMN_NAME"]."; ?></td></tr>";
    }
}
$string .= "\n\t    <tr><td></td><td><a href=\"#\" onclick=\"opened_2('".$table."', '<?=\$_GET['p']?>');\" class=\"btn btn-default\">Cancel</a></td></tr>";
$string .= "\n\t</table>
<!-- penutup -->
                </ul>
            </div>
        </div>
    </div>
<!-- end penutup -->
    </body>
</html>";


fwrite($createRead, $string);
fclose($createRead);

$read_res = "<p>" . $path . "</p>";
?>