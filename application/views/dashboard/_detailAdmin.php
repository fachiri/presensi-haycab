<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('layouts/Header',[
        'judul' => 'Detail Admin'
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
                    <h1 class="mt-4">Edit Data Admin</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Data Admin</li>
                    </ol>
                    <div class="row">
                        <?= $this->session->flashdata('alert'); ?>
                        <?php if($data->num_rows() > 0){ ?>
                            <?php foreach($data->result() as $tm){ ?>   
                                    <div class="col-xl-6">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <i class="fa fa-database"></i>
                                                Reset Data
                                            </div>
                                            <div class="card-body">
                                                <form action="<?= base_url('Admin/reset') ?>" method="post">
                                                    <input hidden type="text" name="id" value="<?= $tm->id ?>">
                                                    <button name="reset_password" class="btn btn-danger w-100"><i class="fas fa-refresh"></i> Reset Password</button>
                                                </form>
                                    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="card mb-4">
                                            <div class="card-header">
                                                <i class="fas fa-user"></i>
                                                <?php echo $tm->username ?>
                                            </div>
                                            <div class="card-body">
                                                <form action="<?= base_url('Admin/storeAdmin') ?>" method="post">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <input type="text" hidden name="id" value="<?= $tm->id ?>">
                                                        <input type="text" name="username" class="form-control" value="<?= $tm->username ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" name="email" class="form-control" value="<?= $tm->email ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Jabatan</label>
                                                        <input type="text" class="form-control" value="Operator" disabled>
                                                    </div>
                                                    <button name="update" class="btn btn-dark w-100 mt-3"><i class="fas fa-save"></i> simpan </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            <?php } ?>
                        <?php }else{ ?>
                            <div class="alert alert-danger">Maad data yang anda cari tidak di temukan</div>
                        <?php } ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php $this->load->view('layouts/Footer') ?>
</body>