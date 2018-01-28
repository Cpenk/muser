<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
           if($this->session->userdata('logged_in'))
           {
             $session_data = $this->session->userdata('logged_in');
             $data['username'] = $session_data['username'];
             //isi
                $this->load->model('m_model');
                $this->load->library('form_validation');
                $this->load->library('session');
                $this->load->helper('select');
                $this->load->helper('rp');
           }else{
             //Jika tidak ada session di kembalikan ke halaman login
             redirect('access', 'refresh');
           }

    }

    public function index($rows_view = 10, $start = 0)
    {
        if(empty($_GET['q'])){
            $q = '';
        }else{
            $q = $_GET['q'];
        }

        $total_rows= $this->m_model->search_total_rows($q);
        $config['base_url'] = 'm/index/'.$rows_view.'/';
        $config['suffix'] = !empty($_GET['q']) ? '/?q='. $_GET['q'].'&p='.$_GET['p'] : '/?p='. $_GET['p'];
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $rows_view;
        $config['uri_segment'] = 4;

        $m = $this->m_model->search_index_limit($config['per_page'], $start, $q);
        $this->pagination->initialize($config);
        $session_data = $this->session->userdata('logged_in');

        $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
            'input_data' => $session_data['input_data'],
            'edit_data' => $session_data['edit_data'],
            'delete_data' => $session_data['delete_data'],
            'perpage' => $rows_view,
            'q' => $q,
            'total_rows' => $total_rows,
            'm_data' => $m
        );
            $this->load->view('melting_detail/melting_detail_list', $data);
    }

    public function menu() {      
        $session_data = $this->session->userdata('logged_in');
        $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
            'input_data' => $session_data['input_data'],
            'edit_data' => $session_data['edit_data'],
            'delete_data' => $session_data['delete_data'],
        );
        $this->load->view('design/menu', $data);
    }

    public function read($id) 
    {
        $row = $this->m_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        if ($row) {
            $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
            'input_data' => $session_data['input_data'],
            'edit_data' => $session_data['edit_data'],
            'delete_data' => $session_data['delete_data'],
            
		'id' => $row->id,
		'no_trans' => $row->no_trans,
		'ingot' => $row->ingot,
		'external_scrapt' => $row->external_scrapt,
		'internal_scrapt' => $row->internal_scrapt,
		'buth_end_cutt' => $row->buth_end_cutt,
		'buth_end_ext' => $row->buth_end_ext,
		'Puing' => $row->Puing,
		'HGA' => $row->HGA,
		'cover_flux' => $row->cover_flux,
		'alsi' => $row->alsi,
		'healting_AF' => $row->healting_AF,
		'silikon_metal' => $row->silikon_metal,
		'nitrogen' => $row->nitrogen,
		'magnesium' => $row->magnesium,
		'injection_flux' => $row->injection_flux,
		'titanium_boron' => $row->titanium_boron,
	    );
            $this->load->view('melting_detail/melting_detail_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m'));
        }
    }
    
    public function create() 
    {
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->m_model->get_page('m');
        if(in_array($_idmenu->id_sub, explode(',', $session_data['input_data'])) or $session_data['level_user']=='administrator'){
        $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
            'input_data' => $session_data['input_data'],
            'edit_data' => $session_data['edit_data'],
            'delete_data' => $session_data['delete_data'],
            'button' => 'Create',
            'action' => site_url('m/create_action/?p='.$_GET['p']),
	    'id' => set_value('id'),
	    'no_trans' => set_value('no_trans'),
	    'ingot' => set_value('ingot'),
	    'external_scrapt' => set_value('external_scrapt'),
	    'internal_scrapt' => set_value('internal_scrapt'),
	    'buth_end_cutt' => set_value('buth_end_cutt'),
	    'buth_end_ext' => set_value('buth_end_ext'),
	    'Puing' => set_value('Puing'),
	    'HGA' => set_value('HGA'),
	    'cover_flux' => set_value('cover_flux'),
	    'alsi' => set_value('alsi'),
	    'healting_AF' => set_value('healting_AF'),
	    'silikon_metal' => set_value('silikon_metal'),
	    'nitrogen' => set_value('nitrogen'),
	    'magnesium' => set_value('magnesium'),
	    'injection_flux' => set_value('injection_flux'),
	    'titanium_boron' => set_value('titanium_boron'),
	);      
            $this->load->view('melting_detail/melting_detail_form', $data);
        }else{
            $this->load->view('errors/html/error_404');
        }
    }
    
    public function create_action() 
    {
        $this->_rules();
        $session_data = $this->session->userdata('logged_in');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'no_trans' => $this->input->post('no_trans',TRUE),
		'ingot' => $this->input->post('ingot',TRUE),
		'external_scrapt' => $this->input->post('external_scrapt',TRUE),
		'internal_scrapt' => $this->input->post('internal_scrapt',TRUE),
		'buth_end_cutt' => $this->input->post('buth_end_cutt',TRUE),
		'buth_end_ext' => $this->input->post('buth_end_ext',TRUE),
		'Puing' => $this->input->post('Puing',TRUE),
		'HGA' => $this->input->post('HGA',TRUE),
		'cover_flux' => $this->input->post('cover_flux',TRUE),
		'alsi' => $this->input->post('alsi',TRUE),
		'healting_AF' => $this->input->post('healting_AF',TRUE),
		'silikon_metal' => $this->input->post('silikon_metal',TRUE),
		'nitrogen' => $this->input->post('nitrogen',TRUE),
		'magnesium' => $this->input->post('magnesium',TRUE),
		'injection_flux' => $this->input->post('injection_flux',TRUE),
		'titanium_boron' => $this->input->post('titanium_boron',TRUE),
	    );

            $this->m_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('m/?p='.$this->input->post('p')));
        }
    }
    
    public function update($id) 
    {
        $row = $this->m_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->m_model->get_page('m');
        if(in_array($_idmenu->id_sub, explode(',', $session_data['edit_data'])) or $session_data['level_user']=='administrator'){

        if ($row) {
            $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
            'input_data' => $session_data['input_data'],
            'edit_data' => $session_data['edit_data'],
            'delete_data' => $session_data['delete_data'],
                'button' => 'Update',
                'action' => site_url('m/update_action/?p='.$_GET['p']),
		'id' => set_value('id', $row->id),
		'no_trans' => set_value('no_trans', $row->no_trans),
		'ingot' => set_value('ingot', $row->ingot),
		'external_scrapt' => set_value('external_scrapt', $row->external_scrapt),
		'internal_scrapt' => set_value('internal_scrapt', $row->internal_scrapt),
		'buth_end_cutt' => set_value('buth_end_cutt', $row->buth_end_cutt),
		'buth_end_ext' => set_value('buth_end_ext', $row->buth_end_ext),
		'Puing' => set_value('Puing', $row->Puing),
		'HGA' => set_value('HGA', $row->HGA),
		'cover_flux' => set_value('cover_flux', $row->cover_flux),
		'alsi' => set_value('alsi', $row->alsi),
		'healting_AF' => set_value('healting_AF', $row->healting_AF),
		'silikon_metal' => set_value('silikon_metal', $row->silikon_metal),
		'nitrogen' => set_value('nitrogen', $row->nitrogen),
		'magnesium' => set_value('magnesium', $row->magnesium),
		'injection_flux' => set_value('injection_flux', $row->injection_flux),
		'titanium_boron' => set_value('titanium_boron', $row->titanium_boron),
	    );
            $this->load->view('melting_detail/melting_detail_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m'));
        }
        }else{
            $this->load->view('errors/html/error_404');
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $session_data = $this->session->userdata('logged_in');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'no_trans' => $this->input->post('no_trans',TRUE),
		'ingot' => $this->input->post('ingot',TRUE),
		'external_scrapt' => $this->input->post('external_scrapt',TRUE),
		'internal_scrapt' => $this->input->post('internal_scrapt',TRUE),
		'buth_end_cutt' => $this->input->post('buth_end_cutt',TRUE),
		'buth_end_ext' => $this->input->post('buth_end_ext',TRUE),
		'Puing' => $this->input->post('Puing',TRUE),
		'HGA' => $this->input->post('HGA',TRUE),
		'cover_flux' => $this->input->post('cover_flux',TRUE),
		'alsi' => $this->input->post('alsi',TRUE),
		'healting_AF' => $this->input->post('healting_AF',TRUE),
		'silikon_metal' => $this->input->post('silikon_metal',TRUE),
		'nitrogen' => $this->input->post('nitrogen',TRUE),
		'magnesium' => $this->input->post('magnesium',TRUE),
		'injection_flux' => $this->input->post('injection_flux',TRUE),
		'titanium_boron' => $this->input->post('titanium_boron',TRUE),
	    );

            $this->m_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('m/?p='.$this->input->post('p')));
        }
    }
    
    public function delete($id, $p) 
    {
        $row = $this->m_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->m_model->get_page('m');
        if(in_array($_idmenu->id_sub, explode(',', $session_data['delete_data'])) or $session_data['level_user']=='administrator'){

        if ($row) {
            $this->m_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('m/?p='.$p));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m/?p='.$p));
        }
        } else {
            $this->session->set_flashdata('message', 'Ditolak Hak Akses');
            redirect(site_url('m/?p='.$p));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no_trans', ' ', 'trim|required');
	$this->form_validation->set_rules('ingot', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('external_scrapt', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('internal_scrapt', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('buth_end_cutt', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('buth_end_ext', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('Puing', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('HGA', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('cover_flux', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('alsi', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('healting_AF', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('silikon_metal', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('nitrogen', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('magnesium', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('injection_flux', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('titanium_boron', ' ', 'trim|required|numeric');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file M.php */
/* Location: ./application/controllers/M.php */