<?php

session_start();
require('connect.php');

$bahanArray = [
    $_POST['bahan1'] ?? '',
    $_POST['bahan2'] ?? '',
    $_POST['bahan3'] ?? '',
    $_POST['bahan4'] ?? '',
    $_POST['bahan5'] ?? ''
];

// Filter bahan yang tidak kosong
$bahanArray = array_filter($bahanArray, function($bahan) {
    return !empty(trim($bahan));
});

if (!empty($bahanArray)) {
    $placeholders = implode(',', array_fill(0, count($bahanArray), '?'));
    $sql = "
        SELECT r.nama_resep
        FROM resep r
        JOIN bahan b ON r.id_resep = b.id_resep
        WHERE b.jenis IN ($placeholders)
        GROUP BY r.id_resep
        HAVING COUNT(DISTINCT b.jenis) = ?
    ";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Tentukan tipe parameter (semuanya string "s")
        $types = str_repeat('s', count($bahanArray)) . 'i';
        $params = [...$bahanArray, count($bahanArray)];

        // Bind parameter
        $stmt->bind_param($types, ...$params);

        // Eksekusi query
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<li>" . htmlspecialchars($row['nama_resep']) . "</li>";
                }
            } else {
                echo "<p>Tidak ada resep ditemukan dengan bahan tersebut.</p>";
            }
        } else {
            echo "<p>Error: Gagal mengeksekusi query pencarian.</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Error: Gagal mempersiapkan query.</p>";
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Search</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="MDB5/css/mdb.min.css" />
    <script type="text/javascript" src="MDB5/js/mdb.min.js"></script>
    <!-- bootstrap -->
    <!-- font awesome -->
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <!-- font awesome -->

    <!-- jQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- jQUERY -->

    <!-- CROPPER JS -->
    <link href="cropperjs/cropper.min.css" rel="stylesheet" type="text/css" />
    <script src="cropperjs/cropper.min.js" type="text/javascript"></script>
    <!-- CROPPER JS -->
    <script>
         function performSearch() {
                    // Capture the values from the input fields
                    const bahan1 = document.getElementById('search-input-1').value;
                    const bahan2 = document.getElementById('search-input-2').value;
                    const bahan3 = document.getElementById('search-input-3').value;
                    const bahan4 = document.getElementById('search-input-4').value;
                    const bahan5 = document.getElementById('search-input-5').value;
        
                    // Combine keywords into an array
                    let keywords = [bahan1, bahan2, bahan3, bahan4, bahan5].filter(keyword => keyword !== "");
        
                    // Display search results (for demo purposes)
                    const resultsDiv = document.getElementById('search-results');
                    if (keywords.length > 0) {
                        resultsDiv.innerHTML = `<p>Searching for: ${keywords.join(", ")}</p>`;
                    } else {
                        resultsDiv.innerHTML = "<p>No keywords entered!</p>";
                    }
                    // Create a FormData object to send data via AJAX
                    let formData = new FormData();
                    formData.append('bahan1', bahan1);
                    formData.append('bahan2', bahan2);
                    formData.append('bahan3', bahan3);
                    formData.append('bahan4', bahan4);
                    formData.append('bahan5', bahan5);

                     // AJAX request to PHP file
                    fetch('/gudangresep/advandsearch.php',{
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Append search results to the "Searching for" text
                        console.log(data)
                        resultsDiv.innerHTML += data;
                        
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });


        
                    // Here you can add the logic to perform an actual search or filter data
                    // E.g., make an API call, query a database, or filter items on the page.
                }
        </script>
    <style>
        body {
            background-color: #D0d2d2;
        }

        .field-input {
            background-color: white;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 15px;
        }

        .content {
            width: 40%;
        }

        img {
            display: block;
            max-width: 100%;
        }

        .preview {
            overflow: hidden;
            width: 160px;
            height: 160px;
            margin: 10px;
            border: 1px solid red;
        }

        @media screen and (max-width: 992px) {
            .content {
                width: 100%;
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
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" name="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar brand -->
                <a href="index.php" class="navbar-brand mt-2 mt-lg-0">
                    <img src="img\black.png" height="45" alt="GR Logo" loading="lazy" />
                </a>
                <!-- <div class="container-xl ms-5 position-absolute top-50 start-100 translate-middle"> -->
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
                <!-- </div> -->
                <!-- Collapsible wrapper -->
                <!-- Right elements -->
                <?php if (isset($_SESSION["login_user"])) : ?>
                    <div class="d-flex align-items-center d-flex justify-content-center" style="margin-left: 9%;">
                    </div>
                    <div class="d-flex justify-content-end" id="logo-dropdown">
                        <!-- Avatar -->
                        <div class="dropdown d-flex justify-content-end" style="margin-left: -30%;">
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
    <div class="container">
        <div class="row">
        <!-- Kolom 1 -->
            <div class="input-group col-md-2 mb-4">
                <input class="form-control py-2 input-field rounded-left" type="search" placeholder="Bahan 1" id="search-input-1">
            </div>
                      
        <!-- Kolom 2 -->
            <div class="input-group col-md-2 mb-4">
                <input class="form-control py-2 input-field rounded-left" type="search" placeholder="Bahan 2" id="search-input-2">
            </div>
                      
        <!-- Kolom 3 -->
            <div class="input-group col-md-2 mb-4">
                <input class="form-control py-2 input-field rounded-left" type="search" placeholder="Bahan 3" id="search-input-3">
            </div>
                      
        <!-- Kolom 4 -->
            <div class="input-group col-md-2 mb-4">
                <input class="form-control py-2 input-field rounded-left" type="search" placeholder="Bahan 4" id="search-input-4">
            </div>
                      
        <!-- Kolom 5 -->
            <div class="input-group col-md-2 mb-4">
                <input class="form-control py-2 input-field rounded-left" type="search" placeholder="Bahan 5" id="search-input-5">
            </div>
                      
        <!-- Tombol Pencarian -->
            <div id="search-form">
                <!-- Formulir pencarian -->
                <div class="input-group col-md-2 mb-4">
                    <button class="btn btn-success search-button rounded-right" type="button" onclick="performSearch()">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
         </div>

                <!-- Div untuk menampilkan hasil pencarian -->
            <div id="search-results"></div>

        </div> 
        </div>
    
</html>