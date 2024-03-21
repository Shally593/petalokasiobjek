<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peta Lokasi Objek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .container {
            padding-top: 75px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark fixed-top" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fa-sharp fa-solid fa-location-dot"></i> Peta Lokasi Objek</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <!-- ACARA 6 = Kondisi agar switch login logout otomatis -->
                    <?php if (auth()->loggedIn()) : ?>

                        <li class="nav-item">
                            <a class="nav-link " href="<?= base_url('home/input') ?>"> Input</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="#"> Tabel</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('home/peta') ?>"> Peta</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link " href="#" data-bs-toggle="modal" data-bs-target="#infoModal"> Info</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= base_url('logout') ?>"> Logout</a>
                        </li>

                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link text primary" href="<?= base_url('login') ?>"> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('home/peta') ?>"> Peta</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-3">

        <!-- Flashdata -->
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="alert alert-<?= session()->getFlashdata('message')['type'] ?> alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('message')['content'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <H2><i class="fa-regular fa-calendar-plus"></i> Edit Data Lokasi Objek</H2>
            </div>
            <div class="card-body">
                <form action="<?= base_url('home/simpan_edit_data') . '/' . $dataobjek['id'] ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Isi dengan Nama Objek" value="<?= $dataobjek['nama'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?php echo $dataobjek['deskripsi'] ?>
                        </textarea>
                    </div>
                    <div class="mb-3">


                        <!-- acara 5 24/03/23 = tentang pengaturan tata letak preview foto dengan kolom input -->
                        <div class="row">
                            <div class="col-4">
                                <img src="<?php echo base_url('upload/foto/' . $dataobjek['foto']) ?>" alt="tidak ada foto" class="img-thumbnail">
                            </div>
                            <div class="col-8">
                                <label for="foto" class="form-label">Foto</label>
                                <input class="form-control" type="file" id="foto" name="foto">
                                <br>
                                <input class="form-control" type="hidden" id="fotolama" name="fotolama" value="<?= $dataobjek['foto'] ?>">
                            </div>
                        </div>

                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Isi dengan Latitude" value="<?= $dataobjek['latitude'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Isi dengan Longitude" value="<?= $dataobjek['longitude'] ?>">
                    </div>
                    <div class="mb-3">
                        <div id="map" style="width:100%; height:400px;">
                        </div>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="Submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ACARA 6 27/03/23 = tentang modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>Username</th>
                            <td><?= auth()->user()->username ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= auth()->user()->email ?></td>
                        </tr>
                        <tr>
                            <th>Registered</th>
                            <td><?= auth()->user()->created_at ?></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-hash/0.2.1/leaflet-hash.min.js"></script>
    <script>
        /* Initial Map */
        let tooltip = 'Drag the marker or move the map<br>to change the coordinates<br>of the location';

        /* acara 5 20/03/23 = ketika melakukan edit, marker sesuai dengan latitude dan longitude dari data yang diedit */
        let center = [<?= $dataobjek['latitude'] ?>,
            <?= $dataobjek['longitude'] ?>
        ];

        let map = L.map('map').setView(center, 13); //lat, long, zoom
        map.scrollWheelZoom.disable(); //disable zoom with scroll

        /* Tile Basemap */
        let basemap = L.tileLayer(
            "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: '<a href = "https://www.openstreetmap.org/copyright" > OpenStreetMap < /a> | <a href = "https://www.unsorry.net" target = "_blank" > unsorry @2022 < /a>',
            }
        );
        basemap.addTo(map);

        /* Display zoom, latitude, longitude in URL */
        let hash = new L.Hash(map);

        /* Marker */
        let marker = L.marker(center, {
            draggable: true
        });
        marker.addTo(map);

        /* Tooltip Marker */
        marker.bindTooltip(tooltip);
        marker.openTooltip();

        //Dragend marker
        marker.on('dragend', dragMarker);

        //Move Map
        map.addEventListener('moveend', mapMovement);

        function dragMarker(e) {
            let latlng = e.target.getLatLng();

            //Displays coordinates on the form
            document.getElementById("latitude").value = latlng.lat.toFixed(5);
            document.getElementById("longitude").value = latlng.lng.toFixed(5);

            //Noted : tofixed adalah angka dibelakang koma pada koordinat 

            //Change the map center based on the marker location
            map.flyTo(new L.LatLng(latlng.lat.toFixed(9), latlng.lng.toFixed(5)));

            // Noted : like a pro kasih effect
        }

        function mapMovement(e) {
            let mapcenter = map.getCenter();

            //Displays coordinates on the form
            document.getElementById("latitude").value = mapcenter.lat.toFixed(5);
            document.getElementById("longitude").value = mapcenter.lng.toFixed(5);

            //Create marker
            marker.setLatLng([mapcenter.lat.toFixed(5), mapcenter.lng.toFixed(5)]).update();
            marker.on('dragend', dragMarker);
        }

        function mapCenter(e) {
            let mapcenter = map.getCenter();
            let x = document.getElementById("longitude").value;
            let y = document.getElementById("latitude").value;

            map.flyTo(new L.LatLng(y, x), 18);
        }
    </script>

</body>

</html>