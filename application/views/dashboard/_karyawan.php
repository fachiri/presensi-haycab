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
                    <h1 class="mt-4">Daftar Karyawan</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daftar Karyawan</li>
                    </ol>
                    <a href="javascript:;" class="btn btn-dark detail">Tambah Karyawan <i class="fas fa-user"></i></a>
                    <div class="mt-2">
                        <?= $this->session->flashdata('alert') ?>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Daftar Karyawan
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
                                        <td>
                                        <a href="<?= base_url('detail-karyawan/'.$rows->id_karyawan) ?>" class="btn btn-dark"><i class="fa fa-edit"></i></a>
                                        <a href="<?= base_url('hapus-karyawan/'.$rows->id_karyawan) ?>" class="btn btn-dark"><i class="fa fa-trash"></i></a>
                                        </td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
                    <button type="button" class="btn btn-danger close" data-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nik/Nip</label>
                        <input type="text" name="nama" required placeholder="Nik/Nip" class="nik form-control">
                        <div class="text-danger nik"></div>
                    </div>
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
                        <label for="">Jenis Kelamin</label>
                        <select name="jkel"  class="jkel form-control">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <div class="text-danger jenis-kelamin"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status"  class="status form-control">
                            <option value="">Pilih Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                        <div class="text-danger stat"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Jabatan</label>
                        <select name="jabatan" id="" class="form-control">
                            <option value="">Pilih Jabatan</option>
                            <?php foreach($jabatan->result() as $jb){ ?>
                                <option value="<?= $jb->id_jabatan ?>"><?= $jb->ket_jabatan ?></option>
                            <?php } ?>
                        </select>
                        <div class="text-danger jbt"></div>
                    </div>  
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="password" required placeholder="Password" class="password form-control">
                        <div class="text-danger password"></div>
                    </div>
                    <div class="form-group">
                        <label for="">Konfirmasi</label>
                        <input type="password" name="konfirmasi" required placeholder="Konfirmasi Password" class="konfirmasi form-control">
                        <div class="text-danger confirm"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="save" type="submit" onclick="saved()" class="btn btn-dark"><i class="fas fa-save"></i> Simpan</button>
                    <button  type="button" class="btn btn-dark close" data-dismiss="modal">Close</button>
                </div>
                <input type="text" value="<?= base_url() ?>" hidden class="url">
            </div>
        </div>
        <input type="text" value="<?= base_url() ?>" class="url">
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
            $.ajax({
                type: "POST",
                url: `${url}Karyawan/addKaryawan`,
                dataType:'JSON',
                data:{
                    nik:$('.nik').val(),
                    nama:$('.nama').val(),
                    email:$('.email').val(),
                    password:$('.password').val(),
                    konfir:$('.konfirmasi').val(),
                    status:$('select[name=status] option').filter(':selected').val(),
                    jabatan:$('select[name=jabatan] option').filter(':selected').val(),
                    jkel:$('select[name=jkel] option').filter(':selected').val(),
                },
                success: function (response) {
                    if(response.status == false)
                    {
                        var { nama,email,jkel,status,nik,password,konfirmasi,jabatan } = response.msg;
                        $('.nik').html(nik);
                        $('.nama').html(nama);
                        $('.email').html(email);
                        $('.jenis-kelamin').html(jkel);
                        $('.stat').html(status);
                        $('.password').html(password);
                        $('.confirm').html(konfirmasi);
                        $('.jbt').html(jabatan);
                    }else{
                        // clean value input
                        $('.nik').val(''),
                        $('.nama').val(''),
                        $('.email').val(''),
                        $('.password').val(''),
                        $('.konfirmasi').val(''),
                        $('select[name=status] option').filter(':selected').val(0),
                        $('select[name=jkel] option').filter(':selected').val(0),
                        // clean alert
                        $('.nik').html('');
                        $('.nama').html('');
                        $('.email').html('');
                        $('.jenis-kelamin').html('');
                        $('.stat').html('');
                        $('.password').html('');
                        $('.confirm').html('');
                        $('.jbt').html('');
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
                    $.toast({
                        heading: `Alert`,
                        text: `Terjadi Kesalahan !`,
                        showHideTransition: 'slide-right',
                        icon: 'info',
                        hideAfter: false,
                        position: 'top-right',
                        bgColor: '#28a745'   
                    });
                }
            });
            
        }
    </script>
</body>
</html>