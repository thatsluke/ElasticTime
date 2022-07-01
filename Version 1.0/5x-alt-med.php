<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=500" />
<meta property="og:url" content="https://elastictime.me" />
<meta property="og:type" content="app" />
<meta property="og:title" content="Try the Personal Elastic Time clock! - 5 Moments Day / 5 Moments Night" />
<meta name="author" content="Luc Amstrong">
<meta property="og:description"  content="Life in fifths (or really tenths)! What would make time feel better to you? Who designed our clocks?  What impact does this simple clock have on our lives?" />
<meta property="og:image" content="https://elastictime.me/screenshot.png" />
<meta name="apple-mobile-web-app-capable" content="yes">

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="https://elastictime.me/suncalc-master/suncalc.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.js"></script>
<script>  
function geoFindMe() {
  var output = document.getElementById("out");

  if (!navigator.geolocation){
    output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
    return;
  }

  function success(position) {
    var latitude  = position.coords.latitude;
    var longitude = position.coords.longitude;

    output.innerHTML = '<p>Latitude: ' + latitude + ' <br>Longitude: ' + longitude + '</p>';
    // get today's sunlight times for Omaha
var times = SunCalc.getTimes(new Date(), latitude, longitude);

// format sunrise time from the Date object
var sunriseStr = (times.sunrise.getHours() * 60) + times.sunrise.getMinutes();
var ndawnStr = (times.sunrise.getHours() * 60) + times.sunrise.getMinutes();
var ndawnTime = times.sunrise.getHours() + ':' + times.sunrise.getMinutes();
var sunsetStr = (times.sunset.getHours() * 60) + times.sunset.getMinutes();
var nduskStr = (times.sunset.getHours() * 60) + times.sunset.getMinutes();
var nduskTime = times.sunset.getHours() + ':' + times.sunset.getMinutes();
  var begin = ndawnStr;
  var end = nduskStr;
  setTimeout(function startTime() {
  var moments = 5;
  var ms = 1440 * 60 * 1000;
  var dawn = begin * 60 * 1000;
  var dusk = end * 60 * 1000;
  var day = false;
  var now = new Date();
  var born = new Date("March 19, 1981 00:00:01");
  // var midnight = now.setHours(0,0,0,0);
  var midnight = moment().startOf("day").toDate();
  var day, currentMoment;

  var options = { weekday: "long", year: "numeric", month: "short",  day: "numeric", hour: "2-digit", minute: "2-digit" };  
  var currentMs = now - midnight;
  var dayMs = dusk - dawn;
  var nightMs = ms - dayMs;
  var dayMoment = dayMs / moments / 60000;
  var nightMoment = nightMs / moments / 60000;
  // Day and Night Moments are calculated by dividing into available moments then converting from milliseconds to minutes / moment by dividing by 60000 we divide by 10 to get to minutes / action.
  var dayAction = dayMs / moments / 60000 / 10;
  var nightAction = nightMs / moments / 60000 / 10;

  var dayActionMinutes = Math.floor(dayAction);
  var dayActionSeconds = Math.floor(dayAction * 600) % 100;
  var nightActionMinutes = Math.floor(nightAction);
  var nightActionSeconds = Math.floor(nightAction * 600) % 100;

  var dayMomentMinutes = Math.floor(dayMoment);
  var dayMomentSeconds = Math.floor(dayMoment * 600) % 100;
  var nightMomentMinutes = Math.floor(nightMoment);
  var nightMomentSeconds = Math.floor(nightMoment * 600) % 100;

  if (currentMs >= dawn && currentMs <= dusk) {
    day = true;
    var msPastDawn = currentMs - dawn;
    var percentOfDayPast = msPastDawn / dayMs;
    var currentMoment = percentOfDayPast * moments;
    var momentOnly = Math.floor(currentMoment);
    var actionOnly = Math.floor(currentMoment * 10) % 10;
    var fleetingMoment = Math.floor(currentMoment * 1000) % 100;
    var fleetCurrentMoment = Math.floor(currentMoment * 100000) % 1000000;
  } else {
    day = false;
    var msPastDusk;
    if (currentMs < dawn) {
      // before dawn
     var msPastDusk = currentMs + (ms - dusk);
    } else {
      var msPastDusk = currentMs - dusk;
    }
    var percentOfNightPast = msPastDusk / nightMs;
    var currentMoment = percentOfNightPast * moments;
    var fleetingMoment = Math.floor(currentMoment * 1000) % 100;
    var fleetCurrentMoment = Math.floor(currentMoment * 100000) % 1000000;
    var momentOnly = Math.floor(currentMoment);
    var actionOnly = Math.floor(currentMoment * 10) % 10;
  }
  document.getElementById('now').innerHTML = now.toLocaleTimeString("en-us", options);
  document.getElementById('dayMoment').innerHTML = "day slice</br>" + dayMomentMinutes + " minutes " + dayMomentSeconds + " seconds";
  document.getElementById('nightMoment').innerHTML = "night slice</br>" + nightMomentMinutes + " minutes " + nightMomentSeconds + " seconds";
  document.getElementById('dayAction').innerHTML = "day action</br>" + dayActionMinutes + " minutes " + dayActionSeconds + " seconds";
  document.getElementById('nightAction').innerHTML = "night action</br>" + nightActionMinutes + " minutes " + nightActionSeconds + " seconds";
  document.getElementById('day').innerHTML =  (day ? "Day Phase" : "<span style='color:#555'>Night Phase</span>");
  document.getElementById('moment').innerHTML =  "slice " + momentOnly + " of " + moments + " / ";
  document.getElementById('action').innerHTML =  "action " + actionOnly + " of 10";
  document.getElementById('detail').innerHTML =  "the fleeting now </br>" + currentMoment + "</br></br>";
  document.getElementById('fleet').innerHTML =  "<b style='font-size: 20px;'>moment</b></br><span style='text-align:center;font-size: 200px; font-weight:bold;color: #ccc;'>" + fleetingMoment + "</span></br></br>";
  var t = setTimeout(startTime, 50);

}, 1000);
document.getElementById('detail2').innerHTML =  "Day Begins</br>" + ndawnTime + "</br></br>  Night Begins</br>" + nduskTime + "</br></br>";
  }

  function error() {
    output.innerHTML = "Unable to retrieve your location";
  }

  output.innerHTML = "<p>Locating...</p>";

  navigator.geolocation.getCurrentPosition(success, error);

}


</script>
</head>

<body style="position:relative; margin: 0; padding:0; background: #333;" onload="geoFindMe();startTime()">
<div id="container" style="text-align: center; font-family: Sans-Serif; background: #000; color: #777;">
<div id="moment" style="text-align: center; font-family: Sans-Serif; font-size: 14px; font-weight:bold;color: #ccc;display: inline-block;">&nbsp;</div>
<div id="action" style="padding-bottom: 10px; padding-top: 20px; font-size: 14px; font-weight: bold;display: inline-block;">&nbsp;</div>
<div id="fleet" style="background: #222; margin: 5px auto; padding: 50px; text-align: center; border-radius: 50%; height: 250px; width: 250px; border: 2px solid #333; font-size: 14px; color: #777;"></div>
<div id="day" style="padding: 10px; font-size: 14px; border-top: 2px solid #333; border-bottom: 2px solid #333;  margin: 20px; font-weight:bold; font-style:italic;">&nbsp;</div>
<!--<div id="yearday" style="padding: 10px; font-size: 36px; font-weight: bold; margin-top: 30px;">day <?php echo date("z") + 1; ?></div>
<div id="cycle" style="padding: 10px; font-size: 24px; font-weight: bold; ">cycle <?php echo date("W"); ?></div>
<div id="year" style="padding: 10px; font-size: 24px; font-weight: bold; padding-bottom: 30px;">year <?php echo date("o") + 1; ?></div>-->
<div id="birthYear" style="padding: 10px; font-size: 14px; font-weight: bold; padding-bottom: 30px;"><?php include 'birthyear.php';?>
</div>
</div>
<div style="font-family: Sans-Serif; font-size: 12px; font-style:italic; color: #000; background:#777; text-align: center; padding: 20px; ">
<div style="font-weight: bold;">Elastic Time Legend</div>
<div id="dayAction" style="padding: 10px;">&nbsp;</div>
<div id="dayMoment" style="padding: 10px;">&nbsp;</div>
<div id="nightAction" style="padding: 10px;">&nbsp;</div>
<div id="nightMoment" style="padding: 10px;">&nbsp;</div>
<div id="detail" style="padding: 10px;"></div>
<div style="font-weight: bold;">Logistic Time</div>
<div id="now" style="margin-bottom: 25px;">&nbsp;</div>
<div id="detail2"></div>
<div id="out" style=""></div>
<div><a href="https://calicommons.net/lucluke/DC/content.php?singlePostID=1370"><img src="lucluke-logo-web.png" alt="ElasticTime.me by LucLuke" style="width:75px; border:none;"/></a></div>
</div>
</body>
</html>
