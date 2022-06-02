<?php

class M_riwayat extends CI_Model
{
    public function countData($tahun,$bulan,$keterangan)
    {
        $id = $this->uri->segment(2);
        $query = $this->db->query("SELECT keterangan,id_presensi,jam_masuk,jam_keluar,DATE_FORMAT(tgl_presensi,'%d-%M-%Y') AS tgl FROM presensi WHERE month(tgl_presensi) = '$bulan' AND year(tgl_presensi) = '$tahun' AND id_pegawai ='$id' AND keterangan = '$keterangan'");
        return $query->num_rows();
    }
    public function countDataMe($tahun,$bulan,$keterangan)
    {
        $id = $this->session->userdata('id');
        $query = $this->db->query("SELECT keterangan,id_presensi,jam_masuk,jam_keluar,DATE_FORMAT(tgl_presensi,'%d-%M-%Y') AS tgl FROM presensi WHERE month(tgl_presensi) = '$bulan' AND year(tgl_presensi) = '$tahun' AND id_pegawai ='$id' AND keterangan = '$keterangan'");
        return $query->num_rows();
    }


    public function not_absensi($bulan,$tahun)
    {
        //$kalender = CAL_GREGORIAN;
        //$hari = cal_days_in_month($kalender,$bulan,$tahun);
        //$rumus = 
        //$this->countData($tahun,$bulan,'izin') + $this->countData($tahun,$bulan,'alpa') +
        //$this->countData($tahun,$bulan,'sakit') + $this->countData($tahun,$bulan,'hadir');
        //return $rumus - $hari;
        $kalender = CAL_GREGORIAN;
        $hari = cal_days_in_month($kalender,$bulan,$tahun);
        $rumus = $this->countData($tahun,$bulan,'alpa') + $this->countData($tahun,$bulan,'hadir') +
        $this->countData($tahun,$bulan,'izin') + $this->countData($tahun,$bulan,'sakit') + 
        $this::count_minggu($bulan,$tahun) + $this::count_sabtu($bulan,$tahun) +
        $this->countData($tahun,$bulan,'terlambat') - $hari;
        return $rumus;
    }

    public static function count_minggu($bulan,$tahun)
    {
        $count_minggu = 0;
        $kalender = CAL_GREGORIAN;
        $hari = cal_days_in_month($kalender,$bulan,$tahun);
        for($i = 1;$i <= $hari;$i++)
        {
            $flter = "{$tahun}/{$bulan}/{$i}";
            $day = date('l',strtotime($flter));
            if($day == 'Sunday')
            {
                $count_minggu+=1;
            }
        }
        return $count_minggu;
    }
    public static function count_sabtu($bulan,$tahun)
    {
        $count_sabtu = 0;
        $kalender = CAL_GREGORIAN;
        $hari = cal_days_in_month($kalender,$bulan,$tahun);
        for($i = 1;$i <= $hari;$i++)
        {
            $flter = "{$tahun}/{$bulan}/{$i}";
            $day = date('l',strtotime($flter));
            if($day == 'Saturday')
            {
                $count_sabtu+=1;
            }
        }
        return $count_sabtu;
    }

    public function not_absensi_me($bulan,$tahun)
    {
        $kalender = CAL_GREGORIAN;
        $hari = cal_days_in_month($kalender,$bulan,$tahun);
        $rumus = $this->countDataMe($tahun,$bulan,'alpa') + $this->countDataMe($tahun,$bulan,'hadir') +
        $this->countDataMe($tahun,$bulan,'izin') + $this->countDataMe($tahun,$bulan,'sakit') + 
        $this::count_minggu($bulan,$tahun) + $this::count_sabtu($bulan,$tahun) +
        $this->countDataMe($tahun,$bulan,'terlambat') - $hari;
        return $rumus;
    }
}


?>