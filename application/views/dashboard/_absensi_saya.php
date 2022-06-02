<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('layouts/Header',[
        'judul' => 'Riwayat Absensi'
    ]) ?>
</head>
<body  class="sb-nav-fixed">
    <?php $this->load->view('layouts/Navbar') ?>
    <div id="layoutSidenav">
        <?php $this->load->view('layouts/Sidebar') ?>
        <div id="layoutSidenav_content">            
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Riwayat Absensi</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Riwayat Absensi</li>
                    </ol>
                    <div class="mt-2">
                        <?= $this->session->flashdata('alert') ?>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <strong>Filter Berdasarkan : </strong>
                            <form action="" method="POST">
                                <div class="row mt-1">
                                    <div class="col-md-3">
                                        <div class="form-group">

                                            <?php 
                                            $bulan_jml = array('01','02','03','04','05','06','07','08','09','010','011','012');
                                            $name_bulan = array(
                                                'Januari',
                                                'Februari',
                                                'Maret',
                                                'April',
                                                'Mei',
                                                'Juni',
                                                'Juli',
                                                'Agustus',
                                                'September',
                                                'Oktober',
                                                'November',
                                                'Desember',
                                            );
                                            $now = date('Y');
                                            ?>
                                            
                                            <select name="bulan" class="form-control">
                                                <option value=""> -- Pilih Bulan --</option>
                                                <?php $jumlah = count($name_bulan); ?>
                                                <?php for($x = 0; $x < $jumlah;$x+=1){  ?>
                                                    <option value="<?php echo $bulan_jml[$x] ?>"><?php echo $name_bulan[$x] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                        
                                        <select name="tahun" class="form-control">
                                            <option value="">-- Pilih Tahun --</option>
                                            <?php for($y = 2015;$y <= $now;$y++){ ?>
                                                <option value="<?php echo $y ?>"><?php echo $y ?></option>    
                                            <?php } ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-dark" name="filter">Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Riwayat Absensi
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <?php if($this->session->userdata('role') == 1 && 2){ ?>
                                        <th>Nama</th>
                                        <?php } ?>
                                        <th>Jam Masuk</th>
                                        <th>Jam Keluar</th>
                                        <th>Tanggal Absensi</th>
                                        <th>Keterangan</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; ?>
                                    <?php foreach($data as $rows){ ?>
                                    <tr>
                                        <td><?= $no+=1 ?></td>
                                        <?php if($this->session->userdata('role') == 1 && 2){ ?>
                                            <td><?= $rows->username ?></td>
                                        <?php } ?>
                                        <td><?= $rows->jam_masuk ?></td>
                                        <td>
                                            <?php if($rows->jam_keluar == '00:00:00'){ ?>
                                                -
                                            <?php }else{ ?>
                                                <?= $rows->jam_keluar ?>
                                            <?php } ?>
                                        </td>
                                        <td><?= $rows->tgl ?></td>
                                        <td><?= $rows->keterangan?></td>
                                        <td><a href="<?= base_url('detail-absensi/'.$rows->id_presensi) ?>" class="btn btn-dark">Detail</a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?php 
                                if(isset($bulan) && isset($tahun))
                                {
                                    echo "<p>Jumlah Hari belum melakukan absensi : <strong>{$this->M_riwayat->not_absensi_me($bulan,$tahun)}</strong></p>";
                                }

                            ?>
                            <?php 
                                if(isset($bulan) && isset($tahun))
                                {
                                    echo "<p>Jumlah Alpa : <strong>{$this->M_riwayat->countDataMe($tahun,$bulan,'alpa')}</strong></p>";
                                }

                            ?>
                            <?php 
                                if(isset($bulan) && isset($tahun))
                                {
                                    echo "<p>Jumlah Hadir : <strong>{$this->M_riwayat->countDataMe($tahun,$bulan,'hadir')}</strong></p>";
                                }

                            ?>
                            <?php 
                                if(isset($bulan) && isset($tahun))
                                {
                                    echo "<p>Jumlah Sakit : <strong>{$this->M_riwayat->countDataMe($tahun,$bulan,'sakit')}</strong></p>";
                                }

                            ?>
                            <?php 
                                if(isset($bulan) && isset($tahun))
                                {
                                    echo "<p>Jumlah Izin : <strong>{$this->M_riwayat->countDataMe($tahun,$bulan,'izin')}</strong></p>";
                                }

                            ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>       
    <?php $this->load->view('layouts/Footer') ?>
</body>
</html>