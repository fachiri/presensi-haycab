<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('layouts/Header',[
        'judul' => 'Detail Presensi'
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
                    <h1 class="mt-4">Detail Presensi</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Detail Presensi</li>
                    </ol>
                    <?php if($data->num_rows() > 0){ ?>
                        <?php $get = $data->row_array() ?>
                        <div class="row">
                            <?php if($this->session->userdata('role') == 1){ ?>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-map"></i>
                                        Map Lokasi Presensi
                                    </div>
                                    <div class="card-body">
                                        <input type="text" hidden value="<?= $get["longitude"] ?>" class="longitude">
                                        <input type="text" hidden value="<?= $get["latidude"] ?>" class="latidude">
                                        <div id="maping">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-profile"></i>
                                        Profile Absensi
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <p><strong><?= $get["username"] ?></strong></p>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jam Masuk</label>
                                            <p><strong><?= $get["jam_masuk"] ?></strong></p>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label for="">Jam Keluar</label>
                                            <p><strong><?= $get["jam_keluar"] ?></strong></p>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label for="">Keterangan</label>
                                            <p><strong><?= strtoupper($get["keterangan"]) ?></strong></p>
                                        </div>
                                        <div class="form-group mt-1">
                                            <label for="">Tanggal Absensi</label>
                                            <p><strong><?= ($get["tgl_presensi"]) ?></strong></p>
                                        </div>
                                        <div class="form-group">
                                            <div class="card">
                                                <div class="card-header">
                                                    Photo Absensi Masuk
                                                </div>
                                                <div class="card-body text-center">
                                                    <img src="<?= base_url('public/images/'.$get["gambar_in"]) ?>" class="img-fluid" alt="" srcset="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }else{ ?>
                        <div class="row">
                            <div class="alert alert-danger">Maaf halaman yang anda cari tidak ditemukan !</div>
                        </div>
                    <?php } ?>
                </div>
            </main>
        </div>
    </div>
    <?php $this->load->view('layouts/Footer') ?>
    <script src="<?= base_url('public/leaflet/leaflet.js') ?>"></script>
    <script src="<?= base_url('public/webcam/webcam.min.js') ?>"></script>
    <script>
        $(document).ready(function(){
            document.getElementById("maping").innerHTML = '<div id="map" style="margin-right:auto;margin-left:auto;width: 400px; height: 400px;"></div>';
            const longitude = document.querySelector('.longitude').value;
            const latitude  = document.querySelector('.latidude').value;
            var map = L.map('map').setView([latitude,longitude], 13);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
            }).addTo(map);
            L.marker([latitude,longitude]).addTo(map).bindPopup("<b>Hai!</b><br />Ini adalah lokasi mu");
        });
    </script>
</body>