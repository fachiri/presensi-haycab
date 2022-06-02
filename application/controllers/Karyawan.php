<?php 

class Karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_karyawan');
        if($this->session->userdata('in') != 'login')
        {
            $this->session->set_flashdata('alert','<div class="alert alert-danger">Maaf anda harus Login Terlebih dahulu !</div>');
            redirect('/');
        }
    }
    public function index()
    {
        $query = $this->db->get('karyawan')->result();
        $jabatan = $this->db->get("jabatan");
        return $this->load->view('dashboard/_karyawan',[
            'data' => $query,
            'jabatan' => $jabatan
        ]);
    }
    

    public function storeJabatan()
    {
        if(isset($_POST["store"]))
        {
            $jabatan = $_POST["jabatan"];
            $this->db->insert("jabatan",[
                'ket_jabatan' => $jabatan
            ]);
            $this->session->set_flashdata('alert','<div class="alert alert-info">Jabatan Baru telah di tambahkan</div>');
            return redirect('management-jabatan');
        }
        
        if(isset($_POST["edit"]))
        {
            $this->db->where('id_jabatan',$_POST["id"]);
            $this->db->update('jabatan',[
                'ket_jabatan' => $_POST["jabatan"]
                ]);
            $this->session->set_flashdata('alert','<div class="alert alert-info">Data jabatan telah di ubah !</div>');
            return redirect('management-jabatan');
        }
    }
    public function delete($id)
    {
        $this->db->where('id_jabatan',$id);
        $this->db->delete("jabatan");
        $this->session->set_flashdata('alert','<div class="alert alert-info">Data jabatan telah di hapus !</div>');
        return redirect('management-jabatan');
        
    }
    
    public function deleteKaryawan($id)
    {
        $this->db->where('id_karyawan',$id);
        $this->db->delete("karyawan");
        $this->session->set_flashdata('alert','<div class="alert alert-info">Data Karyawan telah di hapus !</div>');
        return redirect('daftar-karyawan');
    }
    public function detail($id)
    {
        $query = $this->db->get_where('karyawan',['id_karyawan' => $id]);
        $jabatan = $this->db->get("jabatan")->result();
        return $this->load->view('dashboard/_detailKaryawan',[
            'data' => $query,
            'jabatan' => $jabatan
        ]);
    }


    public function addKaryawan()
    {
        $nik = $_POST["nik"];
        $username = $_POST["nama"];
        $email = $_POST["email"];
        $jkel = $_POST["jkel"];
        $status = $_POST["status"];
        $jabatan = $_POST["jabatan"];
        $password = $_POST["password"];
        $konfirmasi = $_POST["konfir"];
        $this->form_validation->set_rules('nik','Nik','required|trim|is_unique[karyawan.nik]');
        $this->form_validation->set_rules('jabatan','Jabatan','required');
        $this->form_validation->set_rules('nama','Nama','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[karyawan.email]');
        $this->form_validation->set_rules('password','Password','required|trim');
        $this->form_validation->set_rules('jkel','Jenis Kelamin','required|trim');
        $this->form_validation->set_rules('status','Status','required|trim');
        $this->form_validation->set_rules('konfir','Password Konfirmasi','required|trim|matches[password]');
        if($this->form_validation->run() == false)
        {
            echo json_encode([
                'status' => FALSE,
                'msg' => [
                    'nama' => form_error('nama','<small><p>','</p></small>'),
                    'email' => form_error('email','<small><p>','</p></small>'),
                    'jkel' => form_error('jkel','<small><p>','</p></small>'),
                    'status' => form_error('status','<small><p>','</p></small>'),
                    'nik' => form_error('nik','<small><p>','</p></small>'),
                    'password' => form_error('password','<small><p>','</p></small>'),
                    'konfirmasi' => form_error('konfir','<small><p>','</p></small>'),
                    'jabatan' => form_error('jabatan','<small><p>','</p></small>')
                ]
            ]);
        }else{
            try {
                $this->db->insert('karyawan',[
                    'nik' => $nik,
                    'username' => $username,
                    'password' => md5($konfirmasi),
                    'email' => $email,
                    'status' => $status,
                    'jenis_kelamin' => $jkel,
                    'id_jabatan' => $jabatan,
                    'jabatan' => 2,
                ]);
                echo json_encode([
                    'status' => TRUE,
                    'msg' => 'Data Berhasil di tambahkan'
                ]);
            } catch (\Throwable $th) {
                echo json_encode([
                    'status' => TRUE,
                    'msg' => 'Data Berhasil di tambahkan',
                    'error' => $th
                ]);
            }
        }
    }

    public function store()
    {
        if(isset($_POST["update"]))
        {
            $id = $this->input->post("id");
            $this->db->where("id_karyawan",$id);
            $this->db->update("karyawan",[
                'username' => $_POST["username"],
                'email' => $_POST["email"],
                'status' => $_POST["status"],
                'jenis_kelamin' => $_POST["jkel"],
                'id_jabatan' => $_POST["jabatan"]
            ]);
            $this->session->set_flashdata('alert','<div class="alert alert-info">Data Karyawan berhasil di perbaharui !</div>');
            return redirect('daftar-karyawan');
        }
    }
    public function jabatan()
    {
        $query = $this->db->get("jabatan")->result();
        return $this->load->view('dashboard/_jabatan',[
            'data' => $query
        ]);
    }
    public function reset()
    {
        if(isset($_POST["reset_password"]))
        {
            $id = $this->input->post("id");
            $this->db->where("id_karyawan",$id);
            $this->db->update("karyawan",[
                'password' => md5('123')
            ]);
            $this->session->set_flashdata('alert','<div class="alert alert-info">Password berhasil di reset !</div>');
            return redirect('daftar-karyawan');
        }
        if(isset($_POST["reset_absensi"]))
        {
            $id = $this->input->post("id");
            $this->db->query("DELETE FROM presensi WHERE id_pegawai = '$id'");
            $this->session->set_flashdata('alert','<div class="alert alert-info">Data Absensi Berhasil di Reset !</div>');
            return redirect('daftar-karyawan');
        }

    }
}