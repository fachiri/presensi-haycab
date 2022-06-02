<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('in') != 'login')
        {
            $this->session->set_flashdata('alert','<div class="alert alert-danger">Maaf anda harus Login Terlebih dahulu !</div>');
            redirect('/');
        }
    }

    public function is_role()
    {
        if($this->session->userdata('role') == 2)
        {
            return 'karyawan';
        }else{
            return 'admin';
        }
    }
    
    public static function is_roles(int $value)
    {
        if($value == 2)
        {
            return 'karyawan';
        }else{
            return 'admin';
        }
    }
	public function index()
	{
        $id = $this->session->userdata("id");
        $role = $this->session->userdata("role");
        if($this->session->userdata('role') == 2)
        {
            $this->load->view('dashboard/_profile',[
                'data' => $this->db->query("SELECT * FROM karyawan INNER JOIN jabatan ON karyawan.id_jabatan = jabatan.id_jabatan WHERE id_karyawan = '$id'")->result(),
                'role' => $this::is_roles($role)
            ]);
        }else{
            $this->load->view('dashboard/_profile',[
                'data' => $this->db->get_where('operator',['id' => $id])->result(),
                'role' => $this::is_roles($role)
            ]);
        }
	}
    public function store()
    {

        if(isset($_POST["save"]))
        {
            if($this->is_role() == 'admin')
            {
                $id = $this->session->userdata("id");
                $username = $_POST["username"];
                $email = $_POST["email"];
                $this->db->where("id",$id);
                $this->db->update('operator',[
                    'username' => $username,
                    'email' => $email,
                ]);
                $this->session->set_flashdata('alert','<div class="alert alert-info">Data Personal berhasil di perbaharui !</div>');
                return redirect('profile');
            }else{
                $id = $this->session->userdata("id");
                $username = $_POST["username"];
                $email = $_POST["email"];
                $jkel = $_POST["jkel"];
                $this->db->where("id_karyawan",$id);
                $this->db->update('karyawan',[
                    'username' => $username,
                    'email' => $email,
                    'jenis_kelamin' => $jkel
                ]);
                $this->session->set_flashdata('alert','<div class="alert alert-info">Data Personal berhasil di perbaharui !</div>');
                return redirect('profile');
            }
        }
    }

    public function password_change()
    {
        if(isset($_POST["admin"]))
        {
            $id = $this->session->userdata('id');
            $data = $this->db->get_where('operator',['id' => $id])->row_array();
            $old = $data['password'];
            $confirm = $_POST["konfir"];
            $this->form_validation->set_rules('new','Password','trim');
            $this->form_validation->set_rules('konfir','Password confirm','trim|matches[new]');
            if($this->form_validation->run() == false)
            {
                //echo 'fail';
                $error = form_error('konfir');
                $this->session->set_flashdata('alert',"<div class='alert alert-danger text-center'><strong>$error</strong></div>");
                return redirect('profile');
            }else{
                if($old == md5($confirm))
                {
                    $this->session->set_flashdata('alert',"<div class='alert alert-danger text-center'><strong>Maaf Password yang anda masukan password yang sekarang anda pakai</strong></div>");
                    return redirect('profile');
                }else{
                    $this->db->where('id',$id);
                    $this->db->update('operator',[
                        'password' => md5($confirm)
                    ]);
                    $this->session->set_flashdata('alert',"<div class='alert alert-info text-center'><strong>Berhasil !! password telah di ubah. silahkan logout</strong></div>");
                    return redirect('profile');
                }
            }

        }

        if(isset($_POST["karyawan"]))
        {
            $id = $this->session->userdata('id');
            $data = $this->db->get_where('karyawan',['id_karyawan' => $id])->row_array();
            $old = $data['password'];
            $confirm = $_POST["konfir"];
            $this->form_validation->set_rules('new','Password','trim');
            $this->form_validation->set_rules('konfir','Password confirm','trim|matches[new]');
            if($this->form_validation->run() == false)
            {
                //echo 'fail';
                $error = form_error('konfir');
                $this->session->set_flashdata('alert',"<div class='alert alert-danger text-center'><strong>$error</strong></div>");
                return redirect('profile');
            }else{
                if($old == md5($confirm))
                {
                    $this->session->set_flashdata('alert',"<div class='alert alert-danger text-center'><strong>Maaf Password yang anda masukan password yang sekarang anda pakai</strong></div>");
                    return redirect('profile');
                }else{
                    $this->db->where('id_karyawan',$id);
                    $this->db->update('karyawan',[
                        'password' => md5($confirm)
                    ]);
                    $this->session->set_flashdata('alert',"<div class='alert alert-info text-center'><strong>Berhasil !! password telah di ubah. silahkan logout</strong></div>");
                    return redirect('profile');
                }
            }
        }
    }
}
