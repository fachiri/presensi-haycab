<?php
define('UPLOAD_DIR', 'public/images/');

class Rest_api extends CI_Controller {
    public function chat()
    {
        $id = $this->session->userdata('id');
        $query = $this->db->query("SELECT 
        DATE_FORMAT(tanggal,'Jam - %H:%i') AS waktu, 
        DATE_FORMAT(tanggal,'%d-%M-%Y') AS Tanggal,
        pesan,longitude,latitude,gambar,id_pesan,id_pegawai FROM inbox WHERE id_pegawai = '$id'")->result();
        echo json_encode($query);
    }

    public function chat_admin()
    {
        $id = $this->input->get('id');
        $query = $this->db->query("SELECT 
        DATE_FORMAT(tanggal,'Jam - %H:%i') AS waktu, 
        DATE_FORMAT(tanggal,'%d-%M-%Y') AS Tanggal,
        pesan,longitude,latitude,gambar,id_pesan,id_pegawai FROM inbox WHERE id_pegawai = '$id'")->result();
        echo json_encode($query);
    }

    public function inbox()
    {
        $this->form_validation->set_rules('pesan','Pesan','required|trim');
        if($this->form_validation->run() == false)
        {
            echo json_encode('gagal');
        }else{
            $image = $this->input->post('images');
            $image        = str_replace('data:image/jpeg;base64,', '', $image);
            $image        = str_replace(' ', '+', $image);
            $data = base64_decode($image);
            $name_file = uniqid() . '.png';
            file_put_contents(UPLOAD_DIR.$name_file, $data);
            $token = [
                'id_pegawai' => $this->session->userdata('id'),
                'longitude' => $this->input->post('longitude'),
                'latitude'  => $this->input->post('latitude'),
                'pesan' => $this->input->post('pesan'),
                'gambar' => $name_file
            ];
            $this->db->insert('inbox',$token);
            echo json_encode('berhasil');
        }

    }
    public static function waktu_now()
    {
        $timezone = new DateTimeZone('Asia/Ujung_Pandang');
        $date = new DateTime();
        $date->setTimeZone($timezone);
        return $date->format('H:i:s');
    }

    public function absensi_keluar()
    {
        $image = $this->input->post('gambar_out');
        $image        = str_replace('data:image/jpeg;base64,', '', $image);
        $image        = str_replace(' ', '+', $image);
        $data = base64_decode($image);
        $id = $this->session->userdata('id');
        $now = date('Y-m-d');
        $ketentuan = $this->db->get('ketentuan')->row_array();
        $query = $this->db->query("SELECT keterangan,jam_masuk,jam_keluar,id_presensi,DATE_FORMAT(tgl_presensi,'%d %m %y') AS tl FROM presensi WHERE id_pegawai = '$id' AND tgl_presensi = '$now'");
        $data = $query->row_array();
        if($query->num_rows() > 0)
        {
            if($data['jam_keluar'] == '00:00:00')
            {
                if($data['keterangan'] == 'alpa')
                {
                    $response = [
                        'status' => 'error',
                        'desc' => 'sudah alpa ! tidak dapat melakukan absensi keluar',
                    ];
                    echo json_encode($response);
                }else if($data['keterangan'] == 'izin'){
                    $response = [
                        'status' => 'error',
                        'desc' => 'sudah izin',
                    ];
                    echo json_encode($response);
                }else{
                    if(Rest_api::waktu_now() < $ketentuan['jam_keluar'])
                    {
                        $response = [
                            'status' => 'error',
                            'desc' => 'anda belum bisa absensi keluar',
                        ];
                        echo json_encode($response);
                    }else{
                        $name_file = uniqid() . '.png';
                        file_put_contents(UPLOAD_DIR.$name_file, $data);
                        $token = [
                            'gambar_in' => $name_file,
                            'jam_keluar' => Rest_api::waktu_now(),
                        ];
                        $waktu = Rest_api::waktu_now();
                        $this->db->query("UPDATE presensi SET gambar_out = '$name_file', jam_keluar = '$waktu' WHERE id_pegawai = '$id' AND tgl_presensi = '$now'");
                        $response = [
                            'status' => 'alert',
                            'desc' => 'absensi keluar berhasil!',
                            'nama_gbr' => $name_file 
                        ];
                        echo json_encode($response);
                    }
                }
            }else{
                $response = [
                    'status' => 'error',
                    'desc' => 'anda telah melakukan absensi pulang'
                ];
                echo json_encode($response);
            }
        }else{
            $response = [
                'status' => 'error',
                'desc' => 'anda belum melakukan absensi masuk'
            ];
            echo json_encode($response);
        }

    }

    public function absensi_masuk()
    {
        $image = $this->input->post('gambar');
        $image        = str_replace('data:image/jpeg;base64,', '', $image);
        $image        = str_replace(' ', '+', $image);
        $data = base64_decode($image);
        $id = $this->session->userdata('id');
        $now = date('Y-m-d');
        $ketentuan = $this->db->get('ketentuan')->row_array();
        $query = $this->db->query("SELECT jam_masuk,jam_keluar,id_presensi,DATE_FORMAT(tgl_presensi,'%d %m %y') AS tl FROM presensi WHERE id_pegawai = '$id' AND tgl_presensi = '$now'");
        $data_query = $query->row_array();
        $today = date('l');
        if($today == 'Sunday' || $today == 'Saturday')
        {
            $response = [
                'status' => 'error',
                'desc' => 'Tidak dapat melakukan absensi pada hari sabtu dan minggu'
            ];
            echo json_encode($response);
        }else{
            if($query->num_rows() > 0)
            {
                $response = [
                    'status' => 'error',
                    'desc' => 'anda telah melakukan absensi masuk'
                ];
                echo json_encode($response);
            }else{
                if(Rest_api::waktu_now() > $ketentuan['ketentuan_alpa'])
                {
                    $name_file = uniqid() . '.png';
                    file_put_contents(UPLOAD_DIR.$name_file, $data);
                    $token = [
                        'id_pegawai' => $this->input->post("id_karyawan"),
                        'latidude' => $this->input->post('latitude'),
                        'longitude' => $this->input->post('longitude'),
                        'gambar_in' => $name_file,
                        'jam_masuk' => Rest_api::waktu_now(),
                        'tgl_presensi' => $now,
                        'keterangan' => 'alpa',
                    ];
                    $this->db->insert('presensi',$token);
                    $response = [
                        'status' => 'error',
                        'desc' => 'anda telah alpa'
                    ];
                    echo json_encode($response);
                }else{
                    if(Rest_api::waktu_now() > $ketentuan['ketentuan_terlambat'])
                    {
                        $name_file = uniqid() . '.png';
                        file_put_contents(UPLOAD_DIR.$name_file, $data);
                        $token = [
                            'id_pegawai' => $this->input->post("id_karyawan"),
                            'latidude' => $this->input->post('latitude'),
                            'longitude' => $this->input->post('longitude'),
                            'gambar_in' => $name_file,
                            'jam_masuk' => Rest_api::waktu_now(),
                            'tgl_presensi' => $now,
                            'keterangan' => 'terlambat',
                        ];
                        $this->db->insert('presensi',$token);
                        $response = [
                            'status' => 'alert',
                            'desc' => 'anda telah berhasil melakukan absensi, tetapi terlambat',
                        ];
                        echo json_encode($response);
                    }else{
                        if(Rest_api::waktu_now() < $ketentuan['jam_masuk'])
                        {
                            $response = [
                                'status' => 'error',
                                'desc' => "Maaf anda belum bisa melakukan absensi sebelum {$ketentuan['jam_masuk']}",
                            ];
                            echo json_encode($response);
                        }else{
                            $name_file = uniqid() . '.png';
                            file_put_contents(UPLOAD_DIR.$name_file, $data);
                            $token = [
                                'id_pegawai' => $this->input->post("id_karyawan"),
                                'latidude' => $this->input->post('latitude'),
                                'longitude' => $this->input->post('longitude'),
                                'gambar_in' => $name_file,
                                'jam_masuk' => Rest_api::waktu_now(),
                                'tgl_presensi' => $now,
                                'keterangan' => 'hadir',
                            ];
                            $this->db->insert('presensi',$token);
                            $response = [
                                'status' => 'alert',
                                'desc' => 'anda telah berhasil melakukan absensi tepat waktu',
                            ];
                            echo json_encode($response);
                        }
                    }
                }
            }
        }
    }
}
