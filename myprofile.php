<?php
session_start();
if (!isset($_SESSION["login_user"])) {
    header("Location: login2.php");
}
require('connect.php');

$user = $_SESSION['username_user'];
$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");

$result = mysqli_fetch_assoc($result);

$resep = mysqli_query($conn, "SELECT * FROM resep WHERE author = '$user' and is_private = 0");
$resep = mysqli_fetch_all($resep, MYSQLI_ASSOC);

// var_dump($result);
// var_dump($resep);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="fa_icons/css/all.css"> -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <style>
        .profile-container {
            background-color: #D0d2d2;
            height: 100%;
        }

        .profile {
            width: 50%;
        }

        .foto-profile {
            margin: 0px 25px 25px 25px;
        }

        .resep {
            text-decoration: none;
            color: black;
        }

        .menu {
            min-height: 285px;
        }

        .empty {
            background-color: white;
            height: 300px;
            padding: 0px;
            width: 100%;
        }

        .card-body {
            padding-top: 10px;
            padding-bottom: 0px;
        }

        @media screen and (max-width: 992px) {
            .profile {
                width: 100%;
            }

            #btn-tambah {
                margin-top: 9%;
            }

            #search-unit {
                width: 65%;
                margin-top: 3%;
            }
        }

        @media (min-width: 993px) {
            #search-unit {
                width: 25%;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            var id = $("#username").html().split("@");
            $("#all").click(function() {
                $(this).addClass("active");
                $("#private").removeClass("active");
                $.ajax({
                    type: "POST",
                    url: "ajax/showResep.php",
                    data: {
                        username: id[1],
                        status: "all"
                    },
                    success: function(response) {
                        $("#my-resep").html(response);
                    }
                });
            });

            $("#private").click(function() {
                $(this).addClass("active");
                $("#all").removeClass("active");
                $.ajax({
                    type: "POST",
                    url: "ajax/showResep.php",
                    data: {
                        username: id[1],
                        status: "private"
                    },
                    success: function(response) {
                        $("#my-resep").html(response);

                    }
                });
            });
            //     $("#navbarDropdownMenuAvatar").click(function() {
            //         var WIDTH_LIMIT = 992;

            //         var windowWidth = window.innerWidth;

            //         if (windowWidth <= WIDTH_LIMIT) {
            //             $("#profile-down").removeClass("dropdown-menu-end");
            //             $("#profile-down").addClass("dropdown-menu-start");
            //         } else {
            //             $("#profile-down").removeClass("dropdown-menu-start");
            //             $("#profile-down").addClass("dropdown-menu-end");
            //         }
            //     });
            // });
        });
    </script>
</head>

<body style='background-color: #D0d2d2'>
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
                    <div class="coba form-outline rounded border border-dark" id="search-unit" style="--bs-border-opacity: .5;">
                        <form class="d-flex flex-row" action="search.php" method="GET">
                            <input id="search-input" type="search" name="search_index" class="form-control text-dark" />
                            <button type="submit" id='myBtn' class="btn" name="submit_btn" style="background-color:transparent; line-height:2.3">
                                <i class="fas fa-search text-dark"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Collapsible wrapper -->

                <!-- Right elements -->
                <?php if (isset($_SESSION["login_user"])) : ?>
                    <div class="d-flex align-items-center d-flex justify-content-center">
                        <a class="text-reset me-3" href="tambahResep.php">
                            <button type="button" class="btn btn-light btn-rounded border border-dark" id="btn-tambah" data-mdb-ripple-color="dark" style="width:150px;">
                                <i class="fa-solid fa-pencil"></i>
                                Tulis Resep
                            </button>
                        </a>
                    </div>
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

    <div class="container-fluid profile-container d-flex justify-content-center">
        <div class="card profile my-4">
            <div class="card-body profile-card d-flex flex-row">
                <div class="foto-profile">
                    <img src="img/anonymous.jpg" class="rounded-circle" height="100" alt="Profile" loading="lazy" />
                </div>
                <div class="profile-info">
                    <h2><?= $result['nama']; ?></h2>
                    <p id="username">@<?= $result['username']; ?></p>

                </div>
                <div class="m-2">
                    <a href="editProfile.php" style="color: black;">
                        <i class="fa-solid fa-pencil fa-lg"></i>
                    </a>
                </div>

            </div>

            <div class="menu">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="all" href="#">Resep Saya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="private" href="#">Resep Private</a>
                    </li>
                </ul>
                <?php if ($resep) : ?>
                    <div id="my-resep" class="row mx-1 my-3">

                        <?php foreach ($resep as $row) : ?>
                            <div class="col-6 col-lg-4">
                                <div class="card m-2">
                                    <a href="editResep.php?id=<?= $row["id_resep"]; ?>">
                                        <div class="ratio ratio-16x9">
                                            <img src="img/resep_img/<?= $row["gambar"]; ?>" class="card-img-top" alt="<?= $row["nama_resep"]; ?>" style="object-fit:cover;">
                                        </div>
                                    </a>
                                    <div class="card text-center">
                                        <a href="editResep.php?id=<?= $row["id_resep"]; ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $row["nama_resep"]; ?></h5>
                                            </div>
                                        </a>
                                        <div class="icon-content d-flex flex-row justify-content-center">
                                            <div class="icon-field me-1">
                                                <i class="fa-solid fa-eye"></i><span id="view"><?= $row['views']; ?></span>
                                            </div>
                                            <div class="icon-field btn-like" value="<?= $row['id_resep']; ?>" status="0">
                                                <span style="color: red;">
                                                    <i class="fa-regular fa-heart"></i>
                                                </span>
                                                <span class="like"><?= $row['likes']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                <?php else : ?>
                    <div class="empty card d-flex justify-content-center aligns-item-center text-center">
                        <h2>Kamu Belum Memiliki resep</h2>
                        <a class="text-reset me-3" href="tambahResep.php">
                            <button type="button" class="btn btn-dark btn-rounded mt-3" id="btn-tambah" data-mdb-ripple-color="dark" style="width:150px;">
                                <i class="fa-solid fa-pencil"></i>
                                Tulis Resep
                            </button>
                        </a>
                    </div>
            </div>

        <?php endif; ?>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <footer class="text-center text-white" style="background-color: #8a8d8d;">
        <!-- Grid container -->
        <div class="container-fluid" id="footer-element" style="height:fit-content;margin-top:15%">
            <!-- Section: Images -->
            <section class="">
                <div class="row">
                    <div class="col-sm">
                        <div class="bg-image hover-overlay ripple rounded" data-ripple-color="light">
                            <!-- <img src="img/foto 1.jpg" class="w-100" /> -->
                            <p>2208096065 </p>
                            <p>Muhammad Ilham Dwi P</p>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="bg-image hover-overlay ripple rounded" data-ripple-color="light">
                            <!-- <img src="img/foto2.png" class="w-100" /> -->
                            <p>2208096080</p>
                            <p>Tsaura Rafah Masuzzahra</p>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="bg-image hover-overlay ripple rounded" data-ripple-color="light">
                            <!-- <img src="img/foto 3.jpg" class="w-100" /> -->
                            <p>2108096062</p>
                            <p>Azizah Astri Wulandari</p>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="bg-image hover-overlay ripple rounded" data-ripple-color="light">
                            <!-- <img src="img/foto 4.jpg" class="w-100" /> -->
                            <p>2108096082</p>
                            <p>Millah Zakiyah</p>
                        </div>
                    </div>
                    
                </div>
            </section>
            <!-- Section: Images -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2024 Copyright:
            <a class="text-white" href="https://mdbootstrap.com/">Kelompok RPL5B-5</a>
        </div>
        <!-- Copyright -->
    </footer>
</body>

</html>