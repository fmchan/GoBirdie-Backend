    var map;
    var geocoder;
    var marker;
    var infowindow;
    var position = [22.286952, 114.153099]; //default location

    function initialize() {
        var latlng = new google.maps.LatLng(position[0], position[1]);
        var myOptions = {
            zoom: 16,
            center: latlng,
            panControl: true,
            scrollwheel: false,
            scaleControl: true,
            overviewMapControl: true,
            overviewMapControlOptions: { opened: true }
            //mapTypeId: google.maps.MapTypeId.HYBRID
        };
        map = new google.maps.Map(document.getElementById("latlongmap"),  //div to display map
                myOptions);
        geocoder = new google.maps.Geocoder();
        marker = new google.maps.Marker({
            position: latlng,
            map: map
        });

        map.streetViewControl = false;
        infowindow = new google.maps.InfoWindow({
            content: "(" + position[0] + "," + position[1] + ")"
        });
/*
        google.maps.event.addListener(map, 'click', function(event) {
            marker.setPosition(event.latLng);
            var yeri = event.latLng;
            saveCoordinate(yeri.lat(), yeri.lng());
            infowindow.setContent("(" + position[0] + "," + position[1] + ")");
        });


        google.maps.event.addListener(map, 'mousemove', function(event) {
            var yeri = event.latLng;
            document.getElementById("mlat").innerHTML = "(" + yeri.lat().toFixed(6) + "," +yeri.lng().toFixed(6)+ ")";
        });
*/
    }

    function codeAddress(addressInput) {
        var address = addressInput; //input value
        if (address == '') {
            alert("Address can not be empty!");
            return;
        }
        geocoder.geocode({'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    map.setZoom(16);
                    map.setCenter(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);

                    saveCoordinate(results[0].geometry.location.lat(), results[0].geometry.location.lng());

                    infowindow.setContent("(" + position[0] + "," + position[1] + ")");

                    if (infowindow) {
                        infowindow.close();
                    }

                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.open(map, marker);
                    });
                    infowindow.open(map, marker);
              } else
                window.alert('No results found');
            } else
                //window.alert('Geocoder failed due to: ' + status);
                window.alert('Please try again!');
        });
    }

    function codeCoordinate(coordinateInput) {
      var input = coordinateInput; //input value
      var latlngStr = input.split(',', 2);
      var coordinate = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
      geocoder.geocode({'location': coordinate}, function(results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
          if (results[1]) {
            map.setZoom(16);
            map.setCenter(coordinate);
            marker.setPosition(coordinate);

            saveCoordinate(parseFloat(latlngStr[0]), parseFloat(latlngStr[1]));

            infowindow.setContent(results[1].formatted_address);

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
            });
            infowindow.open(map, marker);
          } else
            window.alert('No results found');
        } else
          //window.alert('Geocoder failed due to: ' + status);
          window.alert('Please try again!');
      });
    }

    function saveCoordinate(lat, lng) {
            position[0] = lat.toFixed(6);
            position[1] = lng.toFixed(6);
            var latlong = "(" + position[0] + "," + position[1] + ")";
            document.getElementById('latlngspan').innerHTML =  latlong;
            console.log(latlong);
    }

    function loadScript() {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize&key=AIzaSyCvVAg8O3EV5PAWkpI_kLXmMlB6FXufbLs';
        document.body.appendChild(script);
    }

    window.onload = loadScript;
/*
    $(document).ready(function() {
        $(document).on('submit','#searchaddress',function() {
          codeAddress(); 
          return false;
        });
        $(document).on('submit','#searchcoordinate',function() {
          codeCoordinate();
          return false;
        });
        $("#latlngspan").text("(" + position[0] + "," + position[1] + ")");
		
    });
*/
