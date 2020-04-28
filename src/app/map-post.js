var Albi = [43.933333, 2.150000]

	/*var map = new L.Map('map', {zoom: 6, center: Albi });
	map.addLayer(new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'));	//base layer*/
	



	/*//MARKERS

	map.on('click', placerMarqueur);

	function placerMarqueur(e) {
		var lati = e.latlng.lat;
		var longi = e.latlng.lng;
		console.log(lati);
		console.log(longi);
		var marker = L.marker([lati,longi]);
		marker.addTo(map);
		marker.bindPopup("Latitude: "+lati+"</br>Longitude: "+longi);
		// Faire quelque chose suite à l’événement
		
	}
	
	var markers=[[43.92225535431797,2.141567530925133],[43.931280721896975,2.155825284744473]];
	console.log(markers);
	//console.log(markers.length);*/

	
var url = "data.json";

//Defining variables for the selected points, circle, and click marker
var theMarker;
var theCircle;
var geojsonLayer;

	var map = L.map('map',{zoom:6,center:Albi});  
   
	var osm=new L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png',{ 
				attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'}).addTo(map);

    var promise = $.getJSON(url);
    promise.then(function(data) {
		
        sites = L.geoJson(data, {
			
            pointToLayer: function(feature, coordinates) {
				
				var m = L.circleMarker(coordinates, {
				radius: 8, //expressed in pixels circle size
				color: "red", 
				stroke: true,
				weight: 3,		//outline width  increased width to look like a filled circle.
				fillOpcaity: 1
				});
				//m.bindPopup(this.name);
				return  m;
				}

			/*onEachFeature: function (feature, layer) {
				layer.bindPopup(feature.properties.name); //This line enables popups on click
		
				layer.on('mouseover', function (e) {
					//Popup
					this.openPopup();
				});
	
				layer.on('mouseout', function (e) {
					//Popup
					this.closePopup()
				});
			}*/
		});
		
		getLocationLeaflet();

		//map.fitBounds(sites.getBounds(), {padding: [30, 30]});
		//sites.addTo(map);
		map.setView
		
		//layer control
			var baseMaps = {
				'Open StreetMap':osm
			};
	
		/*var overlayMaps = {
		"Vendors":sites
	};	
		L.control.layers(baseMaps, overlayMaps).addTo(map);  */
		});
		
  map.on('click',function(e){
		lat = e.latlng.lat;
		lon = e.latlng.lng;
			
	console.log("You clicked the map at LAT: "+ lat+" and LONG: "+lon );
		//Clear existing marker, circle, and selected points if selecting new points
		if (theCircle != undefined) {
		  map.removeLayer(theCircle);
		};
		if (theMarker != undefined) {
			  map.removeLayer(theMarker);
		};
		if (geojsonLayer != undefined) {
			  map.removeLayer(geojsonLayer);
		};
		
	//Add a marker to show where you clicked.
	 theMarker = L.marker([lat,lon]).addTo(map);  //Note: if lat/lon are strings then use parseFloat(lat), parseFloat(lon)
	SelectPoints(lat,lon);
	  
});
	
	var selPts = [];
	dist = 15;  // 150 miles,

	function SelectPoints(lat,lon){
		xy = [lat,lon];  //center point of circle
		//dist = 150;  // 150 miles, 
		var theRadius = dist * 1609.34  //1609.34 meters in a mile 
		
		selPts.length =0;  //Reset the array if selecting new points
		
		sites.eachLayer(function (layer) {
			// Lat, long of current point as it loops through.
			layer_lat_long = layer.getLatLng();
			
			// Distance from our circle marker To current point in meters
			distance_from_centerPoint = layer_lat_long.distanceTo(xy);
			
			// See if meters is within radius, add the to array
			if (distance_from_centerPoint <= theRadius) {
				 selPts.push(layer.feature);  
			}
		});
	
		// draw circle to see the selection area
		theCircle = L.circle(xy, theRadius , {   /// Number is in Meters
		  color: 'orange',
		  fillOpacity: 0,
		  opacity: 1
		}).addTo(map);
		

		
		//Symbolize the Selected Points
			 geojsonLayer = L.geoJson(selPts, {
			 
				pointToLayer: function(feature, latlng) {
					return L.circleMarker(latlng, {
					radius: 4, //expressed in pixels circle size
					color: "green", 
					stroke: true,
					weight: 7,		//outline width  increased width to look like a filled circle.
					fillOpcaity: 1
					});
					}
			});
			//Add selected points back into map as green circles.
			map.addLayer(geojsonLayer);
			
			//Take array of features and make a GeoJSON feature collection 
			var GeoJS = { type: "FeatureCollection",  features: selPts   };
			//Show number of selected features.
			console.log(GeoJS.features.length +" Selected features");
			 // show selected GEOJSON data in console
			//console.log(JSON.stringify(GeoJS)); 
			selPts.forEach(element => console.log(element.properties.name));
	}	//end of SelectPoints function

//GEOLOCATION

	var LeafIcon = L.Icon.extend({
		options: {
			shadowUrl: 'marker-shadow.png',
			iconSize:     [40, 40],
			shadowSize:   [50, 64],
			iconAnchor:   [20, 35],
			shadowAnchor: [4, 62],
			popupAnchor:  [-3, -76]
		}
	});

	var redIcon = new LeafIcon({iconUrl: 'red-marker.png'});

	  function onLocationFound(e) {
		var radius = e.accuracy / 2;
		var location = e.latlng
		L.marker(location,{icon:redIcon}).addTo(map)
		L.circle(location, radius).addTo(map);
	  }
	  
	  function onLocationError(e) {
		alert(e.message);
	  }
	  
	  function getLocationLeaflet() {
		map.on('locationfound', onLocationFound);
		map.on('locationerror', onLocationError);
	  
		map.locate({setView: true, maxZoom: 15});
	  
	  }
      
	
    $('#search').keydown(function(){
        console.log("search");
        $.getJSON('data-villes.json',function(data){
            console.log("1");
            var search = $('#search').val();
            var regex = new RegExp(search, 'i');
            var output;

            /*var newObj = {'type':'Feature','properties':{ 'name':'Toulon','city':'Toulon'},'geometry':{ 'type': 'Point','coordinates': [ 5.9333, 43.1167]} };
            data.features.push(newObj);*/

            $.each(data.features,function(key,val){
                if((val.title.search(regex) != -1)){
                    output+="<tr>";
                    output+="<td class='item-searched' id="+key+" book='["+val.loc+"]'>"+val.title+"</td>";
                    output+="</tr>";
                }
            });
            $('tbody').html(output);
            //console.log(search);
            //console.log(data);
        });
    });

    $('tr').click(console.log(this.book));

