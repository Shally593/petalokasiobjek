<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peta Lokasi Objek</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">


    <!-- ACARA 6 27/03/23 = penambahan CSS LOCAL library yaitu FONTAWESOME UNTUK VISUALISASI MARKER-->
    <link rel="stylesheet" href="<?=base_url('awesome-marker/dist/leaflet.awesome-markers.css') ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    
    <style>

        /* ACARA 6 27/03/23 = penambahan CSS LOCAL library yaitu FONTAWESOME UNTUK VISUALISASI MARKER--> */

        #map {
            width: 100%;
            margin-top: 50px;
            height: calc(100vh - 50px);
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

                    <!-- ACARA 6 27-03-2023 = Kondisi agar switch login logout otomatis -->

                    <?php if (auth()->loggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('home/input') ?>"> Input</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('home/tabel') ?>"> Tabel</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="#"> Peta</a>
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
                            <a class="nav-link active" href="#"> Peta</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>

    <div id="map"></div>


    <!-- ACARA 7 27/03/23 = tentang modal -->
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

    <!-- acara 6 27/03/23 = auth()->user()->username  : cara manggil objek -->

    <!-- acara 5 20/03/23 = penambahan compile link external library yaitu JQuery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-hash/0.2.1/leaflet-hash.min.js"></script>

    <!-- ACARA 6 27/03/23 = penambahan JS LOCAL library yaitu FONTAWESOME UNTUK VISUALISASI MARKER-->
    <script src="<?= base_url('awesome-marker/dist/leaflet.awesome-markers.js')?>"></script>

    <!-- acara 5 20/03/23 = Javascript untuk Map-->
    <script>
        /* Initial Map */
        // let tooltip = 'Drag the marker or move the map<br>to change the coordinates<br>of the location';
        let center = [-6.9235299, 107.6474762];
        let map = L.map('map').setView(center, 13); //lat, long, zoom
        map.scrollWheelZoom.enable(); //disable zoom with scroll

        /* Tile Basemap */
        let basemap = L.tileLayer(
            "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: '<a href = "https://www.openstreetmap.org/copyright" > OpenStreetMap < /a> | <a href = "https://www.unsorry.net" target = "_blank" > unsorry @2022 < /a>',
            }
        );
        basemap.addTo(map);

        /* Display zoom, latitude, longitude in URL */
        let hash = new L.Hash(map);

        /* GeoJSON Point */
        var point = L.geoJson(null, {

            /* ACARA 7 27/03/23 = STYLE MARKER */
            pointToLayer: function(feature, latlng) {
                var marker = L.marker(latlng, {
                    icon: L.AwesomeMarkers.icon({icon: 'school', stylePrefix: 'fas', prefix: 'fa', 
                        markerColor: 'red', iconColor: '#f28f82'})
                });
                return marker;
            },


            onEachFeature: function(feature, layer) {
                var imageUrl = "<?= base_url('/upload/foto/')?>" +'/'+ feature.properties.foto;
                var popupContent = "Nama " + feature.properties.nama + "<br>" +
                    "Deskripsi: " + feature.properties.deskripsi + "<br>" + "<br>" +
                    '<img src=' + imageUrl + ' width="200" height="200">';
                    // "<img src='../upload/foto/" + feature.properties.foto + "' style='max-width: 100px;'  alt = ' tidak ditemukan foto pada folder foto" + " '>";
                layer.on({
                    click: function(e) {
                        point.bindPopup(popupContent);
                    },
                    mouseover: function(e) {
                        point.bindTooltip(feature.properties.nama);
                    },
                });
            },
        });
        $.getJSON("<?= base_url('api') ?>", function(data) {
            point.addData(data);
            map.addLayer(point);
        });
    </script>

</body>

</html>