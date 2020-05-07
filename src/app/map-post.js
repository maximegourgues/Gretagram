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
		

function removeMarkers(){
	if (theCircle != undefined) {
		map.removeLayer(theCircle);
	  };
	  if (theMarker != undefined) {
			map.removeLayer(theMarker);
	  };
	  if (geojsonLayer != undefined) {
			map.removeLayer(geojsonLayer);
	  };
}

function updateImputPosition(lat,lon){
	var coords = [lat,lon];
	var name = prompt("Veuillez nommer votre marqueur");
	//console.log(name);
	while(name.length<4){
		var name = prompt("Merci de lui donner un nom");
		/*$('#myInput').value=name;
		$('#myInput').data('coords',coords);*/
		//console.log($('#myInput').data('coords'));
	}
	//var x = document.getElementById("myInput").value;
	document.getElementById("myInput").value=name;
	//document.getElementById("preview-image").innerHTML = "Le contenu de l'input est: "+x;
}

  map.on('click',function(e){

		lat = e.latlng.lat;
		lon = e.latlng.lng;
			
	console.log("You clicked the map at LAT: "+ lat+" and LONG: "+lon );
		//Clear existing marker, circle, and selected points if selecting new points
		removeMarkers();
		//console.log(e.target.classList);
		//if(e.target.childNodes.length>0 && !(e.target.lastChild.classList.contains('clickable-item'))){
		updateImputPosition(lat,lon);
		//}
	//Add a marker to show where you clicked.
	   //Note: if lat/lon are strings then use parseFloat(lat), parseFloat(lon)
	SelectPoints(lat,lon);
	  
});
	
	var selPts = [];
	dist = 15;  // 150 miles,

	function SelectPoints(lat,lon){
		
		removeMarkers();
		theMarker = L.marker([lat,lon]).addTo(map);
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

		/*var coords = location.split(",");
		var a = coords[0];
		var b = coords[1];

		var c = [a,b];*/
		var c = [location.lat,location.lng];

		L.marker(location,{icon:redIcon}).addTo(map)
		L.circle(location, radius).addTo(map);
		//$('#myInput').data('coords',[location.lat,location.lng]);
		document.getElementById('lat_input').value=location.lat;
		document.getElementById('lon_input').value=location.lng;
		//console.log($('#myInput').data('coords'));
		//console.log(document.getElementById('coords_input').value);
	  }
	  
	  function onLocationError(e) {
		alert(e.message);
	  }
	  
	  function getLocationLeaflet() {
		map.on('locationfound', onLocationFound);
		map.on('locationerror', onLocationError);
	  
		map.locate({setView: true, maxZoom: 15});
	  
	  }
      
	
    /*$('#search').keydown(function(){
        console.log("search");
        $.getJSON('data-villes.json',function(data){
            console.log("1");
            var search = $('#search').val();
            var regex = new RegExp(search, 'i');
            var output;

           

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
    });*/

    //$('tr').click(console.log(this.book));

	//LOADING CITIES DATABASE

	var arr = [];
	$.getJSON('data-villes.json',function(data){
		$.each(data.features,function(key,val){
			arr.push(val);
		});
		//arr = JSON.parse(data.features);
		console.log("ARR: "+arr);
		console.log(arr[0].title);
	});

	//INTERACTIVE SEARCHBAR

	function autocomplete(inp) {
		
			/*the autocomplete function takes two arguments,
			the text field element and an array of possible autocompleted values:*/
			var currentFocus;
			/*execute a function when someone writes in the text field:*/
			inp.addEventListener("input", function(e) {
				var a, b, i, val = this.value;
				/*close any already open lists of autocompleted values*/
				closeAllLists();
				if (!val) { return false;}
				currentFocus = -1;
				/*create a DIV element that will contain the items (values):*/
				a = document.createElement("DIV");
				a.setAttribute("id", this.id + "autocomplete-list");
				a.setAttribute("class", "autocomplete-items");
				/*append the DIV element as a child of the autocomplete container:*/
				this.parentNode.appendChild(a);
				/*for each item in the array...*/
				for (i = 0; i < arr.length; i++) {
				/*check if the item starts with the same letters as the text field value:*/
				if (arr[i].title.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
					/*create a DIV element for each matching element:*/
					b = document.createElement("DIV");
					/*make the matching letters bold:*/
					b.innerHTML = "<strong>" + arr[i].title.substr(0, val.length) + "</strong>";
					b.innerHTML += arr[i].title.substr(val.length);
					/*insert a input field that will hold the current array item's value:*/
					b.innerHTML += "<input type='hidden' class='clickable-item' value='" + arr[i].title + "' id="+arr[i].loc+">";
					/*execute a function when someone clicks on the item value (DIV element):*/
						b.addEventListener("click", function(e) {
						/*insert the value for the autocomplete text field:*/
						inp.value = this.getElementsByTagName("input")[0].value;
						/*close the list of autocompleted values,
						(or any other open lists of autocompleted values:*/
						closeAllLists();
					});
					a.appendChild(b);
				}
				}
			});
			/*execute a function presses a key on the keyboard:*/
			inp.addEventListener("keydown", function(e) {
				var x = document.getElementById(this.id + "autocomplete-list");
				if (x) x = x.getElementsByTagName("div");
				if (e.keyCode == 40) {
				/*If the arrow DOWN key is pressed,
				increase the currentFocus variable:*/
				currentFocus++;
				/*and and make the current item more visible:*/
				addActive(x);
				} else if (e.keyCode == 38) { //up
				/*If the arrow UP key is pressed,
				decrease the currentFocus variable:*/
				currentFocus--;
				/*and and make the current item more visible:*/
				addActive(x);
				} else if (e.keyCode == 13) {
				/*If the ENTER key is pressed, prevent the form from being submitted,*/
				e.preventDefault();
				clickedItem(e);
				if (currentFocus > -1) {
					/*and simulate a click on the "active" item:*/
					if (x) x[currentFocus].click();
				}
				}
			});
			function addActive(x) {
			/*a function to classify an item as "active":*/
			if (!x) return false;
			/*start by removing the "active" class on all items:*/
			removeActive(x);
			if (currentFocus >= x.length) currentFocus = 0;
			if (currentFocus < 0) currentFocus = (x.length - 1);
			/*add class "autocomplete-active":*/
			x[currentFocus].classList.add("autocomplete-active");
			}
			function removeActive(x) {
			/*a function to remove the "active" class from all autocomplete items:*/
			for (var i = 0; i < x.length; i++) {
				x[i].classList.remove("autocomplete-active");
			}
			}
			function closeAllLists(elmnt) {
			/*close all autocomplete lists in the document,
			except the one passed as an argument:*/
			var x = document.getElementsByClassName("autocomplete-items");
			for (var i = 0; i < x.length; i++) {
				if (elmnt != x[i] && elmnt != inp) {
					x[i].parentNode.removeChild(x[i]);
				}
				}
			}
			/*execute a function when someone clicks in the document:*/

			document.addEventListener("click", function (e) {
				clickedItem(e.target);
				closeAllLists(e.target);
			});
		
	} 


function clickedItem(element){
	//console.log(tableau);
	var item = element.lastChild;
	if(item!=null && item.classList.contains("clickable-item") ){
		console.log(item.id);
		var coords = (item.id).split(",");
		var a = coords[0];
		var b = coords[1];
		SelectPoints(a,b);
		map.setView([a,b]);
		var c = [a,b];
		/*$('#myInput').data('coords',c);
		console.log($('#myInput').data('coords'));*/
		document.getElementById('lat_input').value=location.lat;
		document.getElementById('lon_input').value=location.lng;
		//console.log(document.getElementById('coords_input').value);
	}
}

//MINIATURE DE L'IMAGE
function handleFiles(files) {
	for (var i = 0; i < files.length; i++) {
	  var file = files[i];
	  var imageType = /^image\//;
  
	  if (!imageType.test(file.type)) {
		continue;
	  }
  
	  var img = document.createElement("img");
	  img.classList.add("obj");
	  img.file = file;
	  var preview = document.getElementById('preview-image');
	  preview.removeChild(preview.firstChild);
	  preview.appendChild(img); // En admettant que "preview" est l'élément div qui contiendra le contenu affiché. 
  
	  var reader = new FileReader();
	  reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
	  reader.readAsDataURL(file);
	}
  }
  

