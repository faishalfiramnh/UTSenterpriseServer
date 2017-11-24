<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;
///serverrr/

class 	bengkel extends REST_Controller {

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
            $bengkel = $this->db->get('bengkel')->result();
        } else {
            $this->db->where('id', $id);
            $bengkel = $this->db->get('bengkel')->result();
        }
        $this->response($bengkel, 200);
    }

        function index_post() {
        $this->load->database();
        $data = array(
                    'id'           => $this->post('id'),
                    'nama_motor'          => $this->post('nama_motor'),
                    'jenis_kerusakan'    => $this->post('jenis_kerusakan'),
                    'harga'    => $this->post('harga'),
                     'jenis_motor'    => $this->post('jenis_motor'));
        $insert = $this->db->insert('bengkel', $data);
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
                    'nama_motor'          => $this->put('nama_motor'),
                    'jenis_kerusakan'    => $this->put('jenis_kerusakan'),
                    'harga'    => $this->put('harga'),
                     'jenis_motor'    => $this->put('jenis_motor'));
        $this->db->where('id', $id);
        $update = $this->db->update('bengkel', $data);
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
        $delete = $this->db->delete('bengkel');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    } 

}

