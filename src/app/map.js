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

        var sites = L.geoJson(data, {

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
	  //console.log(e.originalEvent.target);
	  if(e.originalEvent.target.id){
		console.log("PAS DE MARQUEUR CAR SELECT");
	  }
	  else{
		lat = e.latlng.lat;
		lon = e.latlng.lng;
	  }


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
	dist = 150;  // 150 miles,

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

//SELECTOR

	L.Control.numberSelector = L.Control.extend({
		onAdd: function(map) {
		  var el = L.DomUtil.create('div', 'leaflet-bar my-control');

		  el.innerHTML = "<select id='sel'> <option id='opt' value='10'>10</option><option id='opt' value='25'>25</option><option id='opt' value='50'>50</option><option id='opt' value='100'>100</option><option id='opt' value='150' selected>150</option></select>";
		  return el;
		},

		onRemove: function(map) {
		  // Nothing to do here
		}
	  });

	  L.control.numberSelector = function(opts) {
		return new L.Control.numberSelector(opts);
	  }

	  L.control.numberSelector({
		position: 'topleft'
	  }).addTo(map);

	  var selecteur = document.getElementById('sel');

	  selecteur.addEventListener('click',function(){
			var newVal = selecteur.selectedOptions.opt.value;
			console.log("Selected: "+newVal);
			dist = newVal;
			//console.log("Dist: "+dist);
	  });

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

//SEARCH

	map.addControl( new L.Control.Search({
		url: 'http://nominatim.openstreetmap.org/search?format=json&q={s}',
		jsonpParam: 'json_callback',
		propertyName: 'display_name',
		propertyLoc: ['lat','lon'],
		marker: L.marker([0,0],{radius:30}),
		autoCollapse: true,
		autoType: false,
		minLength: 2
	}) );





//Reduce/Extend Button

	var changeButton = document.getElementById('size');
	var container = document.getElementById('map-container');

	//container.classList.add("{transition-duration='0.5s'}");

	console.log(container.classList);
	//console.log(changeButton);
	var bigMap = true;

	changeButton.addEventListener('click',updateButton);

	//console.log("zoom: "+map.getZoom());

	function updateButton(){

			console.log(map.getCenter());
			var currentPos = map.getCenter();
			var currentZoom = map.getZoom();
			var feed = document.querySelector('.modifmain');

			if(bigMap){

				changeButton.value='Extend';
				bigMap=false;

				container.style.width='400px';
				container.style.height='400px';

				$('.map-container').removeClass('three');
				$('.map-container').addClass('three-trans');

				feed.style.left='20%';

				map.setView(currentPos);

				appendTendances();
			}
			else{
				changeButton.value='Reduce';
				bigMap=true;

				container.style.width='1000px';
				container.style.height='800px';

				$('.map-container').removeClass('three-trans');
				$('.map-container').addClass('three');

				feed.style.left='10%';

				map.setView(currentPos);

				removeTendances();
			}


	}

	//TENDANCES

	var node = document.createElement("DIV");
	var titre = document.createElement("h3");
	var titretext = document.createTextNode("tendances");
	titre.appendChild(titretext);
	node.appendChild(titre);

	function appendTendances(){
		container.appendChild(node);
	}

	function removeTendances(){
		container.removeChild(node);
	}
