<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesan extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('in') != 'login')
        {
            $this->session->set_flashdata('alert','<div class="alert alert-danger">Maaf anda harus Login Terlebih dahulu !</div>');
            redirect('/');
        }
    }

	public function index()
	{
		$this->load->view('dashboard/_inbox');
	}

    public function list_inbox()
    {
        $query = $this->db->query("SELECT * FROM karyawan INNER JOIN jabatan ON karyawan.id_jabatan = jabatan.id_jabatan")->result();
        return $this->load->view('dashboard/_pesan',[
            'data' => $query
        ]);
    }

    public function admin_message($id)
    {
        $data = [
            'data' => $this->db->get_where('karyawan',['id_karyawan' => $id])->row_array()
        ];
        $this->load->view('dashboard/_message-admin',$data);
    }
}
