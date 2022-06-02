<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('layouts/Header',
    [
        'judul' => 'Dashboard'
    ]) ?>
    <style>
        video {
      width: 500px;
      height: 400px;
      object-fit: cover;
    }
    </style>
</head>
<body  class="sb-nav-fixed">
    
    <?php $this->load->view('layouts/Navbar') ?>
    <div id="layoutSidenav">
        <?php $this->load->view('layouts/Sidebar') ?>
        <div id="layoutSidenav_content">
            <?php if($this->session->userdata('role') == '1'){ ?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard </li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Karyawan</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('daftar-karyawan') ?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Jumlah Operator</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('daftar-admin') ?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Laporan Absensi</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('laporan-presensi') ?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Pesan</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?= base_url('pesan-masuk') ?>">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            <?php }else{ ?>
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <hr>
                        <div class="row mb-4">
                            <h6>Tanggal dan Waktu hari ini : <strong><?= date('Y-M-D') ?></strong></h6>
                            <?= $this->session->flashdata('alert') ?>
                            <div class="col-md-6 mt-3">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h4 class="card-text text-center">Hi, <strong><?php echo $this->session->userdata('user_name') ?></strong> Silahkan Absensi</h4>
                                        <div class="text-center">
                                            <button class="btn btn-dark mt-3 in" onclick="getPosition()"><i class="fa fa-sign-in"></i> Absensi Masuk</button>
                                            <button class="btn btn-dark mt-3 in" onclick="getOut()">Absensi Keluar <i class="fa fa-sign-out"></i> </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h4 class="card-text text-center"></strong>Ajukan Izin atau Sakit</h4>
                                        <form action="<?= base_url('Absensi/Pengajuan') ?>" method="post">
                                            <div class="form-group">
                                                <select name="pengajuan" required class="form-control">
                                                    <option value="">-- Pilih Pengajuan --</option>
                                                    <option value="izin">IZIN</option>
                                                    <option value="sakit">SAKIT</option>
                                                </select>
                                            </div>
                                            <button name="send" class="btn btn-dark mt-3 w-100"><i class="fa fa-external-link-square"></i> ajukan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-4">
                            <div class="col-md-6 mt-3" hidden>
                                <div class="card">
                                    <div class="card-body">
                                        <div id="map" style="margin-right:auto;margin-left:auto;width: 400px; height: 400px;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="my_camera">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3" hidden>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d"></div>
                                        <div id="results">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            <?php } ?>
        </div>
        <input type="text" id="url" value="<?= base_url(); ?>" hidden>
        <input type="text" hidden class="id" value="<?= $this->session->userdata('id') ?>">
    </div>       
    <?php $this->load->view('layouts/Footer') ?>
    <?php if($this->session->userdata('role') != 1 && 2){ ?>
        <script src="<?= base_url('public/leaflet/leaflet.js') ?>"></script>
        <script src="<?= base_url('public/webcam/webcam.min.js') ?>"></script>
        <script language="javascript">
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
                });
            Webcam.attach( '#my_camera' );
        </script>
        <script>
            const getOut = () => 
            {
                Webcam.snap( function(data_uri) {
                    // display results in page
                    image = data_uri;
                    document.getElementById('results').innerHTML = 
                    '<div class="text-center"><img class="img" src="'+data_uri+'"/></div>';
                });
                $.ajax({
                    type: "POST",
                    url: `${url}/Rest_api/absensi_keluar`,
                    data:{
                        gambar_out:image,
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if(response.status == 'error')
                        {
                            $.toast({
                                heading: `Error`,
                                text: `${response.desc}`,
                                showHideTransition: 'slide-right',
                                icon: 'info',
                                hideAfter: false,
                                position: 'top-right',
                                bgColor: '#e44d26'
                            });
                        }else{
                            $.toast({
                                heading: `Alert`,
                                text: `${response.desc}`,
                                showHideTransition: 'slide-right',
                                icon: 'info',
                                hideAfter: false,
                                position: 'top-right',
                                bgColor: '#28a745'
                                
                            });
                        }
                    }
                });
            }
            const url = document.querySelector('#url').value;
            const id = document.querySelector('.id').value;
            function showPosition(posisi)
            {  
                try {
                    
                    var image = '';
                    var map = L.map('map').setView([posisi.coords.latitude,posisi.coords.longitude], 13);
                    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        maxZoom: 18,
                        id: 'mapbox/streets-v11',
                        tileSize: 512,
                        zoomOffset: -1,
                        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                    }).addTo(map);
                    
                    Webcam.snap( function(data_uri) {
                        // display results in page
                        image = data_uri;
                        document.getElementById('results').innerHTML = 
                        '<div class="text-center"><img class="img" src="'+data_uri+'"/></div>';
                    });
                    $.ajax({
                        type: "POST",
                        url: `${url}/Rest_api/absensi_masuk`,
                        data:{
                            gambar:image,
                            latitude:posisi.coords.latitude,
                            longitude:posisi.coords.longitude,
                            id_karyawan:id,
                        },
                        dataType: "JSON",
                        success: function (response) {
                            if(response.status == 'alert')
                            {
                                $.toast({
                                    heading: `Alert`,
                                    text: `${response.desc}`,
                                    showHideTransition: 'slide-right',
                                    icon: 'info',
                                    hideAfter: false,
                                    position: 'top-right',
                                    bgColor: '#28a745'
                                });
                            }else{
                                $.toast({
                                    heading: `Error`,
                                    text: `${response.desc}`,
                                    showHideTransition: 'slide-right',
                                    icon: 'info',
                                    hideAfter: false,
                                    position: 'top-right',
                                    bgColor: '#e44d26'
                                });
                            }
                        }
                    });
                } catch (error) {
                    $.toast({
                        heading: `Error`,
                        text: `anda telah melakukan absensi/Laporan Masuk`,
                        showHideTransition: 'slide-right',
                        icon: 'info',
                        hideAfter: false,
                        position: 'top-right',
                        bgColor: '#e44d26'
                    });
                }
                
            }
            const getPosition = async () => 
            {
                if(navigator.geolocation)
                {
                    navigator.geolocation.getCurrentPosition(showPosition);
                }  
            }        
        </script>
    <?php } ?>
</body>
</html>