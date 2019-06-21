    //Not allow enter in Map Fields
    $("#googlemapByAddr").on("keypress",function(e) {
        var key = e.keyCode;
        // If the user has pressed enter
        if (key == 13) {
            return false;
        }
        else {
            return true;
        }
    });
    
    $("#googlemapByGPS").on("keypress",function(e) {
        var key = e.keyCode;
        // If the user has pressed enter
        if (key == 13) {
            return false;
        }
        else {
            return true;
        }
    });

    //map modal
    $('#mapModal').on('show.bs.modal', function () {
        
        //empty the previous search words
        $('#googlemapByGPS').val('');
        $('#googlemapByAddr').val('');
        
        setTimeout(function () {
            google.maps.event.trigger(map, 'resize');
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
        }, 2000); //wait for modal pop up
    });

    //click this button to search map by address
    $('#searchByAddr').click(function(e){
        e.preventDefault();
        var address = document.getElementById("googlemapByAddr").value;
        if(address == "")
            return false;
        codeAddress(address);
    });
    
    //click this button to search map by GPS
    $('#searchByGPS').click(function(e){
        e.preventDefault();
        var gps = document.getElementById("googlemapByGPS").value;
        if(gps == "")
            return false;
        codeCoordinate(gps);
    });
    
    //Save to get the GPS location
    $('#modal_save').click(function(){
        var gps = $('#latlngspan').text().substr(1, $('#latlngspan').text().length-2); // (123,123) --> 123,123
        $('#gps').val(gps);
    });