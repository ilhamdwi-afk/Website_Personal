<?php
session_start();
require("connect.php");
// if (!isset($_SESSION["login"])) {
//     header("Location: login.php");
// }

// $data = query("SELECT * FROM resep WHERE is_approved = 1");
// var_dump($data);
// print_r($_SESSION);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
     JavaScript Bundle with Popper -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script> -->
    <title>Home</title>
    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="fa_icons/css/all.css"> -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(document).scrollTop() > 10) {
                    $('#navbar').addClass('color-change');
                } else {
                    $('#navbar').removeClass('color-change');
                }
            });

            $("body").on("click", ".btn-like", function() {
                const btn = $(this);
                if ($(this).attr("status") == "0") {
                    $.ajax({
                        type: "POST",
                        url: "ajax/likeDislike.php",
                        data: {
                            id: btn.attr("value"),
                            status: btn.attr("status")
                        },
                        success: function(response) {
                            // alert(response);
                            btn.html("<span style='color: red;'><i class='fa-solid fa-heart'></i></span><span class='like'>" + response + "</span>");
                            btn.attr("status", 1);
                        }
                    });


                } else {
                    $.ajax({
                        type: "POST",
                        url: "ajax/likeDislike.php",
                        data: {
                            id: btn.attr("value"),
                            status: btn.attr("status")
                        },
                        success: function(response) {
                            // alert(response);
                            btn.html("<span style='color: red;'><i class='fa-regular fa-heart'></i></span><span class='like'>" + response + "</span>");
                            btn.attr("status", 0);
                        }
                    });
                }
            });

            function fetch_resep(page) {
                $.ajax({
                    url: "ajax/pagination.php",
                    method: "POST",
                    data: {
                        page: page
                    },
                    success: function(data) {
                        $("#content-resep").html(data);
                    }
                });
            }
            fetch_resep();

            $(document).on("click", ".page-item", function() {
                var page = $(this).attr("id");
                fetch_resep(page)
            });

            $("#navbarDropdownMenuAvatar").click(function() {
                var WIDTH_LIMIT = 992;

                var windowWidth = window.innerWidth;

                if (windowWidth <= WIDTH_LIMIT) {
                    $("#profile-down").removeClass("dropdown-menu-end");
                    $("#profile-down").addClass("dropdown-menu-start");
                } else {
                    $("#profile-down").removeClass("dropdown-menu-start");
                    $("#profile-down").addClass("dropdown-menu-end");
                }
            });

            $("#bar-collapse").click(function() {
                if ($("#contain-dropdown").css('background-color') == "transparent") {
                    $("#contain-dropdown").css('background-color', '#c6c9ca');
                } else {
                    $("#contain-dropdown").css('background-color', '#8a8d8d');
                }
            });
        });
    </script>
</head>

<body style='background-color:#c6c9ca'>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top" id='navbar'>
        
        <!-- Container wrapper -->
        <div class="container-fluid" id='contain-dropdown' style="margin-top: 0px;background-color:transparent ">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars text-light"></i>
            </button>

            <<!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <!-- Navbar brand on the left -->
                    <a class="navbar-brand mt-2 mt-lg-0" href="#" style="background-color:transparent;">
                        <img src="img\white.png" height="45" alt="GR Logo" loading="lazy" />
                    </a>
                </nav>  
            </div>

            <div class="d-flex align-items-center d-flex justify-content-center">
                <a class="text-reset me-3" href="advandsearch.php">
                    <button type="button" class="btn btn-light btn-rounded" id="btn-tambah" data-mdb-ripple-color="dark" style="width:150px;">
                        Advanced Search
                    </button>
                </a>
            </div>


            <!-- Search bar in the center -->
            <div class="input-group d-flex justify-content-center">
                <div class="coba form-outline rounded border border-light" id="search-unit" style="--bs-border-opacity: .5;">
                    <form class="d-flex flex-row" action="search.php" method="GET">
                        <input id="search-input" type="search" name="search_index" class="form-control text-light" />
                        <button type="submit" id="myBtn" class="btn" name="submit_btn" style="background-color:transparent; line-height:2.3">
                            <i class="fas fa-search text-light"></i>
                        </button>
                    </form>
                </div>
            </div>


                <!-- Collapsible wrapper -->
                <!-- Right elements -->
                <?php if (isset($_SESSION["login_user"])) : ?>
                    <!-- Tambah Resep -->
                    <div class="d-flex align-items-center d-flex justify-content-center">
                        <a class="text-reset me-3" href="tambahResep.php">
                            <button type="button" class="btn btn-light btn-rounded" id="btn-tambah" data-mdb-ripple-color="dark" style="width:150px;">
                                <i class="fa-solid fa-pencil"></i>
                                Tulis Resep
                            </button>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end" id="logo-dropdown">
                        <!-- Avatar -->
                        <div class="dropdown d-flex justify-content-end">
                            <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                                <img src="img/anonymous.jpg" class="rounded-circle" height="40" alt="Profile" loading="lazy"/>
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
                    <div class="d-flex align-items-center d-flex justify-content-center" id="login-nav">
                        <a class="text-reset me-3" href="login2.php">
                            <button type="button" class="btn btn-light btn-rounded" data-mdb-ripple-color="dark" style="margin-top: 15%; margin-bottom: 15%">Login</button>
                        </a>
                    </div>
                <?php endif; ?>
                <!-- Right elements -->
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

    <div id="background">
        <div class="jumbotron" style="margin-left:6%">
            <!-- style="margin-left: 9vw; margin-top:1vw;" -->
            <h1 style="font-size:clamp(60px, 5vw, 220px);">GUDANG RESEP</h1>
            <button type="button" class="btn btn-primary" id="bounce" style="margin-left: 20%; margin-bottom:55%" onClick="document.getElementById('card-resep').scrollIntoView();">
                <i class="fa-regular fa-solid fa-arrow-down fa-xl"></i>
            </button>
        </div>
    </div>

    <!-- Pagination Content -->
    <div id="content-resep">Loading...</div>

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
                            <!-- <img src="assets/image/tsaura.jpg" class="w-100" /> -->
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