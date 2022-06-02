<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('layouts/Header',[
        'judul' => 'Pesan'
    ]) ?>
</head>
<body  class="sb-nav-fixed">
    <?php $this->load->view('layouts/Navbar') ?>
    <div id="layoutSidenav">
        <?php $this->load->view('layouts/Sidebar') ?>
        <div id="layoutSidenav_content">            
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Pesan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pesan Masuk</li>
                    </ol>
                    <div class="mt-2">
                        <?= $this->session->flashdata('alert') ?>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Pesan
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <?php if($this->session->userdata('role') == 1 && 2){ ?>
                                        <th>Nama</th>
                                        <?php } ?>
                                        <th>Jabatan</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; ?>
                                    <?php foreach($data as $rows){ ?>
                                    <tr>
                                        <td><?= $no+=1 ?></td>
                                        <td><?= $rows->username ?></td>
                                        <td><?= $rows->ket_jabatan ?></td>
                                        <td><a href="<?= base_url('detail-message/'.$rows->id_karyawan) ?>" class="btn btn-dark">Detail</a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>       
    <?php $this->load->view('layouts/Footer') ?>
</body>
</html>