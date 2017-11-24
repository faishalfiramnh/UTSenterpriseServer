<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;

/**
* 
*/
class Buku extends REST_Controller
{
	
	function __construct($config='rest')
	{
		 parent::__construct($config);
        $this->load->database();
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
	}

	 function index_get() 
     {
     
        $id_buku = $this->get('id_buku');
        if ($id_buku == '') {
            $buku = $this->db->get('buku')->result();
        } else {
            $this->db->where('id_buku', $id_buku);
            $buku = $this->db->get('buku')->result();
        }
        $this->response($buku, 200);
    }

    function index_post() 
    {
        $this->load->database();
        $data = array(
                    'id_buku'           => $this->post('id_buku'),
                    'judul'          => $this->post('judul'),
                    'pengarang'    => $this->post('pengarang'),
                    'tahun_terbit'    => $this->post('tahun_terbit'));
        $insert = $this->db->insert('buku', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() 
    {
        $this->load->database();
        $id_buku = $this->put('id_buku');
        $data = array(
                     'id_buku'           => $this->put('id_buku'),
                    'judul'          => $this->put('judul'),
                    'pengarang'    => $this->put('pengarang'),
                    'tahun_terbit'    => $this->put('tahun_terbit'));
        $this->db->where('id_buku', $id_buku);
        $update = $this->db->update('buku', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() 
    {
        $this->load->database();
        $id_buku = $this->delete('id_buku');
        $this->db->where('id_buku', $id_buku);
        $delete = $this->db->delete('buku');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    } 


}


 ?>