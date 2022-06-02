<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('layouts/Header',[
        'judul' => 'Pengaturan Presensi'
    ]) ?>
    </style>
</head>
<body  class="sb-nav-fixed">
    <?php $this->load->view('layouts/Navbar') ?>
    <div id="layoutSidenav">
        <?php $this->load->view('layouts/Sidebar') ?>
        <div id="layoutSidenav_content">            
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Pengaturan Presensi</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengaturan Presensi</li>
                    </ol>
                    <div class="row">
                        <?= $this->session->flashdata('alert'); ?>
                        <?php foreach($data as $tm){ ?>
                           
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-clock"></i>
                                        Ketentuan Jam Masuk dan Keluar
                                    </div>
                                    <form action="<?= base_url('Admin/store') ?>" method="post">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="">Jam Masuk</label>
                                                <input type="text" disabled class="form-control" value="<?= $tm->jam_masuk ?>">
                                                <input type="time" name="in_time" id="" class="form-control mt-1" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Jam Keluar</label>
                                                <input type="text" disabled class="form-control" value="<?= $tm->jam_keluar ?>">
                                                <input type="time" name="out_time" id="" class="form-control mt-1" required>
                                            </div>
                                            <button name="time_1" class="btn btn-dark mt-3 w-100">simpan perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-clock"></i>
                                        Ketentuan Keterlambatan dan alpa
                                    </div>
                                    <form action="<?= base_url('Admin/store') ?>" method="post">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="">Ketentuan Alpa</label>
                                                <input type="text" disabled class="form-control" value="<?= $tm->ketentuan_alpa ?>">
                                                <input type="time" name="alpa" id="" class="form-control mt-1" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Ketentuan Terlambat</label>
                                                <input type="text" disabled class="form-control" value="<?= $tm->ketentuan_terlambat ?>">
                                                <input type="time" name="late" id="" class="form-control mt-1" required>
                                            </div>
                                            <button name="time_2" class="btn btn-dark mt-3 w-100">simpan perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php $this->load->view('layouts/Footer') ?>
</body>