<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
  <meta charset="utf-8">
  <title>KML Click Capture Sample</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <!-- MDB icon -->
  <link rel="icon" href="img/svg/icono.svg" type="image/x-icon">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="css/mdb.min.css">
  <!-- Your custom styles (optional) -->
  <link rel="stylesheet" href="css/extra.css">
</head>

<body>
  <?php require('nav.html') ?>
  <!--mAPITA-->
  <div class="jumbotron">
    <!--Titutlo-->
    <h1 class="text-center">Encuentra ayuda cerca de ti</h1>
    <div class="padre">
      <div class="hijo">
        <div id="map"></div>
      </div>
    </div>
    <!--Descripcion-->
    <p class="lead">¡<b>No estas sola</b>! hay lugares a los que puedes acudir si te encuentras en peligro.</p>
  </div>



  <script>
    var map, infoWindow;
    function initMap() {
      map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -34.397, lng: 150.644 },
        zoom: 15
      });

      infoWindow = new google.maps.InfoWindow();

      // Try HTML5 geolocation.
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
          function (position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent("Encuentra lugares seguros a tu alrededor");
            infoWindow.open(map);
            map.setCenter(pos);
          },
          function () {
            handleLocationError(true, infoWindow, map.getCenter());
          }
        );
      } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
      }
      var ctaLayer = new google.maps.KmlLayer({
        url: 'https://github.com/AlexisAC/911-mujeres/blob/master/map_scr/data_2.kmz?raw=true',
        map: map

      });
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
      infoWindow.setPosition(pos);
      infoWindow.setContent(
        browserHasGeolocation
          ? "Error: The Geolocation service failed."
          : "Error: Your browser doesn't support geolocation."
      );
      infoWindow.open(map);

    }

  </script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZupJe2lSfESxP329pev0lsdc6GL0tO2w&callback=initMap">
    </script>
</body>

</html>