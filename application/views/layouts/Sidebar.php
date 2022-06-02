<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="<?= base_url('profile') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Profile
                </a>
    
                <div class="sb-sidenav-menu-heading">Management Presensi</div>
                <?php if($this->session->userdata('role') == 1 && 2){ ?>
                    <a class="nav-link" href="<?= base_url('laporan-presensi') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Laporan Absensi
                    </a>
                    <a class="nav-link" href="<?= base_url('pengaturan-presensi') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-gear"></i></div>
                        Pengaturan Presensi
                    </a>
                    <a class="nav-link" href="<?= base_url('management-jabatan') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Management Jabatan
                    </a>
                <?php }else{ ?>    
                    <a class="nav-link" href="<?= base_url('riwayat') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Riwayat Absensi
                    </a>
                <?php } ?>
                <?php if($this->session->userdata('role') == 1 && 2 ){ ?>
                    <a class="nav-link"  href="<?= base_url('pesan-masuk') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                        Pesan Masuk
                    </a>
                <?php }else{ ?>
                    <?php if($this->session->userdata('id_jabatan') != 3){ ?>
                    <a class="nav-link" href="<?= base_url('pesan') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                        Pesan
                    </a>
                    <?php } ?>
                <?php } ?>
                <?php if($this->session->userdata('id_jabatan') == 3){ ?>
                    <a class="nav-link"  href="<?= base_url('pesan-masuk') ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                        Pesan Masuk
                    </a>
                <?php } ?>
                <?php if($this->session->userdata('role') == 1 && 2){ ?>
                    <div class="sb-sidenav-menu-heading">Management Aplikasi</div>
                    <a class="nav-link" href="<?= base_url('daftar-karyawan') ?>">
                        <div class="sb-nav-link-icon"><i class="fa fa-address-card"></i></div>
                        Daftar Karyawan
                    </a>
                    <a class="nav-link" href="<?= base_url('daftar-admin') ?>">
                        <div class="sb-nav-link-icon"><i class="fa fa-lock"></i></div>
                        Daftar Operator
                    </a>
                <?php } ?>
                    <a class="nav-link" href="<?= base_url('Login/log_out') ?>">
                        <div class="sb-nav-link-icon"><i class="fa fa-sign-out"></i></div>
                        Logout
                    </a>
            </div>
        </div>
    </nav>
</div>