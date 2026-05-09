<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <link rel="stylesheet" href="../styles/index.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Talleres</title>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <h1>Talleres disponibles</h1>
      </a>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="row">
      <div class="col-md-5">

        <input type="text" id="buscador" class="form-control mb-3 border-dark"
          placeholder="Buscar por nombre o rubro...">

        <div class="accordion" id="listaTalleres">
        </div>

      </div>

      <div class="col-md-7">
        <div id="map" style="height: 500px; border-radius: 8px; border: 2px solid #ccc;"></div>
      </div>
    </div>
  </div>


  <a class="btn btn-primary" href="../index.html">Volver</a>
</body>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="../scripts/talleres.js"></script>
  <script src="../scripts/maps.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>