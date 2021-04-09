<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pertumbuhan");


function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function registrasi($data)
{
    global $conn;

    $nama = strtolower(stripslashes($data["nama"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $img = 'default.jpg';
    $role_id = '2';
    $tgl_buat = time();

    // cek email sudah ada atau belum
    $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
				alert('email sudah terdaftar!')
		      </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES(
        '',
        '$nama',
        '$email',
        '$password',
        '$img',
        '$tgl_buat',
        '$role_id')");

    return mysqli_affected_rows($conn);
}


function login()
{
    global $conn;

    $email = strtolower(stripslashes($_POST["email"]));
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            if ($row['role_id'] == 1) {
                $_SESSION["email"] = $row['email'];
                $_SESSION["role_id"] = "admin";
                echo "<script>
                    alert('Selamat datang admin!');
                    document.location.href = 'admin/index.php?menu=dashboard';
                </script>";
            } elseif ($row['role_id'] == 2) {
                $_SESSION["email"] = $row['email'];
                $_SESSION["role_id"] = "peneliti";

                echo "<script>
                    alert('Selamat datang peneliti!');
                    document.location.href = 'peneliti/index.php?menu=dashboard';
                </script>";
            }

            return mysqli_affected_rows($conn);
        } else {
            echo "<script>
                    alert('Maaf password yang di inputkan salah!');
                    document.location.href = 'login.php';
                </script>";

            return false;
        }
    } else {
        echo "<script>
                alert('Maaf email / password yang di inputkan salah!');
                document.location.href = 'login.php';
            </script>";

        return false;
    }
}



function upload()
{

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if ($error === 4) {
        echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../assets/img/profile/' . $namaFileBaru);

    return $namaFileBaru;
}




// Admin
function ubahAdmin($data)
{
    global $conn;

    $id = $data["id_admin"];
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


    $query = "UPDATE user SET
				nama = '$nama',
				email = '$email',
				img = '$gambar'
			  WHERE id = $id
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function tambahAdmin($data)
{
    global $conn;

    $nama = strtolower(stripslashes($data["nama"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $img = 'default.jpg';
    $role_id = '1';
    $tgl_buat = time();

    // cek email sudah ada atau belum
    $result = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
				alert('email sudah terdaftar!')
		      </script>";
        return false;
    }

    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES(
        '',
        '$nama',
        '$email',
        '$password',
        '$img',
        '$tgl_buat',
        '$role_id')");

    return mysqli_affected_rows($conn);
}
