<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('layouts/Header',[
        'judul' => 'Management Jabatan'
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
                    <h1 class="mt-4">Management Jabatan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Management Jabatan</li>
                    </ol>
                    <div class="row">
                        <?= $this->session->flashdata('alert'); ?>
                        <div class="col-xl-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-clock"></i>
                                    Management Jabatan
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Jabatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php $nomor = 0; foreach($data as $tm){ ?>
                                            <tr>
                                                <td><?= $nomor+=1; ?></td>
                                                <td><?= $tm->ket_jabatan?></td>
                                                <td>
                                                    <a href="<?= base_url("management-jabatan?edit={$tm->id_jabatan}") ?>" class="btn btn-dark"><i class="fa fa-edit"></i></a>
                                                    <a href="<?= base_url("hapus-jabatan/{$tm->id_jabatan}") ?>" class="btn btn-dark"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>      
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($_GET["edit"])){ ?>
                        <div class="col-xl-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-clock"></i>
                                    Edit Jabatan
                                </div>
                                <div class="card-body">
                                    <form action="<?= base_url('Karyawan/storeJabatan') ?>" method="post">
                                        <div class="form-group">
                                            <input type="text" name="id" class="form-control" hidden value=<?= $this->M_karyawan->data_jabatan($_GET["edit"],'id_jabatan') ?>>
                                            <input type="text" name="jabatan" class="form-control" value="<?= $this->M_karyawan->data_jabatan($_GET["edit"],'ket_jabatan') ?>" required placeholder="Masukan Jabatan Baru">
                                        </div>
                                        <button type="submit" name="edit" class="btn btn-dark mt-2">simpan</button>
                                        <a href="<?= base_url('management-jabatan') ?>" class="btn btn-dark mt-2">Kembali</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php }else{ ?>
                            <div class="col-xl-4">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-clock"></i>
                                        Tambah Jabatan
                                    </div>
                                    <div class="card-body">
                                        <form action="<?= base_url('Karyawan/storeJabatan') ?>" method="post">
                                            <div class="form-group">
                                                <input type="text" name="jabatan" class="form-control" required placeholder="Masukan Jabatan Baru">
                                            </div>
                                            <button type="submit" name="store" class="btn btn-dark mt-2 w-100">simpan</button>
                                        </form>
                                    </div>
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