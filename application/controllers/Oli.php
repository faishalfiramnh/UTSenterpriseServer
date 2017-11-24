<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;
///serverrr/

class 	oli extends REST_Controller {

    function __construct($config='rest'){
        parent::__construct($config);
        $this->load->database();
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');


    }

    function index_get() {
     
        $id = $this->get('id');
        if ($id == '') {
            $oli = $this->db->get('oli')->result();
        } else {
            $this->db->where('id', $id);
            $oli = $this->db->get('oli')->result();
        }
        $this->response($oli, 200);
    }

        function index_post() {
        $this->load->database();
        $data = array(
                    'id'           => $this->post('id'),
                    'nama_oli'          => $this->post('nama_oli'),
                    'kekentalan'    => $this->post('kekentalan'),
                    'satuan_liter'    => $this->post('satuan_liter'));
        $insert = $this->db->insert('oli', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


         function index_put() {
        $this->load->database();
        $id = $this->put('id');
        $data = array(
                     'id'           => $this->put('id'),
                    'nama_oli'          => $this->put('nama_oli'),
                    'kekentalan'    => $this->put('kekentalan'),
                    'satuan_liter'    => $this->put('satuan_liter'));
        $this->db->where('id', $id);
        $update = $this->db->update('oli', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

       function index_delete() {
        $this->load->database();
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('oli');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    } 

}

