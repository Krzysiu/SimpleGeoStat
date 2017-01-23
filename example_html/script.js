$(document).ready(function() {
	$.getJSON('map.json', function(jsonData) {
		var map = new Datamap({
			element: document.getElementById('map'),
			projection: 'mercator',
			fills: { defaultFill: '#7B7B7B' },
			data: jsonData,			
			geographyConfig: {
				borderColor: '#FFFFFF',
				highlightBorderWidth: 0,
				highlightFillColor: function(geo) { return geo['fillColor'] || '#7B7B7B'; },				
				popupTemplate: function(geo, data) {
					if (!data) { return }
					return '<div class="hoverinfo"><strong>' + geo.properties.name + '</strong><br>Count: <strong>' + data.count + '</strong></div>';
				}
			}
		});
	});
	
	$.getJSON('country.json', function(jsonData) {
	var couBody = '';
	  $.each(jsonData, function(country, count) { couBody += '<tr><td>' + country + '</td><td>' + count + '</td></tr>'; });
		$('#tablecou tbody').html(couBody);
	});
	
		$.getJSON('continent.json', function(jsonData) {
	var regBody = '';
	  $.each(jsonData, function(country, count) { regBody += '<tr><td>' + country + '</td><td>' + count + '</td></tr>'; });
		$('#tablereg tbody').html(regBody);
	});
	
});
