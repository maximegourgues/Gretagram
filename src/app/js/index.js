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


leafMarkers = new L.LayerGroup();
map.addLayer(leafMarkers);

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

var tabID = [];
var tabMarkers = [];

map.on('click', placerMarqueur);

function placerMarqueur(e) {
  var lati = e.latlng.lat;
  var longi = e.latlng.lng;
  console.log(lati);
  console.log(longi);
  var marker = L.marker([lati,longi]);
  

  //SET ID
  var i = getNewIndex();
  marker.id=i;
  tabID.push(marker.id);
  console.log("id: "+marker.id);
  marker.bindPopup("<h3>"+marker.id+"</br><input type='button' value='Delete' onclick='deleteMarker("+marker.id+")'>");

  //AJOUT DU MARQUEUR DANS LE TABLEAU
  tabMarkers.push(marker);

  marker.addTo(leafMarkers);

  // Faire quelque chose suite à l’événement
  //marker.on('click',console.log(e));
  console.log("tabID: "+tabID);
  console.log("tabMarkers: "+tabMarkers);
  console.log("Marker:"+marker);
  console.log("find:"+(findMarkerInArrayByID(marker.id)));
}

function mouseDown(e) {
  e = e || window.event;
  if ( !e.which && e.button !== undefined ) {
    e.which = ( e.button & 1 ? 1 : ( e.button & 2 ? 3 : ( e.button & 4 ? 2 : 0 ) ) );
  }
  switch (e.which) {
    case 1: alert('left'); break;
    case 2: alert('middle'); break;
    case 3: alert('right'); break; 
  }
}

function getNewIndex(){
  var i=getRandomInt();
  if(!(tabID.includes(i))){
    return i;
  }else{
  return getNewIndex();
  }
}

function getRandomInt() {
  return Math.floor(Math.random() * Math.floor(1000));
}

function deleteMarker(m){
  console.log("Remove marker: "+m);
  var lay = findMarkerInArrayByID(m.id);
  leafMarkers.removeLayer(lay);
}

function findMarkerInArrayByID(ID){
  /*for(int i=0;i<=tabMarkers.length;i++){
    if(tabMarkers.get)
  }*/
  var found = tabMarkers.find(function(element) { 
    return element.id=ID; 
  }); 
  return found;
}

console.log(markers);
//console.log(markers.length);
/*function loadMarkers(){
  n=markers.length;
  console.log(n);
  for(i=0 ; i<n ; i++){
    var link = "http://airbnb.com/rooms/"+markers.indexOf(i).id;
    console.log(link);
  }
  
}*/

