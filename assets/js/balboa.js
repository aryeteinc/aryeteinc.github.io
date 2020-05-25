mapboxgl.accessToken =
    "pk.eyJ1IjoiYXJ5ZXRlaW5jIiwiYSI6ImNrOXhleGV5dTAwNWwzbHBpbGJuMzVtN3IifQ.u1O8cx9b6krtAx137rGGOg";
var map = new mapboxgl.Map({
    container: "map",
    center: [-74.958863, 10.977659],
    style: "mapbox://styles/mapbox/streets-v11",
    zoom: 11.5,
});

var geojson = {
    type: "FeatureCollection",
    features: [{
        type: "Feature",
        geometry: {
            type: "Point",
            coordinates: [-74.9483167, 11.003167],
        },
        properties: {
            title: "Balboa",
            description: "Conjunto Cerrado",
            address2: "Puerto Colombia, Atlántico",
            url: "balboa.html",
        },
    }]
};

geojson.features.forEach(function (marker) {
    // create a HTML element for each feature
    var el = document.createElement("div");
    el.className = "marker";

    // make a marker for each feature and add to the map
    //new mapboxgl.Marker(el).setLngLat(marker.geometry.coordinates);
    new mapboxgl.Marker()
        .setLngLat(marker.geometry.coordinates)
        .setPopup(
            new mapboxgl.Popup({
                offset: 25
            }) // add popups
            .setHTML(
                "<h3 class='map-project-title'>" +
                marker.properties.title +
                "</h3><p class='map-project-description'>" +
                marker.properties.description +
                "</p><p>" +
                marker.properties.address2 +
                "</p>"
            )
        )
        .addTo(map);
});