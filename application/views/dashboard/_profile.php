<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('layouts/Header',[
        'judul' => 'Profile'
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
                    <h1 class="mt-4">Profile</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                    <div class="row">
                        <?= $this->session->flashdata('alert'); ?>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-user"></i>
                                    Profile Karyawan
                                </div>
                                <div class="card-body">
                                    <?php foreach($data as $get){ ?>
                                        <form action="<?= base_url('Profile/store') ?>" method="post">
                                            <div class="form-group">
                                                <label for="" class="mt-1">Nama Lengkap</label>
                                                <input type="text" value="<?= $get->username; ?>" name="username" class="form-control" placeholder="Nama Lengkap">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="" class="mt-1">Email</label>
                                                <input type="text" value="<?= $get->email ?>" name="email" class="form-control" placeholder="Email">
                                            </div>
                                            <?php if($this->session->userdata('role') != 1){ ?>
                                            <div class="form-group mt-2">
                                                <label for="">Jenis Kelamin</label>
                                                <select name="jkel" id="" class="form-control">
                                                    <option value="">Jenis Kelamin</option>
                                                    <option value="L" <?php if($get->jenis_kelamin == 'L'){ echo 'selected'; } ?>>Laki-Laki</option>
                                                    <option value="P" <?php if($get->jenis_kelamin == 'P'){ echo 'selected'; } ?>>Perempuan</option>
                                                </select>
                                            </div>
                                            <?php } ?>
                                            <?php if($this->session->userdata('role') != 1){ ?>
                                            <div class="form-group mt-2">
                                                <label for="" class="mt-1">Jabatan</label>
                                                <input type="text" name="jabatan" class="form-control" disabled value="<?= $get->ket_jabatan ?>" placeholder="Jabatan">
                                            </div>
                                            <?php }else{ ?>
                                                <div class="form-group mt-2">
                                                    <label for="" class="mt-1">Jabatan</label>
                                                    <input type="text" name="jabatan" class="form-control" disabled value="Operator" placeholder="Jabatan">
                                                </div>
                                            <?php }?>
                                            <button name="save" class="w-100 btn btn-dark mt-3">simpan perubahan</button>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-gear me-1"></i>
                                    Pengaturan Akun
                                </div>
                                <form action="<?= base_url('Profile/password_change') ?>" method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="" class="mt-1">Password baru</label>
                                            <input type="text" name="new" class="form-control" required placeholder="Password baru">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="" class="mt-1">Konfirmasi Password</label>
                                            <input type="text" name="konfir" class="form-control" required placeholder="Konfirmasi Password">
                                        </div>
                                        <button class="btn btn-dark w-100 mt-3" name="<?= $role ?>">ubah password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php $this->load->view('layouts/Footer') ?>
</body>