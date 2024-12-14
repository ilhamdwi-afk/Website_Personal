<?php
session_start();
if (!isset($_SESSION["login_user"])) {
    header("Location: login2.php");
}
require('connect.php');

$user = $_SESSION['username_user'];
$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $update = mysqli_query($conn, "UPDATE user SET username = '$username', nama = '$nama', email = '$email' WHERE username = '$user'");
    $_SESSION['username_user'] = $username;
    header("Location: myprofile.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="fa_icons/css/all.css"> -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <style>
        .content {
            background-color: white;
        }

        .edit {
            width: 25%;
        }

        @media screen and (max-width: 992px) {
            .edit {
                width: 100%;
            }

            #btn-tambah {
                margin-top: 9%;
            }
        }
    </style>
</head>

<body style="background-color: #D0d2d2;">
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
                    <!-- </div> -->
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
        <div class="card edit m-3">
            <div class="p-3">
                <h1 class="text-center m-3">Edit Profile</h1>
                <form action="" method="POST">
                    <label for="username" class="form-label">Username: </label>
                    <input type="text" name="username" class="form-control" value="<?= $row['username']; ?>">

                    <label for="nama" class="form-label">Nama: </label>
                    <input type="text" name="nama" class="form-control" value="<?= $row['nama']; ?>">

                    <label for="email" class="form-label">Email: </label>
                    <input type="text" name="email" class="form-control" value="<?= $row['email']; ?>">

                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-success" name="submit" id="submit">Save</button>
                    </div>
                    <a href="myprofile.php">
                        <div class="d-grid gap-2 mt-3">
                            <button type="button" class="btn btn-primary" name="back" id="back">Back</button>
                        </div>
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>