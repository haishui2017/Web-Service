/*
Author: Cecilia(Wenxi) Zhang 
Course: CPRG210
*/
/*
 * create map
 */
var map = new google.maps.Map(document.getElementById("map_div"), {
  center: new google.maps.LatLng(50.92,-114.09143),
  zoom: 8,
  mapTypeId: google.maps.MapTypeId.ROADMAP
});

/*
 * use google maps api built-in mechanism to attach dom events
 */
google.maps.event.addDomListener(window, "load", function () {
  
  /*
   * create infowindow (which will be used by markers)
   */
  var infoWindow = new google.maps.InfoWindow();

  /*
   * marker creater function (acts as a closure for html parameter)
   */
  function createMarker(options, html) {
    var marker = new google.maps.Marker(options);
    if (html) {
      google.maps.event.addListener(marker, "click", function () {
        infoWindow.setContent(html);
        infoWindow.open(options.map, this);
      });
    }
    return marker;
  }

  /*
   * add markers to map
   */
  var marker0 = createMarker({
    position: new google.maps.LatLng(51.065888,-114.09143),
    map: map,
    icon: "https://1.bp.blogspot.com/_GZzKwf6g1o8/S6xwK6CSghI/AAAAAAAAA98/_iA3r4Ehclk/s1600/marker-green.png"
  }, "<h3>Calgary Agency</h3><p>1155 8th Ave SW, T2P 1N3</p><p>Phone:4032719873</p><p>Fax: 4032719872</p>");

  var marker1 = createMarker({
    position: new google.maps.LatLng(50.7225, -113.9749),
    map: map
  }, "<h3>Okotoks Agency</h3><p>110 Main Street, T7R 3J5</p><p>Phone:4035632381</p><p>Fax: 4035632382</p>");

  // var marker2 = createMarker({
  //   position: new google.maps.LatLng(33.803333, -117.915278),
  //   map: map
  // }, "<h1>Marker 2</h1><p>This is marker 2</p>");
});

// listen for the window resize event & trigger Google Maps to update too
// window.onresize = function() {
//   var currCenter = map.getCenter();
//   google.maps.event.trigger(map, 'resize');
//   map.setCenter(currCenter);
// };
google.maps.event.addDomListener(window, "resize", function() {
 var center = map.getCenter();
 google.maps.event.trigger(map, "resize");
 map.setCenter(center); 
});