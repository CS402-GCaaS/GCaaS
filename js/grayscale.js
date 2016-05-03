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

var polygonObj;
var regtangObj;

function initialize() {
    var mapProp = {
        center:new google.maps.LatLng(13,100),
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
        },
          rectangleOptions: {
            fillColor: 'black',
            fillOpacity: 0.1,
            strokeWeight: 3,
            strokeColor: 'black',
            clickable: true,
            editable: true,
            zIndex: 1
          },
          polygonOptions: {
            fillColor: 'blue',
            fillOpacity: 0.1,
            strokeWeight: 3,
            strokeColor: 'blue',
            clickable: true,
            editable: true,
            zIndex: 1
          }
    });
    drawingManager.setMap(map);
    google.maps.event.addListener(drawingManager, 'overlaycomplete', function(e) {
          drawingManager.setDrawingMode(null);
          if (regtangObj!=null) {
            regtangObj.setMap(null);
          }
          if (polygonObj!=null) {
            polygonObj.setMap(null);
          }
          if (e.type == google.maps.drawing.OverlayType.POLYGON) 
          {
            polygonObj = e.overlay;
            if (polygonObj.getPath().getLength()>=3) {
              //searchPolygon();
              //google.maps.event.addListener(polygonObj.getPath(), 'insert_at', searchPolygon);
              //google.maps.event.addListener(polygonObj.getPath(), 'set_at', searchPolygon);
            }
            else{
              for (var i = 0; i < marker.length; i++) {
                marker[i].setMap(null);
              } 
              alert("ใส่จุดอย่างน้อย3จุด");
            }
          }
          else if (e.type == google.maps.drawing.OverlayType.RECTANGLE) 
          {
            regtangObj = e.overlay;
            //searchCircle();
            //google.maps.event.addListener(regtangObj, 'radius_changed', searchCircle);
            //google.maps.event.addListener(regtangObj, 'center_changed', searchCircle);
          } 
        });
}

function submit(){
    var xmlhttp;
    var myLatlng;
    var firstPoint;
    var polygon = "POLYGON((";
    var rectangle = "POLYGON((";

    var deploymentName = document.getElementById('deployName').value ;
    var url = "https://GCaaS.com/" + document.getElementById('url').value ;
    var hashtag = document.getElementById('hashtag').value ;
    var type = document.getElementById('select').value ;
    var descrip = document.getElementById('description').value ;
    var hospital = "";
    var school = "";
    var police = "";
    var fire = "";
    var temple = "";
    var twitter = "";
    if (document.getElementById('hospital').checked == true) {
        hospital = document.getElementById('hospital').value ;
    };
    if (document.getElementById('school').checked == true) {
        school = document.getElementById('school').value ;
    };
    if (document.getElementById('police').checked == true) {
        police = document.getElementById('police').value ;
    };
    if (document.getElementById('fire').checked == true) {
        fire = document.getElementById('fire').value ;
    };
    if (document.getElementById('temple').checked == true) {
        temple = document.getElementById('temple').value ;
    };
    if (document.getElementById('twitter').checked == true) {
        twitter = document.getElementById('basic').value ;
    };

    console.log(deploymentName);
    console.log(url);
    console.log(hashtag);
    console.log(type);
    console.log(descrip);
    console.log(hospital);
    console.log(school);
    console.log(police);
    console.log(fire);
    console.log(temple);
    console.log(twitter);

    if (type == "Please select type of deployment...") {
        alert("Please selected Type of Deployment")
    };

    if (regtangObj != null) {
        polygonObj = null
        for (var i = 0; i < regtangObj.getPath().getLength(); i++)
        {
          if (i == 0) {
            firstPoint = regtangObj.getPath().j[i];
            rectangle = rectangle + firstPoint.F + " " + firstPoint.A + ", " ;
          }
          else {
            rectangle = rectangle + regtangObj.getPath().j[i].F + " " + regtangObj.getPath().j[i].A + ", " ;
          }
        }
        rectangle = rectangle + firstPoint.F + " " + firstPoint.A + "))" ;
    } 
    if (polygonObj != null){
        regtangObj = null
        for (var i = 0; i < polygonObj.getPath().getLength(); i++)
        {
          if (i == 0) {
            firstPoint = polygonObj.getPath().j[i];

            polygon = polygon + firstPoint.F + " " + firstPoint.A + ", " ;
          }
          else {
            polygon = polygon + polygonObj.getPath().j[i].F + " " + polygonObj.getPath().j[i].A + ", " ;
          }
        }
        polygon = polygon + firstPoint.F + " " + firstPoint.A + "))" ;
        console.log(firstPoint);
    }
    else {
        alert("Select Area of Deployment");
    }

    console.log(polygon);
    console.log(rectangle);
    
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
      if (xmlhttp.readyState==4 && xmlhttp.status==200 ) //200 OK do 4 stage
        {
          console.log(JSON.parse(xmlhttp.responseText));
        }
    }
    xmlhttp.open("GET","http://localhost/cgi-bin/create.py?deployName="+deploymentName+"&url="+url+"&hashtag="+hashtag+"&typeDep="+type+"&description="+descrip+"&hospital="+hospital+"&school="+school+"&police="+police+"&fire="+fire+"&temple="+temple+"&TW="+twitter,true);
    xmlhttp.send();
}

function basicToCus(){
    document.getElementById('item1').disabled = false ;
    document.getElementById('item2').disabled = false ;
    document.getElementById('item3').disabled = false ;
    document.getElementById('item4').disabled = false ;
    document.getElementById('item5').disabled = false ;
    document.getElementById('item6').disabled = false ;

    document.getElementById('item1').checked = false ;
    document.getElementById('item2').checked = false ;
    document.getElementById('item3').checked = false ;
    document.getElementById('item4').checked = false ;
    document.getElementById('item5').checked = false ;
    document.getElementById('item6').checked = false ;
}

function cusToBasic(){
    document.getElementById('item1').disabled = true ;
    document.getElementById('item2').disabled = true ;
    document.getElementById('item3').disabled = true ;
    document.getElementById('item4').disabled = true ;
    document.getElementById('item5').disabled = true ;
    document.getElementById('item6').disabled = true ;

    document.getElementById('item1').checked = true ;
    document.getElementById('item2').checked = true ;
    document.getElementById('item3').checked = true ;
    document.getElementById('item4').checked = true ;
    document.getElementById('item5').checked = true ;
    document.getElementById('item6').checked = true ;
}

