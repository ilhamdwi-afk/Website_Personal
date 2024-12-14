<?php
$conn = mysqli_connect("localhost", "root", "", "gudangresep", 3306);

if ($conn->connect_error) {
    echo "Error: could no connect. " . mysqli_connect_error();
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["registerUsername"]));
    $password = mysqli_real_escape_string($conn, $data["registerPassword"]);
    $password2 = mysqli_real_escape_string($conn, $data["registerRepeatPassword"]);
    $nama = stripslashes($data["registerName"]);
    $email = strtolower(stripslashes($data["registerEmail"]));
    //cek username
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username';");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah terdaftar');
        </script>";
        header("Location: login2.php");
        return false;
    }

    //cek password
    if ($password !== $password2) {
        echo "<script>
            alert('pasword tidak sesuai!');
        </script>";
        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambah user baru ke data base
    $qry = "INSERT INTO user VALUES('$username', '$password', '$nama', '$email');";
    mysqli_query($conn, $qry);

    return mysqli_affected_rows($conn);
}

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


function tambah_resep($data)
{

    global $conn;
    // var_dump($data);
    $judul = htmlspecialchars($data["nama_resep"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $username = $_SESSION["username_user"];
    $kategori = intval($data["kategori"]);
    $is_private = $data["is_private"];
    // upload gambar
    // $gambar = upload($data);
    $gambar = $data["image-name"];

    $qry = "INSERT INTO resep  
                VALUES
                (null, '$judul', '$deskripsi', '$kategori', SYSDATE(),'$gambar', '$username', 0, 0, 0, $is_private);";

    mysqli_query($conn, $qry);

    $result = query("SELECT id_resep FROM resep ORDER BY id_resep DESC LIMIT 1;");
    $id_resep = $result[0]['id_resep'];
    foreach ($data['detail_bahan'] as $row => $value) {
        $detail_bahan = $data['detail_bahan'][$row];
        $detail_takaran = $data['detail_takaran'][$row];

        $qry = "INSERT INTO bahan VALUES ('$id_resep', '$detail_takaran', '$detail_bahan');";
        mysqli_query($conn, $qry);
    }

    foreach ($data['detail_langkah'] as $row => $value) {
        $detail_langkah = $data['detail_langkah'][$row];

        $qry = "INSERT INTO langkah VALUES ('$id_resep', '$row', '$detail_langkah');";
        mysqli_query($conn, $qry);
    }


    return mysqli_affected_rows($conn);
}

function upload2($data)
{
    try {
        $folderPath = 'img/';

        $image_parts = explode(";base64,", $data['image-data']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $filename = uniqid() . '.png';
        $file = $folderPath . $filename;
        file_put_contents($file, $image_base64);
        // echo '<script>alert("suskes terupload") </script>';
        // echo json_encode(["image uploaded successfully."]);

    } catch (Exception $e) {
    }
    return $filename;
}