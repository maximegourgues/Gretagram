var Albi = [43.933333, 2.150000]

			var map = new L.Map('map', {zoom: 6, center: Albi });
			map.addLayer(new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'));	//base layer
			
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