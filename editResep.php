<?php
session_start();

if (!isset($_SESSION["login_user"])) {
    header("Location: login2.php");
}
require('connect.php');
$id = $_GET['id'];

$resep = mysqli_query($conn, "SELECT * FROM resep WHERE id_resep = $id");
if (mysqli_num_rows($resep) == 0) {
    // var_dump($resep);
    header("Location: myprofile.php");
}
$resep = mysqli_fetch_assoc($resep);

$kategori = query("SELECT * FROM kategori");
$bahan = query("SELECT * FROM bahan WHERE id_resep = $id");
$langkah = query("SELECT * FROM langkah WHERE id_resep = $id");

if (isset($_POST['save'])) {
    $judul = htmlspecialchars($_POST["nama_resep"]);
    $deskripsi = htmlspecialchars($_POST["deskripsi"]);
    // $username = $_SESSION["username_user"];
    $kategori = intval($_POST["kategori"]);
    $is_private = $_POST["is_private"];
    // upload gambar
    // $gambar = upload($data);
    // $gambar = $data["image-name"];
    try {
        $qry = "UPDATE resep SET nama_resep = '$judul', deskripsi = '$deskripsi', id_kategori = '$kategori', is_private = $is_private WHERE id_resep = $id";

        mysqli_query($conn, $qry);

        // $result = query("SELECT id_resep FROM resep ORDER BY id_resep DESC LIMIT 1;");
        // $id_resep = $result[0]['id_resep'];

        $delete = mysqli_query($conn, "DELETE FROM bahan WHERE id_resep = $id");
        $delete = mysqli_query($conn, "DELETE FROM langkah WHERE id_resep = $id");
        foreach ($_POST['detail_bahan'] as $row => $value) {
            $detail_bahan = $_POST['detail_bahan'][$row];
            $detail_takaran = $_POST['detail_takaran'][$row];

            $qry = "INSERT INTO bahan VALUES ('$id', '$detail_takaran', '$detail_bahan');";
            mysqli_query($conn, $qry);
        }

        foreach ($_POST['detail_langkah'] as $row => $value) {
            $detail_langkah = $_POST['detail_langkah'][$row];

            $qry = "INSERT INTO langkah VALUES ('$id', '$row', '$detail_langkah');";
            mysqli_query($conn, $qry);
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>alert('terjadi kesalahan');</script>";
    }

    header("Location: myprofile.php");
} elseif (isset($_POST['delete'])) {
    $delete = mysqli_query($conn, "DELETE FROM resep WHERE id_resep = $id");
    $delete = mysqli_query($conn, "DELETE FROM bahan WHERE id_resep = $id");
    $delete = mysqli_query($conn, "DELETE FROM langkah WHERE id_resep = $id");
    $delete = mysqli_query($conn, "DELETE FROM comments WHERE id_resep = $id");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Resep</title>
    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="fa_icons/css/all.css"> -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <script>
        $(document).ready(function() {
            $("#add-row-langkah").click(function() {
                $("#row-langkah").append("<li><div class='row my-2'><div class='col-6'><input type='text' class='form-control' name='detail_langkah[]'></div><div class='col-2'><a class='delete-langkah'><i class='fa-sharp fa-solid fa-xmark fa-xl'></i></a></div></div></li>");
            });

            $("#add-row-bahan").click(function() {
                $("#row-bahan").append("<li><div class='row my-2'><div class='col-5'><input type='text' class='form-control' name='detail_takaran[]' placeholder='takran'></div><div class='col-5'><input type='text' class='form-control' name='detail_bahan[]' placeholder='bahan'></div><div class='col-2'><a class='delete-bahan'><i class='fa-sharp fa-solid fa-xmark fa-xl'></i></a></div></div></li>");

            });

            $(document).on("click", ".delete-langkah", function(e) {
                $(this).parent().parent().parent().remove()
            });

            $(document).on("click", ".delete-bahan", function(e) {
                $(this).parent().parent().parent().remove()
            });
        });
    </script>
    <style>
        body {
            background-color: #D0d2d2;
        }

        .content {
            width: 40%;
        }


        .field-input {
            background-color: white;
            padding: 10px;
            margin-bottom: 15px;
        }

        @media screen and (max-width: 992px) {
            .content {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0" href="index.php">
                    <img src="img\Gudang Resep.png" height="45" alt="GR Logo" loading="lazy" />
                </a>
                <div class="input-group d-flex justify-content-center">
                    <div class="coba form-outline w-25 rounded" style="--bs-border-opacity: .5;">
                    </div>
                </div>

                <!-- Collapsible wrapper -->

                <!-- Right elements -->
                <?php if (isset($_SESSION["login_user"])) : ?>
                    <div class="d-flex justify-content-end" id="logo-dropdown">
                        <!-- Avatar -->
                        <div class="dropdown d-flex justify-content-end">
                            <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                <img src="img/anonymous.jpg" class="rounded-circle" height="40" alt="Profile" loading="lazy" />
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                                <li>
                                    <a class="dropdown-item" href="myprofile.php">My profile</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="logout.php">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="d-flex align-items-center">
                        <a class="text-reset me-3" href="login2.php">
                            <button type="button" class="btn btn-outline-primary btn-rounded" data-mdb-ripple-color="dark">Login</button>
                        </a>
                    </div>
                <?php endif; ?>
                <!-- Right elements -->
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

    <div class="container-fluid d-flex align-items-center justify-content-center">
        <div class="content">
            <h1 class="text-center m-3">Edit Resep</h1>

            <form action="" method="post" id="form-addResep" enctype="multipart/form-data">
                <div class="field-input">

                    <label class="form-label" for="nama_resep">Judul Resep : </label>
                    <input class="form-control" type="text" name="nama_resep" id="nama_resep" maxlength="30" value="<?= $resep['nama_resep']; ?>" required>


                    <!-- <label for="nama">deskripsi : </label>
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="10"></textarea> -->
                    <label for="deskripsi" class="form-label">Deskripsi resep</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $resep['deskripsi']; ?></textarea>

                    <select class="form-select mt-3" aria-label="Default select example" name="kategori" required>
                        <!-- <option selected>Pilih Kategori</option> -->
                        <?php foreach ($kategori as $row) : ?>
                            <?php if ($row['id_kategori'] == $resep['id_kategori']) : ?>
                                <option value="<?= $row['id_kategori']; ?>" selected><?= $row['nama']; ?></option>
                            <?php else : ?>
                                <option value="<?= $row['id_kategori']; ?>"><?= $row['nama']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field-input">
                    <label for="row-bahan">Bahan-bahan</label>
                    <ol id="row-bahan">
                        <?php foreach ($bahan as $row) : ?>
                            <li>
                                <div class="row my-2">
                                    <div class="col-5"><input type="text" class="form-control" name="detail_takaran[]" placeholder="takaran" value="<?= $row['takaran']; ?>"></div>
                                    <div class="col-5"><input type="text" class="form-control" name="detail_bahan[]" placeholder="bahan" value="<?= $row['jenis']; ?>"></div>
                                    <div class="col-2"><a class="delete-bahan"><i class="fa-solid fa-xmark fa-xl"></i></a></div>
                                </div>
                            </li>
                        <?php endforeach; ?>

                    </ol>
                    <button type="button" id="add-row-bahan" class="btn btn-outline-primary">add</button>
                </div>
                <div class="field-input">
                    <label for="row-langkah">Langkah-Langkah</label>
                    <ol id="row-langkah">
                        <?php foreach ($langkah as $row) : ?>
                            <li>
                                <div class="row my-2">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="detail_langkah[]" value="<?= $row['langkah']; ?>">
                                    </div>
                                    <div class="col-2">
                                        <a class="delete-langkah"><i class="fa-sharp fa-solid fa-xmark fa-xl"></i></a>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>

                    </ol>
                    <button type="button" id="add-row-langkah" class="btn btn-outline-primary">add</button>
                </div>
                <div class="field-input">

                    <select class="form-select mt-3" aria-label="Default select example" name="is_private" id="is_private" required>
                        <?php if ($resep['is_private'] == 0) : ?>
                            <option value="false" selected>Public</option>
                            <option value="true">Private</option>
                        <?php else : ?>
                            <option value="true" selected>Private</option>
                            <option value="false">Public</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="field-input">
                    <button class="btn btn-success" type="submit" id="save" name="save">Save</button>
                    <button class="btn btn-danger" type="submit" id="delete" name="delete">Delete</button>
                    <a href="myprofile.php">
                        <button type="button" class="btn btn-primary" name="back" id="back">Back</button>

                    </a>
                </div>

            </form>
        </div>
    </div>

</body>

</html>