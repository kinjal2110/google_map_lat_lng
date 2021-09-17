<!DOCTYPE html>
<html>

<head>
  <title>Simple Map</title>
  <meta name="viewport" content="initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.googlemap/1.5.1/jquery.googlemap.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.googlemap/1.5.1/jquery.googlemap.js"></script>

  <meta charset="utf-8">
  <style>
    /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
    #map {
      width: 90%;
      height: 90%;
    }

    /* Optional: Makes the sample page fill the window. */
    html,
    body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
  </style>
</head>

<body>
  <h1 class="alert-info p-2 m-3 text-center">Access google map API using PHP</h1>
  <form action="" method="post">
    <table class="table table-primary">
      <tr>
        <td>Latitude:</td>
        <td><input type="text" name="latitude" id="latitude"></td>
        <td><span id="lat"></span></td>
      </tr>
      <tr>
        <td>Longitude</td>
        <td><input type="text" name="longitude" id="longitude"></td>
      </tr>
    </table>
  </form>
  <div id="map" class="d-flex "></div>
</body>

</html>
<script type="text/javascript">
  // window.onload = function() {
  // lat =document.getElementById('latitude');


  // // The location of Uluru
  // const bhavnagar = {
  //   lat: 21.7645,
  //   lng: 72.1519
  // };
  function initMap() {
    const myLatlng = {
      lat: 21.7645,
      lng: 72.1519
    };
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 10,
      center: myLatlng,
    });
    // Create the initial InfoWindow.
    let infoWindow = new google.maps.InfoWindow({
      content: "Click the map to get Lat/Lng!",
      position: myLatlng,
    });

    infoWindow.open(map);
    const marker = new google.maps.Marker({
    position: myLatlng,
    map,
    title: "Click to zoom",
  });
    map.addListener("center_changed", () => {
    // 3 seconds after the center of the map has changed, pan back to the
    // marker.
    window.setTimeout(() => {
      map.panTo(marker.getPosition());
    }, 3000);
  });

    // Configure the click listener.
    map.addListener("click", (mapsMouseEvent) => {

      // Close the current InfoWindow.
      infoWindow.close();
      // Create a new InfoWindow.
      infoWindow = new google.maps.InfoWindow({
        position: mapsMouseEvent.latLng,
      
      });

      infoWindow.setContent(
        JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
      );
      infoWindow.open(map);
      
      //document.getElementById("latitude").value
      const data = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2);
      const obj = JSON.parse(data);
      console.log(obj);
      document.getElementById("latitude").value = obj['lat'];
      document.getElementById("longitude").value = obj['lng'];
      
    });
  }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxwPcvsjolfQPlM5Fmk-9Y4CvMxzBnvA8&callback=initMap" async defer></script>