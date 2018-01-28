<!--
Author : Hari Prasetyo
Website : harviacode.com
Create Date : 08/05/2015

You may edit this code, but please do not remove original information. Thanks :D
-->
<?php

$path = $target."controllers/" . $controller_file;

$createController = fopen($path, "w") or die("Unable to open file!");

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY = 'PRI'");
$row = mysql_fetch_assoc($result2);
$primary = $row['COLUMN_NAME'];

$string = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class " . ucfirst($controller) . " extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
           if(\$this->session->userdata('logged_in'))
           {
             \$session_data = \$this->session->userdata('logged_in');
             \$data['username'] = \$session_data['username'];
             //isi
                \$this->load->model('$model');
                \$this->load->library('form_validation');
                \$this->load->library('session');
                \$this->load->helper('select');
                \$this->load->helper('rp');
           }else{
             //Jika tidak ada session di kembalikan ke halaman login
             redirect('access', 'refresh');
           }

    }";

if ($jenistabel == 'regtable') {
    
$string .= "\n\n    public function index()
    {
        \$keyword = '';
        \$this->load->library('pagination');

        \$config['base_url'] = base_url() . '$controller/index/';
        \$config['total_rows'] = \$this->" . $model . "->total_rows();
        \$config['per_page'] = 10;
        \$config['uri_segment'] = 3;
        \$config['suffix'] = '.html';
        \$config['first_url'] = base_url() . '$controller.html';
        \$this->pagination->initialize(\$config);

        \$start = \$this->uri->segment(3, 0);
        \$$controller = \$this->" . $model . "->index_limit(\$config['per_page'], \$start);

        \$data = array(
            '" . $controller . "_data' => \$$controller,
            'keyword' => \$keyword,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
        );
            \$this->load->view('design/header', \$data);
            \$this->load->view('$list', \$data);
            \$this->load->view('design/footer');
    }
    
    public function search() 
    {
        \$keyword = \$this->uri->segment(3, \$this->input->post('keyword', TRUE));
        \$this->load->library('pagination');
        
        if (\$this->uri->segment(2)=='search') {
            \$config['base_url'] = base_url() . '$controller/search/' . \$keyword;
        } else {
            \$config['base_url'] = base_url() . '$controller/index/';
        }

        \$config['total_rows'] = \$this->" . $model . "->search_total_rows(\$keyword);
        \$config['per_page'] = 10;
        \$config['uri_segment'] = 4;
        \$config['suffix'] = '.html';
        \$config['first_url'] = base_url() . '$controller/search/'.\$keyword.'.html';
        \$this->pagination->initialize(\$config);

        \$start = \$this->uri->segment(4, 0);
        \$$controller = \$this->" . $model . "->search_index_limit(\$config['per_page'], \$start, \$keyword);

        \$data = array(
            '" . $controller . "_data' => \$$controller,
            'keyword' => \$keyword,
            'pagination' => \$this->pagination->create_links(),
            'total_rows' => \$config['total_rows'],
            'start' => \$start,
        );
            \$this->load->view('design/header', \$data);
            \$this->load->view('$list', \$data);
            \$this->load->view('design/footer');
    }";

} else {
    
$string .="\n\n    public function index(\$rows_view = 10, \$start = 0)
    {
        if(empty(\$_GET['q'])){
            \$q = '';
        }else{
            \$q = \$_GET['q'];
        }

        \$total_rows= \$this->" . $model . "->search_total_rows(\$q);
        \$config['base_url'] = '" . $controller . "/index/'.\$rows_view.'/';
        \$config['suffix'] = !empty(\$_GET['q']) ? '/?q='. \$_GET['q'].'&p='.\$_GET['p'] : '/?p='. \$_GET['p'];
        \$config['first_url'] = \$config['base_url'] . \$config['suffix'];
        \$config['total_rows'] = \$total_rows;
        \$config['per_page'] = \$rows_view;
        \$config['uri_segment'] = 4;

        \$$controller = \$this->" . $model . "->search_index_limit(\$config['per_page'], \$start, \$q);
        \$this->pagination->initialize(\$config);
        \$session_data = \$this->session->userdata('logged_in');

        \$data = array(
            'id_user' => \$session_data['id'],
            'nama_user' => \$session_data['nama'],
            'level_user' => \$session_data['level_user'],
            'access' => \$session_data['access'],
            'input_data' => \$session_data['input_data'],
            'edit_data' => \$session_data['edit_data'],
            'delete_data' => \$session_data['delete_data'],
            'perpage' => \$rows_view,
            'q' => \$q,
            'total_rows' => \$total_rows,
            '" . $controller . "_data' => \$$controller
        );
            \$this->load->view('$table/$list', \$data);
    }

    public function menu() {      
        \$session_data = \$this->session->userdata('logged_in');
        \$data = array(
            'id_user' => \$session_data['id'],
            'nama_user' => \$session_data['nama'],
            'level_user' => \$session_data['level_user'],
            'access' => \$session_data['access'],
            'input_data' => \$session_data['input_data'],
            'edit_data' => \$session_data['edit_data'],
            'delete_data' => \$session_data['delete_data'],
        );
        \$this->load->view('design/menu', \$data);
    }";

}
    
$string .= "\n\n    public function read(\$id) 
    {
        \$row = \$this->" . $model . "->get_by_id(\$id);
        \$session_data = \$this->session->userdata('logged_in');
        if (\$row) {
            \$data = array(
            'id_user' => \$session_data['id'],
            'nama_user' => \$session_data['nama'],
            'level_user' => \$session_data['level_user'],
            'access' => \$session_data['access'],
            'input_data' => \$session_data['input_data'],
            'edit_data' => \$session_data['edit_data'],
            'delete_data' => \$session_data['delete_data'],
            ";
$result2 = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table'");
if (mysql_num_rows($result2) > 0)
{
    while ($row1 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t'" . $row1['COLUMN_NAME'] . "' => \$row->" . $row1['COLUMN_NAME'] . ",";
    }
}

$string .= "\n\t    );
            \$this->load->view('$table/$read', \$data);
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('$controller'));
        }
    }
    
    public function create() 
    {
        \$session_data = \$this->session->userdata('logged_in');
        \$_idmenu = \$this->" . $model . "->get_page('" . $controller . "');
        if(in_array(\$_idmenu->id_sub, explode(',', \$session_data['input_data'])) or \$session_data['level_user']=='administrator'){
        \$data = array(
            'id_user' => \$session_data['id'],
            'nama_user' => \$session_data['nama'],
            'level_user' => \$session_data['level_user'],
            'access' => \$session_data['access'],
            'input_data' => \$session_data['input_data'],
            'edit_data' => \$session_data['edit_data'],
            'delete_data' => \$session_data['delete_data'],
            'button' => 'Create',
            'action' => site_url('$controller/create_action/?p='.\$_GET['p']),";
$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table'");
if (mysql_num_rows($result2) > 0)
{
    while ($row2 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t    '" . $row2['COLUMN_NAME'] . "' => set_value('" . $row2['COLUMN_NAME'] . "'),";
    }
}
$string .= "\n\t);      
            \$this->load->view('$table/$form', \$data);
        }else{
            \$this->load->view('errors/html/error_404');
        }
    }
    
    public function create_action() 
    {
        \$this->_rules();
        \$session_data = \$this->session->userdata('logged_in');

        if (\$this->form_validation->run() == FALSE) {
            \$this->create();
        } else {
            \$data = array(";
$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row2 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t'" . $row2['COLUMN_NAME'] . "' => \$this->input->post('" . $row2['COLUMN_NAME'] . "',TRUE),";
    }
}
$string .= "\n\t    );

            \$this->".$model."->insert(\$data);
            \$this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('$controller/?p='.\$this->input->post('p')));
        }
    }
    
    public function update(\$id) 
    {
        \$row = \$this->".$model."->get_by_id(\$id);
        \$session_data = \$this->session->userdata('logged_in');
        \$_idmenu = \$this->" . $model . "->get_page('" . $controller . "');
        if(in_array(\$_idmenu->id_sub, explode(',', \$session_data['edit_data'])) or \$session_data['level_user']=='administrator'){

        if (\$row) {
            \$data = array(
            'id_user' => \$session_data['id'],
            'nama_user' => \$session_data['nama'],
            'level_user' => \$session_data['level_user'],
            'access' => \$session_data['access'],
            'input_data' => \$session_data['input_data'],
            'edit_data' => \$session_data['edit_data'],
            'delete_data' => \$session_data['delete_data'],
                'button' => 'Update',
                'action' => site_url('$controller/update_action/?p='.\$_GET['p']),";
$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table'");
if (mysql_num_rows($result2) > 0)
{
    while ($row2 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t'" . $row2['COLUMN_NAME'] . "' => set_value('" . $row2['COLUMN_NAME'] . "', \$row->". $row2['COLUMN_NAME']."),";
    }
}
$string .= "\n\t    );
            \$this->load->view('$table/$form', \$data);
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('$controller'));
        }
        }else{
            \$this->load->view('errors/html/error_404');
        }
    }
    
    public function update_action() 
    {
        \$this->_rules();
        \$session_data = \$this->session->userdata('logged_in');

        if (\$this->form_validation->run() == FALSE) {
            \$this->update(\$this->input->post('$primary', TRUE));
        } else {
            \$data = array(";
$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row2 = mysql_fetch_assoc($result2))
    {
        $string .= "\n\t\t'" . $row2['COLUMN_NAME'] . "' => \$this->input->post('" . $row2['COLUMN_NAME'] . "',TRUE),";
    }
}
$string .= "\n\t    );

            \$this->".$model."->update(\$this->input->post('$primary', TRUE), \$data);
            \$this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('$controller/?p='.\$this->input->post('p')));
        }
    }
    
    public function delete(\$id, \$p) 
    {
        \$row = \$this->".$model."->get_by_id(\$id);
        \$session_data = \$this->session->userdata('logged_in');
        \$_idmenu = \$this->" . $model . "->get_page('" . $controller . "');
        if(in_array(\$_idmenu->id_sub, explode(',', \$session_data['delete_data'])) or \$session_data['level_user']=='administrator'){

        if (\$row) {
            \$this->".$model."->delete(\$id);
            \$this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('$controller/?p='.\$p));
        } else {
            \$this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('$controller/?p='.\$p));
        }
        } else {
            \$this->session->set_flashdata('message', 'Ditolak Hak Akses');
            redirect(site_url('" . $controller . "/?p='.\$p));
        }
    }

    public function _rules() 
    {";

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row3 = mysql_fetch_assoc($result2))
    {
        $int = $row3['DATA_TYPE'] == 'int' || $row3['DATA_TYPE'] == 'double' || $row3['DATA_TYPE'] == 'decimal' ? '|numeric' : '';
        $string .= "\n\t\$this->form_validation->set_rules('".$row3['COLUMN_NAME']."', ' ', 'trim|required$int');";
    }
}
$string .= "\n\n\t\$this->form_validation->set_rules('$primary', '$primary', 'trim');";
$string .= "\n\t\$this->form_validation->set_error_delimiters('<span class=\"text-danger\">', '</span>');
    }";

if ($excel == 'create') {
    $string .= "\n\n    public function excel()
    {
        \$this->load->helper('exportexcel');
        \$namaFile = \"$table.xls\";
        \$judul = \"$table\";
        \$tablehead = 2;
        \$tablebody = 3;
        \$nourut = 1;
        //penulisan header
        header(\"Pragma: public\");
        header(\"Expires: 0\");
        header(\"Cache-Control: must-revalidate, post-check=0,pre-check=0\");
        header(\"Content-Type: application/force-download\");
        header(\"Content-Type: application/octet-stream\");
        header(\"Content-Type: application/download\");
        header(\"Content-Disposition: attachment;filename=\" . \$namaFile . \"\");
        header(\"Content-Transfer-Encoding: binary \");

        xlsBOF();

        xlsWriteLabel(0, 0, \$judul);

        \$kolomhead = 0;
        xlsWriteLabel(\$tablehead, \$kolomhead++, \"no\");";

$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row2 = mysql_fetch_assoc($result2))
    {
        $namakolom = $row2['COLUMN_NAME'];
        $string .= "\n\txlsWriteLabel(\$tablehead, \$kolomhead++, \"$namakolom\");";
    }
}

$string .= "\n\n\tforeach (\$this->" . $model . "->get_all() as \$data) {
            \$kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber(\$tablebody, \$kolombody++, \$nourut);";
$result2 = mysql_query("SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$table' AND COLUMN_KEY <> 'PRI'");
if (mysql_num_rows($result2) > 0)
{
    while ($row2 = mysql_fetch_assoc($result2))
    {
        $namakolom = $row2['COLUMN_NAME'];
        $xlsWrite = $row2['DATA_TYPE'] == 'int' || $row2['DATA_TYPE'] == 'double' || $row2['DATA_TYPE'] == 'decimal' ? 'xlsWriteNumber' : 'xlsWriteLabel';
        $string .= "\n\t    " . $xlsWrite . "(\$tablebody, \$kolombody++, \$data->$namakolom);";
    }
}

$string .= "\n\n\t    \$tablebody++;
            \$nourut++;
        }

        xlsEOF();
        exit();
    }";
}

if ($word == 'create') {
    $string .= "\n\n    public function word()
    {
        header(\"Content-type: application/vnd.ms-word\");
        header(\"Content-Disposition: attachment;Filename=$table.doc\");

        \$data = array(
            '" . $table . "_data' => \$this->" . $model . "->get_all(),
            'start' => 0
        );
        
        \$this->load->view('" . $table . "_html',\$data);
    }";
}

$string .= "\n\n};\n\n/* End of file $controller_file */
/* Location: ./application/controllers/$controller_file */";


fwrite($createController, $string);
fclose($createController);

$controller_res = "<p>" . $path . "</p>";
?>