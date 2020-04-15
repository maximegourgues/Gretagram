var Albi = [43.933333, 2.150000]

var map = L.map('map').setView([34.0531, -118.2321], 13);

L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    maxZoom: 18
}).addTo(map);
map.attributionControl.setPrefix(''); // Don't show the 'Powered by Leaflet' text.

var items = [Albi];

// nice leaflet-ajax plugin
// https://github.com/calvinmetcalf/leaflet-ajax
var geojsonLayer = L.geoJson.ajax('parks.geojson', {
  onEachFeature: function(data, layer) {
    items.push(layer);
    layer.bindPopup('<h3>' + data.properties.park + '</h3>');
  }
});

geojsonLayer.addTo(map);

L.control.search({
  data: items
}).addTo(map);


//GEOLOCATION

function onLocationFound(e) {
  var radius = e.accuracy / 2;
  var location = e.latlng
  L.marker(location).addTo(map)
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

//MARKERS

map.on('click', placerMarqueur);

function placerMarqueur(e) {
  var lati = e.latlng.lat;
  var longi = e.latlng.lng;
  console.log(lati);
  console.log(longi);
  var marker = L.marker([lati,longi]);
  marker.addTo(map);
  marker.bindPopup();
  // Faire quelque chose suite à l’événement
  
}

console.log(markers);
//console.log(markers.length);
function loadMarkers(){
  n=markers.length;
  console.log(n);
  for(i=0 ; i<n ; i++){
    var link = "http://airbnb.com/rooms/"+markers.indexOf(i).id;
    console.log(link);
  }
  
}

