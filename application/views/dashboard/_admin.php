<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('layouts/Header',[
        'judul' => 'Daftar Karyawan'
    ]) ?>
</head>
<body  class="sb-nav-fixed">
    <?php $this->load->view('layouts/Navbar') ?>
    <div id="layoutSidenav">
        <?php $this->load->view('layouts/Sidebar') ?>
        <div id="layoutSidenav_content">            
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Daftar Operator</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Operator</li>
                    </ol>
                    <div class="mt-2">
                        <?= $this->session->flashdata('alert') ?>
                    </div>
                    <a href="javascript:;" class="btn btn-dark detail">Tambah Operator <i class="fas fa-user"></i></a>
                    <div class="card mb-4 mt-3">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Operator
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <?php if($this->session->userdata('role') == 1 && 2){ ?>
                                        <th>Nama</th>
                                        <?php } ?>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0; ?>
                                    <?php foreach($data as $rows){ ?>
                                    <tr>
                                        <td><?= $no+=1 ?></td>
                                        <td><?= $rows->username ?></td>
                                        <td><a href="<?= base_url('detail-admin/'.$rows->id) ?>" class="btn btn-dark">Detail</a></td>
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
    <div class="modal fade" id="detail_" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Operator</h5>
                    <button type="button" class="btn btn-danger close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name="nama" required placeholder="Nama" class="nama form-control">
                        <div class="text-danger nama"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" required placeholder="Email" class="email form-control">
                        <div class="text-danger email"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" required placeholder="Password" class="password form-control">
                        <div class="text-danger password"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Konfirmasi</label>
                        <input type="password" name="konfirmasi" required placeholder="Konfirmasi Password" class="konfirmasi form-control">
                        <div class="text-danger konfirmasi"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="save" type="submit" onclick="saved()" class="btn btn-dark"><i class="fas fa-save"></i> Simpan</button>
                    <button  type="button" class="btn btn-dark close" data-dismiss="modal">Close</button>
                </div>
                <input type="text" value="<?= base_url() ?>" hidden class="url">
            </div>
        </div>
    </div>
    <?php $this->load->view('layouts/Footer') ?>
    <script>
        $(document).ready(function(){
            
            $('.detail').on('click',function(){
                $('#detail_').modal('show');    
            });
            $('.close').on('click',function(){    
                $('#detail_').modal('hide');
            });
        });
    </script>
    <script>
        const url = document.querySelector('.url').value;
        const saved = () => 
        {
            const form = {
                nama:$('.nama').val(),
                email:$('.email').val(),
                password:$('.password').val(),
                konfir:$('.konfirmasi').val()
            }
            
            $.ajax({
                type: "POST",
                url: `${url}Admin/addAdmin`,
                dataType:'JSON',
                data:{
                    nama:$('.nama').val(),
                    email:$('.email').val(),
                    password:$('.password').val(),
                    konfirmasi:$('.konfirmasi').val()
                },
                success: function (response) {
                    if(response.status == false)
                    {
                        var { nama,email,password,konfirmasi } = response.msg
                        $('.nama').html(nama);
                        $('.email').html(email);
                        $('.password').html(password);
                        $('.konfirmasi').html(konfirmasi);
                    }else{
                        $('.nama').html('');
                        $('.email').html('');
                        $('.password').html('');
                        $('.konfirmasi').html('');
                        $('.nama').val(''),
                        $('.email').val(''),
                        $('.password').val(''),
                        $('.konfirmasi').val('')
                        $('#detail_').modal('hide');
                        $.toast({
                            heading: `Alert`,
                            text: `${response.msg}`,
                            showHideTransition: 'slide-right',
                            icon: 'info',
                            hideAfter: false,
                            position: 'top-right',
                            bgColor: '#28a745'   
                        });
                    }
                },
                error:function(error){
                    console.log(error);
                }
            });
        }
    </script>
</body>
</html>