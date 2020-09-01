<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Server extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    public function index_get()
    {
    	$id = $this->input->get('id');
    	if ($id == '') {
    		$data = $this->db->get('tbl_mahasiswa')->result();
    	}else{
    		$this->db->where('id', $id);
            $data = $this->db->get('tbl_mahasiswa')->result();
    	}
    	$this->response($data, 200);
    }

    public function index_post()
    {
    	$data = array(
                    'id'           => $this->post('id'),
                    'nama'          => $this->post('nama'),
                    'nim'    => $this->post('nim'));
        $insert = $this->db->insert('tbl_mahasiswa', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    public function index_put() 
    {
        $id = $this->put('id');
        $data = array(
                    'id'       => $this->put('id'),
                    'nama'          => $this->put('nama'),
                    'nim'    => $this->put('nim'));
        $this->db->where('id', $id);
        $update = $this->db->update('tbl_mahasiswa', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    public function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('tbl_mahasiswa');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}
