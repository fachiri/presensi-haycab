<?php 

class Admin extends CI_Controller
{
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
        $query = $this->db->get('operator')->result();
        return $this->load->view('dashboard/_admin',[
            'data' => $query
        ]);
    }

    public function detail($id)
    {
        $query = $this->db->get_where('operator',['id' => $id]);
        return $this->load->view('dashboard/_detailAdmin',[
            'data' => $query
        ]);
    }

    public function pengaturan()
    {
        $data = $this->db->get('ketentuan');
        return $this->load->view('dashboard/_setPresensi',[
            'data' => $data->result()
        ]);
    }

    public function addAdmin()
    {
        //if(isset($_POST["save"]))
        //{
        $username = $_POST["nama"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $konfirmasi = $_POST["konfirmasi"];
        $this->form_validation->set_rules('nama','Nama','required|trim|is_unique[operator.username]');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[operator.email]');
        $this->form_validation->set_rules('password','Password','required|trim');
        $this->form_validation->set_rules('konfirmasi','Password Konfirmasi','required|trim|matches[password]');
        if($this->form_validation->run() == false)
        {
            echo json_encode([
                'status' => FALSE,
                'msg' => [
                    'nama' => form_error('nama','<small><p>','</p></small>'),
                    'email' => form_error('email','<small><p>','</p></small>'),
                    'password' => form_error('password','<small><p>','</p></small>'),
                    'konfirmasi' => form_error('konfirmasi','<small><p>','</p></small>')
                ]
            ]);
        }else{
            $this->db->insert('operator',[
                'username' => $username,
                'password' => md5($konfirmasi),
                'email' => $email,
                'role' => 1
            ]);
            echo json_encode([
                'status' => TRUE,
                'msg' => 'Data Berhasil di tambahkan'
            ]);
        }


        //}
    }
    public function storeAdmin()
    {
        if(isset($_POST["update"]))
        {
            $id = $_POST["id"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $this->db->where("id",$id);
            $this->db->update("operator",[
                'username' => $username,
                'email' => $email
            ]);
            $this->session->set_flashdata('alert','<div class="alert alert-info">Data Berhasil di ubah</div>');
            return redirect('daftar-admin');
        }
    }
    
    public function reset()
    {
        if(isset($_POST["reset_password"]))
        {
            $id = $_POST["id"];
            $this->db->where('id',$id);
            $this->db->update('operator',['password' => md5('12345')]);
            $this->session->set_flashdata('alert','<div class="alert alert-info">Password Berhasil di reset !</div>');
            return redirect('daftar-admin');
        }
    }
    public function store()
    {
        if(isset($_POST["time_1"]))
        {
            $in = $this->input->post("in_time");
            $out = $this->input->post("out_time");
            $this->db->where("id",1);
            $this->db->update('ketentuan',[
                'jam_masuk' => $in,
                'jam_keluar' => $out
            ]);
            $this->session->set_flashdata('alert','<div class="alert alert-info">Waktu Presensi Berhasil di ubah</div>');
            return redirect('pengaturan-presensi');
            
        }
        
        if(isset($_POST["time_2"]))
        {
            $alpa = $_POST["alpa"];
            $late = $_POST["late"];
            $this->db->where("id",1);
            $this->db->update('ketentuan',[
                'ketentuan_alpa' => $alpa,
                'ketentuan_terlambat' => $late
            ]);
            $this->session->set_flashdata('alert','<div class="alert alert-info">Waktu Presensi Berhasil di ubah</div>');
            return redirect('pengaturan-presensi');
        }
    }

}