<!--
Author : Hari Prasetyo
Website : harviacode.com
Create Date : 08/05/2015

You may edit this code, but please do not remove original information. Thanks :D
-->
<?php
$table_error = '';
$model_res = '';
$controller_res = '';
$list_res = '';
$read_res = '';
$form_res = '';
$page_res = '';
$excel_res = '';
$word_res = '';

if (isset($_POST['table'])) {
    // include connection 
    require 'lib/config.php';

    $connection = mysql_connect($hostname, $username, $password);
    $select_database = mysql_select_db($database);

    if (!$select_database) {
        die('Pleace check database setting on lib/config.php');
    }

    // get table name
    $table = strtolower(trim($_POST['table']));
    $controller = strtolower(trim($_POST['controller']));
    $model = strtolower(trim($_POST['model']));
    $versici = $_POST['versici'];
    $jenistabel = $_POST['jenistabel'];
    $paginationConfig = isset($_POST['paginationConfig']) ? $_POST['paginationConfig'] : '';
    $excel = isset($_POST['excel']) ? $_POST['excel'] : '';
    $word = isset($_POST['word']) ? $_POST['word'] : '';

    // cek table in database
    if (mysql_num_rows(mysql_query("SHOW TABLES LIKE '" . $table . "'")) <> 1) {
        // show error
        $table_error = "<p>Table \"" . $table . "\" does not exist</p>";
    } else {
        // setting 
        $model = $model <> '' ? $model : $table . "_model";
        $controller = $controller <> '' ? $controller : $table;
        $html = $table . "_html";
        $list = $table . "_list";
        $read = $table . "_read";
        $form = $table . "_form";

        //filename
        if ($versici == 2) {
            $model_file = $model . ".php";
            $controller_file = $controller . ".php";
        } else {
            $model_file = ucfirst($model) . ".php";
            $controller_file = ucfirst($controller) . ".php";
        }
        $html_file = $html . ".php";
        $list_file = $list . ".php";
        $read_file = $read . ".php";
        $form_file = $form . ".php";

        require 'lib/createModel.php';
        require 'lib/createController.php';
        require 'lib/createViewForm.php';
        require 'lib/createViewRead.php';

        if ($jenistabel == 'regtable') {
            require 'lib/createViewList.php';
        } else {
            require 'lib/createViewListDatatables.php';
        }
        
        if ($paginationConfig == 'create') {
            require 'lib/createConfigPagination.php';
        }

        if ($excel == 'create') {
            require 'lib/createExportExcelHelper.php';
        }
        
        if ($word == 'create') {
            require 'lib/createViewListHtml.php';
        }
    }
}
?>
<!doctype html>
<html>
    <head>
        <title>Generator</title>
        <link rel="stylesheet" href="lib/bootstrap.min.css"/>
        <style>
            body{
                padding: 15px;
            }
            p{
                margin-bottom: 5px;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class="row" style="margin-top: 10px">
            <div class="col-md-3">
                    <div class="form-group">
                        <label>ABOUT</label>
                        <hr style="margin-bottom: 10px; margin-top: 10px">
                    </div>
            Generate ini sudah dimodifikasi sesuai dengan template yang ada untuk mempermudah pekerjaan yang akan dibuat
            </div>

            <div class="col-md-3">
                    <div class="form-group">
                        <label>PENENTUAN</label>
                        <hr style="margin-bottom: 10px; margin-top: 10px">
                    </div>
                <form action="index.php" method="post">
                    <div class="form-group">
                        <input onKeyUp="setname()" id="table" type="text" name="table" value="<?php echo isset($_POST['table']) ? $_POST['table'] : '' ?>" class="form-control" placeholder="Input Table Name" />
                    </div>
                    <?php $def_versi = isset($_POST['versici']) ? $_POST['versici'] : '2'; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                <label>
                                    <input type="radio" name="versici" id="2" value="2" <?php echo $def_versi == '2' ? 'checked' : ''; ?>>
                                    Codeigniter 2
                                </label>
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                <label>
                                    <input name="versici" type="radio" id="3" value="3" checked <?php echo $def_versi == '3' ? 'checked' : ''; ?>>
                                    Codeigniter 3
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-bottom: 5px; margin-top: 5px">
                    <?php $def_jenistable = isset($_POST['jenistabel']) ? $_POST['jenistabel'] : 'regtable'; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                <label>
                                    <input type="radio" name="jenistabel" id="regtable" value="regtable" <?php echo $def_jenistable == 'regtable' ? 'checked' : ''; ?>>
                                    Reguler Table
                                </label>
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="radio" style="margin-bottom: 0px; margin-top: 0px">
                                <label>
                                    <input name="jenistabel" type="radio" id="datatables" value="datatables" checked <?php echo $def_jenistable == 'datatables' ? 'checked' : ''; ?>>
                                    Datatables
                                </label>
                            </div>
                        </div>
                    </div>
                    <hr style="margin-bottom: 5px; margin-top: 5px">
                    <div class="checkbox">
                        <?php $excel = isset($_POST['excel']) ? $_POST['excel'] : ''; ?>
                        <label>
                            <input type="checkbox" name="excel" value="create" <?php echo $excel == 'create' ? 'checked' : '' ?>>
                            Export Excel
                        </label>
                    </div>
                    <hr style="margin-bottom: 5px; margin-top: 5px">
                    <div class="checkbox">
                        <?php $word = isset($_POST['word']) ? $_POST['word'] : ''; ?>
                        <label>
                            <input type="checkbox" name="word" value="create" <?php echo $word == 'create' ? 'checked' : '' ?>>
                            Export Word
                        </label>
                    </div>
                    <hr style="margin-bottom: 5px; margin-top: 5px">
                    <div class="checkbox">
                        <?php $def_page = isset($_POST['paginationConfig']) ? $_POST['paginationConfig'] : ''; ?>
                        <label>
                            <input name="paginationConfig" type="checkbox" value="create" checked <?php echo $def_page == 'create' ? 'checked' : '' ?>>
                            Create ../application/config/pagination.php
                        </label>
                    </div>
           </div>
             <div class="col-md-3">
                    <div class="form-group">
                        <label>PENAMAAN</label>
                        <hr style="margin-bottom: 10px; margin-top: 10px">
                    </div>
                    <div class="form-group">
                        <label>Custom Controller Name</label>
                        <input type="text" id="controller" name="controller" value="<?php echo isset($_POST['controller']) ? $_POST['controller'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div>
                    <div class="form-group">
                        <label>Custom Model Name</label>
                        <input type="text" id="model" name="model" value="<?php echo isset($_POST['model']) ? $_POST['model'] : '' ?>" class="form-control" placeholder="Controller Name" />
                    </div>
                    <input type="submit" value="Generate" name="generate" class="btn btn-primary" onClick="javascript: return confirm('This will overwrite the existing files. Continue ?')" />
            </div>
            <div class="col-md-3">
                    <div class="form-group">
                        <label>HASIL</label>
                        <hr style="margin-bottom: 10px; margin-top: 10px">
                    </div>
                <?php
                echo $table_error;
                echo $model_res;
                echo $controller_res;
                echo $list_res;
                echo $read_res;
                echo $form_res;
                echo $page_res;
                echo $excel_res;
                echo $word_res;
                ?>
            </div>
        </div>
                </form>
        <script type="text/javascript">
            function setname() {
                var table = document.getElementById('table').value.toLowerCase();
                document.getElementById('controller').value = table;
                document.getElementById('model').value = table + '_model';
            }
        </script>
    </body>
</html>


