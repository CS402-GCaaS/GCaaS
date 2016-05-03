/*!
 * Start Bootstrap - Grayscale Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery to collapse the navbar on scroll
function collapseNavbar() {
    if ($(".navbar").offset().top > 50) {
        $(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        $(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
}

$(window).scroll(collapseNavbar);
$(document).ready(collapseNavbar);

// jQuery for page scrolling feature - requires jQuery Easing plugin
$(function() {
    $('a.page-scroll').bind('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

// Closes the Responsive Menu on Menu Item Click
$('.navbar-collapse ul li a').click(function() {
  if ($(this).attr('class') != 'dropdown-toggle active' && $(this).attr('class') != 'dropdown-toggle') {
    $('.navbar-toggle:visible').click();
  }
});

 //// Google Maps Scripts
 //var map = null;
 //// When the window has finished loading create our google map below
 //google.maps.event.addDomListener(window, 'load', init);
 //google.maps.event.addDomListener(window, 'resize', function() {
 //    map.setCenter(new google.maps.LatLng(40.6700, -73.9400));
 //});
 //
 //function init() {
 //    // Basic options for a simple Google Map
 //    // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
 //    var mapOptions = {
 //        // How zoomed in you want the map to start at (always required)
 //        zoom: 15,
 //
 //        // The latitude and longitude to center the map (always required)
 //        center: new google.maps.LatLng(40.6700, -73.9400), // New York
 //
 //        // Disables the default Google Maps UI components
 //        disableDefaultUI: true,
 //        scrollwheel: false,
 //        draggable: false
 //    };
 //
 //    // Get the HTML DOM element that will contain your map
 //    // We are using a div with id="map" seen below in the <body>
 //    var mapElement = document.getElementById('map');
 //
 //    // Create the Google Map using out element and options defined above
 //    map = new google.maps.Map(mapElement, mapOptions);
 //
 //    //var myLatLng = new google.maps.LatLng(40.6700, -73.9400);
//}

google.maps.event.addDomListener(window, 'load', initialize);
google.maps.event.addDomListener(window, 'resize', function() {
    map.setCenter(new google.maps.LatLng(5, 101));
});

function initialize() {
    var mapProp = {
        center:new google.maps.LatLng(5,101),
        zoom:5,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var map=new google.maps.Map(document.getElementById("map"), mapProp);
    var drawingManager = new google.maps.drawing.DrawingManager({
        drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [
                google.maps.drawing.OverlayType.POLYGON,
                google.maps.drawing.OverlayType.RECTANGLE
            ]
        }
    });
    drawingManager.setMap(map);
}


