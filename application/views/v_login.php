
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal Presensi Tim haycab">
    
    <meta property="og:title" content="LOGIN | PRESENSI TIM HAYCAB">
    <meta property="og:description" content="Portal Presensi Tim haycab">
    <meta property="og:image" content="https://haycabgo.com/assets/images/new-assets/logo.png">
    <meta property="og:url" content="https://haycabgo.com/presensi">

    <link rel="icon" href="img/ung.png">
    <link rel="stylesheet" href="<?= base_url('public/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/bootstrap/css/bootstrap.css') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet">
    <title>LOGIN | PRESENSI TIM HAYCAB</title>
    <style>
        body{
            font-family: 'Quicksand', sans-serif;
        }
    </style>
</head>
<body style="background-color: lightgray;">
    <div class="container mb-4">
        <div class="row justify-content-center" style="margin-top: 50px;">
            <div class="col-md-5">
                <form  method="post" action="<?= base_url('Login/auth') ?>">
                    <div class="card shadow bg-light mt-4">
                        <div class="card-body">
                            <?= $this->session->flashdata('alert'); ?>
                            <h5 class="text-center">PRESENSI</h5>
                            <hr>
                            <div class="form-group">
                                <label for="choose">
                                    Hak Akses
                                </label>
                                <select name="role" class="form-control" id="" required>
                                    <option value="">-- Pilih Hak Akses --</option>
                                    <option value="1">Operator</option>
                                    <option value="2">Karyawan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" required id="email" name="email" class="form-control" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" required id="password" name="password" class="form-control" placeholder="Enter Password">
                            </div>
                            <button class="btn btn-dark text-light w-100">Masuk</button>
                            <br>
                            <!--<p class="mt-3">Belum Punya Account ? <a href="design-register-yuni.html">Daftar Disini</a></p>-->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>