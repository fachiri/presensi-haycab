<?php 

class Riwayat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_riwayat');
        if($this->session->userdata('in') != 'login')
        {
            $this->session->set_flashdata('alert','<div class="alert alert-danger">Maaf anda harus Login Terlebih dahulu !</div>');
            redirect('/');
        }
    }
    public function laporan_riwayat()
    {
        $query = $this->db->query("SELECT * FROM karyawan JOIN jabatan ON karyawan.id_jabatan = jabatan.id_jabatan")->result();
        return $this->load->view('dashboard/_lap_presensi',[
            'data' => $query
        ]);
    }

    public function detail($id)
    {
        if(isset($_POST['filter']))
        {
            $id_url = $this->input->post('id_url');
            $tahun = $this->input->post('tahun');
            $bulan = $this->input->post('bulan');
            $query = $this->db->query("SELECT keterangan,id_presensi,jam_masuk,jam_keluar,DATE_FORMAT(tgl_presensi,'%d-%M-%Y') AS tgl FROM presensi WHERE month(tgl_presensi) = '$bulan' AND year(tgl_presensi) = '$tahun' AND id_pegawai ='$id'");
            if($query->num_rows() > 0)
            {   
                return $this->load->view('dashboard/_detail',[
                    'data' => $query->result(),
                    'count' => $query,
                    'tahun' => $tahun,
                    'bulan' => $bulan
                ]);
            }else{
                // echo 'tidak ada';
                $this->session->set_flashdata('alert','<div class="alert alert-danger">Maaf data tidak di temukan</div>');
                return redirect('detail-laporan/'.$id_url);
            }
        }else{
            $query = $this->db->query("SELECT keterangan,id_pegawai,id_presensi,jam_masuk,jam_keluar,
            DATE_FORMAT(tgl_presensi,'%d-%M-%Y') 
            AS tgl 
            FROM presensi 
            JOIN karyawan ON id_pegawai = id_karyawan WHERE id_pegawai = '$id'");
            if($query->num_rows() > 0)
            {   
                return $this->load->view('dashboard/_detail',[
                    'data' => $query->result(),
                    'count' => $query,
                ]);
            }else{
                $this->session->set_flashdata('alert','<div class="alert alert-danger">Maaf data tidak di temukan</div>');
                return redirect('riwayat');
            }
        }
    }
    public function my_riwayat()
    {
        $id = $this->session->userdata('id');
        $query1 = $this->db->query("SELECT keterangan,id_presensi,jam_masuk,jam_keluar,DATE_FORMAT(tgl_presensi,'%d-%M-%Y') AS tgl FROM presensi WHERE id_pegawai = '$id'")->result();
        if(isset($_POST['filter']))
        {

            $tahun = $this->input->post('tahun');
            $bulan = $this->input->post('bulan');
            $query = $this->db->query("SELECT keterangan,id_presensi,jam_masuk,jam_keluar,DATE_FORMAT(tgl_presensi,'%d-%M-%Y') AS tgl FROM presensi WHERE month(tgl_presensi) = '$bulan' AND year(tgl_presensi) = '$tahun' AND id_pegawai = '$id'");
            if($query->num_rows() > 0)
            {   
                return $this->load->view('dashboard/_absensi_saya',[
                    'data' => $query->result(),
                    'count' => $query,
                    'tahun' => $tahun,
                    'bulan' => $bulan
                ]);
            }else{
                $this->session->set_flashdata('alert','<div class="alert alert-danger">Maaf data tidak di temukan</div>');
                return redirect('riwayat');
            }
        }else{
            return $this->load->view('dashboard/_absensi_saya',[
                'data' => $query1
            ]);
        }
    }
    public function riwayat_all()
    {
        $id = $this->session->userdata('id');
        $query1 = $this->db->query("SELECT username,nik,keterangan,id_pegawai,id_presensi,jam_masuk,jam_keluar,
        DATE_FORMAT(tgl_presensi,'%d-%M-%Y') 
        AS tgl 
        FROM presensi 
        JOIN karyawan ON id_pegawai = id_karyawan")->result();
        if(isset($_POST['filter']))
        {
            $tahun = $this->input->post('tahun');
            $bulan = $this->input->post('bulan');
            $query = $this->db->query("SELECT keterangan,id_presensi,jam_masuk,jam_keluar,DATE_FORMAT(tgl_presensi,'%d-%M-%Y') AS tgl FROM presensi WHERE month(tgl_presensi) = '$bulan' AND year(tgl_presensi) = '$tahun'");
            if($query->num_rows() > 0)
            {   
                return $this->load->view('dashboard/_absensi_saya',[
                    'data' => $query->result(),
                    'count' => $query
                ]);
            }else{
                $this->session->set_flashdata('alert','<div class="alert alert-danger">Maaf data tidak di temukan</div>');
                return redirect('riwayat');
            }
        }else{
            
            return $this->load->view('dashboard/_absensi_saya',[
                'data' => $query1
            ]);
        }
    }

    public function detail_absensi($id)
    {
        //$data = $this->db->get_where('presensi',['id_presensi' => $id]);
        $data = $this->db->query("SELECT * FROM presensi JOIN karyawan ON id_pegawai = id_karyawan WHERE id_presensi = '$id'");
        $this->load->view('dashboard/_detailAbsensi',[
            'data' => $data
        ]);
    }

}