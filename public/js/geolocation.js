/* // This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
      center: { lat: -33.866, lng: 151.196 },
      zoom: 15,
    });
    const request = {
      placeId: "ChIJN1t_tDeuEmsRUsoyG83frY4",
      fields: ["name", "formatted_address", "place_id", "geometry"],
    };
    const infowindow = new google.maps.InfoWindow();
    const service = new google.maps.places.PlacesService(map);
    service.getDetails(request, (place, status) => {
      if (status === google.maps.places.PlacesServiceStatus.OK) {
        const marker = new google.maps.Marker({
          map,
          position: place.geometry.location,
        });
        google.maps.event.addListener(marker, "click", function () {
          infowindow.setContent(
            "<div><strong>" +
              place.name +
              "</strong><br>" +
              "Place ID: " +
              place.place_id +
              "<br>" +
              place.formatted_address +
              "</div>"
          );
          infowindow.open(map, this);
        });
      }
    });
  } */