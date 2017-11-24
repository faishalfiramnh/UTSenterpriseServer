<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\libraries\REST_Controller;
/**
* 
*/
class peminjam extends REST_Controller
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
     
        $id_peminjam = $this->get('id_peminjam');
        if ($id_peminjam == '') 
        {
            $peminjam = $this->db->get('peminjam')->result();
        } else {
            $this->db->where('id_peminjam', $id_peminjam);
            $peminjam = $this->db->get('peminjam')->result();
        }
        $this->response($peminjam, 200);
    }

        function index_post() 
     {
        $this->load->database();
        $data = array(
                    'id_peminjam'           => $this->post('id_peminjam'),
                    'nama'          => $this->post('nama'),
                    'alamat'    => $this->post('alamat'),
                    'telpon'    => $this->post('telpon'));
        $insert = $this->db->insert('peminjam', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
     }

        function index_put() 
    {
        $this->load->database();
        $id_peminjam = $this->put('id_peminjam');
        $data = array(
                     'id_peminjam'           => $this->put('id_peminjam'),
                    'nama'          => $this->put('nama'),
                    'alamat'    => $this->put('alamat'),
                    'telpon'    => $this->put('telpon'));
        $this->db->where('id_peminjam', $id_peminjam);
        $update = $this->db->update('peminjam', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

       function index_delete() 
    {
        $this->load->database();
        $id_peminjam = $this->delete('id_peminjam');
        $this->db->where('id_peminjam', $id_peminjam);
        $delete = $this->db->delete('peminjam');
        if ($delete) 
        {
            $this->response(array('status' => 'success'), 201);
        } else 
        {
            $this->response(array('status' => 'fail', 502));
        }
    } 

}






 ?>