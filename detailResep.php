<?php
session_start();
require("connect.php");

// var_dump($_GET);
$id = $_GET['id'];


$count = query("SELECT views FROM resep WHERE id_resep = $id;");
$count =  ((int)$count[0]['views']) + 1;


$qry = "UPDATE resep SET views = $count WHERE id_resep = $id;";
$view = mysqli_query($conn, $qry);

$data = query("SELECT * FROM resep WHERE id_resep = '$id';");
$bahan = mysqli_query($conn, "SELECT * FROM bahan WHERE id_resep = '$id';");
$langkah = mysqli_query($conn, "SELECT * FROM langkah WHERE id_resep = '$id';");
// var_dump($data);

$que = mysqli_query($conn, "SELECT * FROM comments WHERE id_resep = '$id';");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data[0]["nama_resep"]; ?></title>
    <!-- CSS only -->
    <link rel="stylesheet" href="detail_style.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet" />
    <!-- Javascript only -->
    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    
    <style>
        .coba {
            width: 25%;
        }

        @media screen and (max-width: 1440px) and (min-width: 330px) {
            .coba {
                width: 50%;
            }
        }

        @media screen and (max-width: 480px) {
            .coba {
                width: 100%;
            }
        }
    </style>
</head>

<body style='background-color:#c6c9ca'>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-light">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a class="navbar-brand mt-2 mt-lg-0" href="index.php" style='background-color:transparent'>
                    <img src="img\black.png" height="45" alt="GR Logo" loading="lazy" />
                </a>
                <!-- <div class="container-xl ms-5 position-absolute top-50 start-100 translate-middle"> -->
                <div class="input-group d-flex justify-content-center">
                    <div class="coba form-outline rounded border border-dark" style="--bs-border-opacity: .5;">
                        <form class="d-flex flex-row" action="search.php" method="GET">
                            <input id="search-input" type="search" name="search_index" class="form-control text-dark" />
                            <button type="submit" id='myBtn' class="btn" name="submit_btn"
                                style="background-color:transparent; line-height:2.3">
                                <i class="fas fa-search text-dark"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <!-- </div> -->

                <!-- Collapsible wrapper -->

                <!-- Right elements -->
                <?php if (isset($_SESSION["login_user"])) : ?>
                <div class="d-flex justify-content-end" id="logo-dropdown">
                    <!-- Avatar -->
                    <div class="dropdown d-flex justify-content-end">
                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#"
                            id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown"
                            aria-expanded="false">
                            <img src="img/anonymous.jpg" class="rounded-circle" height="40" alt="Profile"
                                loading="lazy" />
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
                        <button type="button" class="btn btn-light btn-rounded border border-dark"
                            data-mdb-ripple-color="dark">Login</button>
                    </a>
                </div>
                <?php endif; ?>
                <!-- Right elements -->
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->

    <div class="blog-single">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-lg-8 m-15px-tb">
                    <article class="article">
                        <div class="article-part">
                            <div class="article-img">
                                <img class="img-responsive" src="img/resep_img/<?= $data[0]["gambar"]; ?>" title=""
                                    alt="">
                            </div>

                            <div class="article-title">
                                <h2 style="display:inline;"> <?= $data[0]["nama_resep"]; ?></h2>
                                <div class="like-btn" style= "float:right;">
                                    <div class="icon-field btn-like" value="<?= $row['id_resep']; ?>" status="0" >
                                <span style="color: red;">
                                    <i class="fa-regular fa-heart"></i>
                                </span>
                                <span class="like"><?= $data[0]['likes']; ?></span>
                                </div>
                                
                            </div> 

                                <div class="media">
                                    <div class="media-body">
                                        <label><?= $data[0]["author"]; ?></label>
                                        <span><?= $data[0]["tanggal"]; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="article-content">
                                <p><?= $data[0]["deskripsi"]; ?></p>

                            </div>
                        </div>

                        <div class="article-part">
                            <div class="bahan-content">
                                <p><strong> Bahan & Takaran </strong></p>
                                <?php while ($r = mysqli_fetch_array($bahan, MYSQLI_ASSOC)) { ?>
                                <ul class="list-group">
                                    <li class="list-group-item mb-2"><b> <?php echo $r['takaran'] ?> </b>
                                        <?php echo $r['jenis'] ?> </li>
                                </ul>

                                <?php } ?>
                            </div>
                        </div>

                        <div class="article-part">
                            <div class="langkah-content">
                                <p><strong> Langkah Pembuatan</strong> </p>
                                <?php while ($r = mysqli_fetch_array($langkah, MYSQLI_ASSOC)) { ?>
                                <ul class="list-group">
                                    <li class="list-group-item mb-2"><?php echo $r['urutan'] + 1 ?>.
                                        <?php echo $r['langkah'] ?>
                                    </li>
                                </ul>
                                <?php } ?>
                            </div>
                        </div>

                    </article>
                </div>
                <div class="col-lg-4 m-15px-tb blog-aside">
                    <!-- Author -->
                    <div class="widget widget-author">
                        <div class="widget-title">
                            <h3>Komentar</h3>
                        </div>
                        <div class="form-group mx-3">
                            <form method="POST" id="comment-form">
                                <input type="hidden" id="id" name="id_resep" value="<?php echo $id; ?>" required>
                                <div class="mx-3 my-2">
                                    <div class="col-auto mx-0">
                                        <textarea class="form-control" name="comment" id="comment" name="comment"
                                            placeholder="Berikan komentar!" required></textarea>
                                    </div>
                                </div>
                                <div class="mx-3 mb-2">
                                    <input type="submit" id="submit" name="submit" class="btn btn-secondary"
                                        value="post">
                                </div>
                            </form>
                        </div>
                        <div class="com-sec mx-4">
                            <?php $query = "SELECT * FROM comments WHERE id_resep = '$id' and reply is null ORDER BY comment_id ASC";
                            $result = mysqli_query($conn, $query);

                            $result = mysqli_fetch_all($result, MYSQLI_ASSOC); ?>
                            <?php foreach ($result as $r) : ?>
                            <div class="comment-header"><b><?= $r['author']; ?></b> on <i><?= $r["date_created"]; ?></i>
                            </div>
                            <div class="comment-content"><?= $r["comment"] ?></div>
                            <div class="reply-form">
                                <button type="button" class="btn btn-secondary reply mb-2"
                                    value="<?= $r["comment_id"]; ?>" style="display:block;"
                                    idresep="<?= $r['id_resep']; ?>">Reply</button>
                                <?php
                                    $reply = $r['comment_id'];
                                    $query = "SELECT * FROM comments WHERE reply = '$reply' ORDER BY comment_id ASC";
                                    $child = mysqli_query($conn, $query);
                                    if (mysqli_num_rows($child) > 0) :
                                        $row = mysqli_fetch_all($child, MYSQLI_ASSOC);
                                    ?>
                                <?php foreach ($row as $ro) : ?>
                                <div class="comment-header mx-4"><b><?= $ro['author']; ?></b> on
                                    <i><?= $ro["date_created"]; ?></i> </div>
                                <div class="comment-content mx-4"><?= $ro["comment"] ?></div>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <script>
                            $(document).ready(function () {

                                $("#submit").click(function (event) {
                                    event.preventDefault();
                                    var comment = $("#comment").val();
                                    if (comment == "") {
                                        alert("Kolom komentar belum terisi")
                                        return
                                    }
                                    console.log($("#comment-form").serialize());
                                    $.ajax({
                                        url: "ajax/addComment.php",
                                        type: "POST",
                                        data: $("#comment-form").serialize(),
                                        success: function (data) {
                                            //    alert(data)
                                            $("#comment-form")[0].reset();
                                            $(".com-sec").html(data);
                                        },

                                        error: function (xhr, status, error) {
                                            console.log(error);
                                        }
                                    })
                                });

                                $(document).on("click", ".submit-rep", function () {
                                    event.preventDefault();
                                    var form = $(this).parent().parent().parent();
                                    var reply = $(this).parent().parent().parent().parent();
                                    console.log($(this).parent().parent().parent().parent());
                                    $.ajax({
                                        url: "ajax/addChildComment.php",
                                        type: "POST",
                                        data: form.serialize(),
                                        success: function (data) {
                                            //    alert(data)
                                            // $("#reply-form")[0].reset();
                                            console.log($(this).parent().parent().parent()
                                                .parent());
                                            reply.html(data);

                                        },

                                        error: function (xhr, status, error) {
                                            alert(error);
                                        }
                                    })
                                });

                                $(document).on("click", ".reply", function () {

                                    $(this).parent().html(
                                        "<div id='reply-form' ><form method='POST' id='reply-form'><div class='col-auto mx-4 mb-2 mt-2'><input type='hidden' name='id-reply' value='" +
                                        $(this).val() +
                                        "'><input type='hidden' name='id_resep' value='" + $(this)
                                        .attr("idresep") +
                                        "'><textarea class='form-control' id='rep' name='comment' placeholder='Berikan balasan!' required></textarea></div><div class='mx-4 mb-3'><input type='button' id='submit-rep' name='submit-rep' class='btn btn-secondary submit-rep' value='post'></div></form></div>"
                                        );
                                });
                                // load_comment()

                                function load_comment() {
                                    var id = $("#id").val();
                                    console.log(id)
                                    $.ajax({
                                        url: "showComment.php",
                                        method: "POST",
                                        data: {
                                            resep_id: id
                                        },
                                        success: function (data) {
                                            $(".com-sec").html(data)
                                        }
                                    })
                                };
                            });


                            // });
                        </script>
                        </form>

                    </div>
                    <!-- End Author -->
                </div>
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