<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>911 Mujeres</title>
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
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZupJe2lSfESxP329pev0lsdc6GL0tO2w&libraries=&v=weekly"
    defer></script>
</head>

<body>
  <?php include('nav.html') ?>

  <div class="justify-content-center">
    <a onclick="getLocation()">
      <img src="img/svg/ayuda.svg" class="btn ml-5" style="width: 70%;" alt="Ayuda">
    </a>
    <p class="text-center">Ayuda</p>
    <!--Este sirve en el caso de que si ven algo sospechoso lo  avisen a un grupo o conocido por mensaje-->
    <a class="col-xs-12" href="https://api.whatsapp.com/send?phone=5216271433092&text=Alerta%20acerca%20de:">
      <img src="img/svg/alerta.svg" class="btn ml-5" style="width: 70%;" alt="Alerta">
    </a>
    <p class="text-center">Alerta sobre algo</p>
  </div>
  <!--Este llama a un número de ayuda-->
  <a href="tel:+526271433092">
    <img src="img/svg/llamada.svg" class="btn ml-5" style="width: 70%;" alt="Ayuda">
  </a>
  <p class="text-center">llama a alguien</p>
  <!--Aqui va el mapa-->


  <!-- jQuery -->
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Your custom scripts (optional) -->
  <script type="text/javascript"></script>

  <script>
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.watchPosition(showPosition);
      } else {
        alert("error no se puede acceder a la ubicación");
      }
    }

    function showPosition(position) {
      var geocoder = new google.maps.Geocoder();
      var latlng = {
        lat: parseFloat(position.coords.latitude),
        lng: parseFloat(position.coords.longitude)
      };
      geocoder.geocode(
        {
          location: latlng
        },
        function (results, status) {
          if (status === "OK") {
            if (results[0]) {


              console.log(results[0].formatted_address);

              window.open('https://api.whatsapp.com/send?phone=5216271433092&text=Necesito ayuda, esta es mi dirección ' + results[0].formatted_address);
            } else {
              window.alert("No results found");
            }
          } else {
            window.alert("Geocoder failed due to: " + status);
          }
        }
      );

    }
  </script>
</body>

</html>