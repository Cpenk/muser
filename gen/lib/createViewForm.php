<!--
Author : Hari Prasetyo
Website : harviacode.com
Create Date : 08/05/2015

You may edit this code, but please do not remove original information. Thanks :D
-->
<?php

mkdir($target."views/".$table, 0777);

$path = $target."views/".$table."/" . $form_file;

$createForm = fopen($path, "w") or die("Unable to open file!");

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY = 'PRI'");
$row = mysql_fetch_assoc($result2);
$primary = $row['COLUMN_NAME'];

$string = "
      <script>
        \$(document).ready(function() {
            \$('form.jsform').on('submit', function(form){
                form.preventDefault();
                \$.post('<?php echo \$action;?>', \$('form.jsform').serialize(), function(data){
                    $('section.content').html(data);
                });
            });
        });
        \$(function () {
           \$(\".select2\").select2();
        });
      </script>
<!-- Main row -->
<div class=\"row\">
    <div class=\"col-md-6\">
  <!-- TABLE: LATEST ORDERS -->
  <div class=\"box box-info\">
    <div class=\"box-header with-border\">
      <h3 class=\"box-title\"><?php echo \$button ?> ".ucfirst($table)."</h3>
      <div class=\"box-tools pull-right\">
        <button class=\"btn btn-box-tool\" data-widget=\"collapse\"><i class=\"fa fa-minus\"></i></button>
        <button class=\"btn btn-box-tool\" data-widget=\"remove\"><i class=\"fa fa-times\"></i></button>
      </div>
    </div><!-- /.box-header -->
    <div class=\"box-body\">
          <ul class=\"products-list product-list-in-box\">
<!-- Batas Header -->

        <form action=\"\" method=\"post\" class=\"jsform\">";
$result2 = mysql_query("SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row1 = mysql_fetch_assoc($result2))
    {
        if ($row1["DATA_TYPE"] == 'text')
        {
        $string .= "\n\t    <div class=\"form-group\">
                <label for=\"".$row1["COLUMN_NAME"]."\">".$row1["COLUMN_NAME"]." <?php echo form_error('".$row1["COLUMN_NAME"]."') ?></label>
                <textarea class=\"form-control\" rows=\"3\" name=\"".$row1["COLUMN_NAME"]."\" id=\"".$row1["COLUMN_NAME"]."\" placeholder=\"".$row1["COLUMN_NAME"]."\"><?php echo $".$row1["COLUMN_NAME"]."; ?></textarea>
            </div>";
        } else
        {
        $string .= "\n\t    <div class=\"form-group\">
                <label for=\"".$row1["DATA_TYPE"]."\">".$row1["COLUMN_NAME"]." <?php echo form_error('".$row1["COLUMN_NAME"]."') ?></label>
                <input type=\"text\" class=\"form-control\" name=\"".$row1["COLUMN_NAME"]."\" id=\"".$row1["COLUMN_NAME"]."\" placeholder=\"".$row1["COLUMN_NAME"]."\" value=\"<?php echo $".$row1["COLUMN_NAME"]."; ?>\" />
            </div>";
        }
    }
}
$string .= "\n\t    <input type=\"hidden\" name=\"".$primary."\" value=\"<?php echo $".$primary."; ?>\" /> ";
$string .= "\n\t    <input type=\"hidden\" name=\"p\" value=\"<?php echo \$_GET['p']; ?>\" /> ";
$string .= "\n\t    <button type=\"submit\" class=\"btn btn-primary\"><?php echo \$button ?></button> ";
$string .= "\n\t    <a href=\"#\" onclick=\"opened_2('".$table."', '<?=\$_GET['p']?>');\" class=\"btn btn-default\">Cancel</a>";
$string .= "\n\t</form>
<!-- penutup -->
                </ul>
            </div>
        </div>
    </div>
<!-- end penutup -->
    </body>
</html>";


fwrite($createForm, $string);
fclose($createForm);

$form_res = "<p>" . $path . "</p>";
?>