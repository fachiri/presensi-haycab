<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('layouts/Header',[
        'judul' => 'Pesan'
    ]) ?>
    <style>
        video {
      width: 900px;
      height: 400px;
      object-fit: cover;
    }
    #my_camera{
        margin-left: auto;
        margin-right: auto;
        width:fit-content;
        height:fit-content;
    }

    </style>
    <link rel="stylesheet" href="<?= base_url('public/css/inbox.css') ?>">
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
                        <li class="breadcrumb-item active">Pesan</li>
                    </ol>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">Kamera</div>
                                        <div class="card-body">
                                            <div id="my_camera"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                                    <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                        <div class="d-flex align-items-center py-1">
                                            <div class="position-relative">
                                                <img src="<?= base_url('public/images/profile.png') ?>" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                            </div>
                                            <div class="flex-grow-1 pl-3">
                                                <strong style="margin-left: 10px;">Operator</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative mt-4 d">
                                        
                                    </div>
                                    <div class="flex-grow-0 py-3 px-4 border-top">
                                        <div class="input-group">
                                            <input type="text" class="url" hidden value="<?= base_url() ?>">
                                            <input type="text" class="form-control pesan">
                                            <button class="btn btn-dark send">Kirim</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <div class="modal fade" id="detail_" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Lokasi</h5>
                <button type="button" class="btn btn-danger close" data-dismiss="modal" aria-label="Close">
                    x
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label" hidden>longitude</label>
                    <input type="text" class="form-control longitude" hidden>
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label" hidden>latitude</label>
                    <input type="text" class="form-control latitude" hidden>
                </div>
                <div id="maping">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('layouts/Footer') ?>
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
        $(document).ready(() => {
            const url = document.querySelector('.url').value;
            const data = () => 
            {
                var data_judul = "";
                var html = '';
                var image = '';
                $.ajax({
                    type: "GET",
                    url: document.querySelector('.url').value + '/Rest_api/chat',
                    dataType: "JSON",
                    success: function (response) {
                        for(let i = 0;i < response.length;i++)
                        {
                            html+= `<div class="chat-messages p-4">
                                    <div class="chat-message-right pb-4">
                                        <div class="judul-pesan">
                                            <img src="${url + '/public/images/profile.png'}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                            <div class="text-muted small text-nowrap mt-2">${response[i].waktu}</div>
                                        </div>
                                        <div class="body-pesan">
                                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                                <hr>
                                                <div class="font-weight-bold mb-1">Laporan : ${response[i].Tanggal}</div>
                                                <div class='card'>
                                                    <div class='card-header'><strong>Photo Sekarang </strong></div>
                                                    <div class='card-body'>
                                                        <div class="text-center">
                                                            <img width="100" src="${url}/public/images/${response[i].gambar}">
                                                        </div>
                                                        <hr>
                                                        ${response[i].pesan}
                                                    </div>
                                                    <div class="card-footer"><a href="javascript:;" data-lo="${response[i].longitude}" data-la="${response[i].latitude}" class="btn btn-dark detail">Detail Lokasi</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `
                        }
                        $('.d').html(html);
                        $('.detail').on('click',function(){
                            var la = ($(this).attr('data-la'))
                            var lo = ($(this).attr('data-lo'))
                            $('.longitude').val(lo);
                            $('.latitude').val(la);
                            document.getElementById('maping').innerHTML = '<div id="map" style="margin-right:auto;margin-left:auto;width: 400px; height: 400px;"></div>'
                            var map = L.map('map').setView([la,lo], 13);
                            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                maxZoom: 18,
                                id: 'mapbox/streets-v11',
                                tileSize: 512,
                                zoomOffset: -1,
                                accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                            }).addTo(map);
                            L.marker([la,lo]).addTo(map).bindPopup("<b>Hai!</b><br />Ini adalah lokasi mu");
                            $('#detail_').modal('show');
                        })
                        $('.close').on('click',function(){
                            
                            $('#detail_').modal('hide');
                        });
                        $('.del').on('click',function(){
                            var id = ($(this).attr('data-id'));
                            alert(id);
                        });
                    }
                });
            }
            data(); 
            $('.send').on('click',function(){
                var image = '';
                Webcam.snap( function(data_uri) {
                    image = data_uri;
                });
                var message = $('.pesan').val();
                if ("geolocation" in navigator){
                    navigator.geolocation.getCurrentPosition(function(position){ 
                        $.ajax({
                            type: "POST",
                            url: `${url}/Rest_api/inbox`,
                            data:{
                                pesan:message,
                                longitude:position.coords.longitude,
                                latitude:position.coords.latitude,
                                images:image
                            },
                            dataType: "JSON",
                            success: function (response) {
                                if(response == 'berhasil')
                                {
                                    $('.pesan').val('');
                                    data();
                                }else{
                                    $.toast({
                                        heading: `Error`,
                                        text:'pesan tidak boleh kosong',
                                        showHideTransition: 'slide-right',
                                        icon: 'info',
                                        hideAfter: false,
                                        position: 'top-right',
                                        bgColor: '#e44d26'
                                    });
                                }
                            }
                        });
                    });
                }else{
                    alert("Browser doesn't support geolocation!");
                }
                
            });
        });
    </script>
</body>