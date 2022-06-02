<? 


$conection = new mysqli("localhost","root","","presensi");

function insert_data()
{
    global $conection;
    $pw = md5(123);
    $sql = 
    "INSERT INTO karyawan 
    (nik,username,password,email,status,jenis_kelamin,profile,jabatan)
    VALUES('T3119051','lia','$pw','liaisa@yahoo.com','1','P','profile.png','1')
    ";
    if($conection->query($sql) == TRUE);
    {
        printf('berhasil');
    }else{
        printf('gagal');
    }
}

insert_data();





?>