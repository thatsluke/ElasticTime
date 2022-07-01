<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=500" />
  <title>Elastic Time - An responsive metric time based on the natural rhythm of our sun cycles</title>
  <meta property="og:url" content="https://elastictime.me" />
  <meta property="og:type" content="app" />
  <meta property="og:title" content="Check out Steve's Elastic Time Machine! Now with 10K Moments of Day and 10K Moments of Night." />
  <meta name="author" content="Luc Amstrong">
  <meta property="og:description"  content="Symetry all the way down! What would make time feel better to you? Who designed our clocks?  What impact does this simple clock have on our lives?" />
  <meta property="og:image" content="img/screenshot.png" />
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
var nNoonTime = times.solarNoon.getHours() + ':' + times.solarNoon.getMinutes();
var nGoldenTime = times.goldenHour.getHours() + ':' + times.goldenHour.getMinutes();
var nNadirTime = times.nadir.getHours() + ':' + times.nadir.getMinutes(); 
var begin = ndawnStr;
var end = nduskStr;
setTimeout(function startTime() {
  var slices = 10;
  var ms = 1440 * 60 * 1000;
  var dawn = begin * 60 * 1000;
  var dusk = end * 60 * 1000;
  var day = false;
  var now = new Date();
  var born = new Date("August 21, 1947 00:00:01");
  // var midnight = now.setHours(0,0,0,0);
  var midnight = moment().startOf("day").toDate();
  var day, currentMoment;

  var options = { weekday: "long", year: "numeric", month: "short",  day: "numeric", hour: "2-digit", minute: "2-digit" };  
  var currentMs = now - midnight;
  var dayMs = dusk - dawn;
  var nightMs = ms - dayMs;
  var dayMoment = dayMs / slices / 60000;
  var nightMoment = nightMs / slices / 60000;
  // Day and Night slices are calculated by dividing into available slices then converting from milliseconds to minutes / moment by dividing by 60000 we divide by 10 to get to minutes / action.
  var dayAction = dayMs / slices / 60000 / 10;
  var nightAction = nightMs / slices / 60000 / 10;

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
    var currentMoment = percentOfDayPast * slices;
    var sliceOnly = Math.floor(currentMoment);
    var sliceAdj = sliceOnly + 1;
    var actionOnly = Math.floor(currentMoment * 10) % 10;
    var actionAdj = actionOnly + 1;
    var fleetingMoment = Math.floor(currentMoment * 1000) % 100;
    var fleetingMomentAdj = fleetingMoment + 1;
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
    var currentMoment = percentOfNightPast * slices;
    var fleetingMoment = Math.floor(currentMoment * 1000) % 100;
    var fleetingMomentAdj = fleetingMoment + 1;
    var fleetCurrentMoment = Math.floor(currentMoment * 100000) % 1000000;
    var sliceOnly = Math.floor(currentMoment);
    var sliceAdj = sliceOnly + 1;
    var actionOnly = Math.floor(currentMoment * 10) % 10;
    var actionAdj = actionOnly + 1;
  }
  var detail = currentMoment;
  // var detail = currentMoment + 0.001;
  document.getElementById('now').innerHTML = now.toLocaleTimeString("en-us", options);
  document.getElementById('dayMoment').innerHTML = "day slice</br>" + dayMomentMinutes + " minutes " + dayMomentSeconds + " seconds";
  document.getElementById('nightMoment').innerHTML = "night slice</br>" + nightMomentMinutes + " minutes " + nightMomentSeconds + " seconds";
  document.getElementById('dayAction').innerHTML = "day action</br>" + dayActionMinutes + " minutes " + dayActionSeconds + " seconds";
  document.getElementById('nightAction').innerHTML = "night action</br>" + nightActionMinutes + " minutes " + nightActionSeconds + " seconds";
  document.getElementById('day').innerHTML =  (day ? "☀ day time / act " + sliceAdj + " / action " + actionAdj : "☽ night time / rest " + sliceAdj + " / respite " + actionAdj);
  // document.getElementById('slice').innerHTML =  "slice " + sliceAdj + " / ";
 // document.getElementById('action').innerHTML =  "action " + actionAdj;
 document.getElementById('detail').innerHTML =  "<b>the fleeting now</b> </br>" + detail + "</br></br>";
 document.getElementById('fleet').innerHTML =  "<b style='display: inline-block; font-size: 25px; margin-top: 20px;'>moment</b></br><span style='text-align:center;font-size: 150px; font-weight:bold;color: #ccc;'>" + fleetingMomentAdj + "</span></br></br>";
 var t = setTimeout(startTime, 50);

}, 1000);
document.getElementById('detail2').innerHTML =  "Day Begins</br>" + ndawnTime + "</br></br>  Night Begins</br>" + nduskTime + "</br></br>  Solar Noon</br>" + nNoonTime + "</br></br>  Golden Hour</br>" + nGoldenTime + "</br></br>  Nadir</br>" + nNadirTime + "</br></br>";
}

function error() {
  output.innerHTML = "Unable to retrieve your location";
}

output.innerHTML = "<p>Locating...</p>";

navigator.geolocation.getCurrentPosition(success, error);

}


</script>
</head>

<body style="position:relative; margin: 0; padding:0; background: #555;" onload="geoFindMe();startTime()">
  <div id="container" style="text-align: center; font-family: Sans-Serif; background: #000; color: #777;">
    <div id="day" style="padding: 10px; font-size: 14px; border-bottom: 2px solid #333; font-weight:bold; font-style:italic;">&nbsp;</div>
    <div id="purpose" style="text-align: center; font-family: Sans-Serif; font-size: 21px; font-weight:bold;color: #ccc;"><?php include 'purposekey.php';?></div>
<!--<div id="slice" style="text-align: center; font-family: Sans-Serif; font-size: 16px; font-weight:bold;color: #ccc;display: inline-block;">&nbsp;</div>
  <div id="action" style="padding-bottom: 10px; padding-top: 10px; font-size: 16px; font-weight: bold;display: inline-block;">&nbsp;</div>-->
  <div id="fleet" style="background: #111; margin: 5px auto; padding: 50px; text-align: center; border-radius: 50%; height: 250px; width: 250px; border: 2px solid #222; font-size: 14px; color: #777;"></div>
<!--<div id="yearday" style="padding: 10px; font-size: 36px; font-weight: bold; margin-top: 30px;">day <?php echo date("z") + 1; ?></div>
<div id="cycle" style="padding: 10px; font-size: 24px; font-weight: bold; ">cycle <?php echo date("W"); ?></div>
<div id="year" style="padding: 10px; font-size: 24px; font-weight: bold; padding-bottom: 30px;">year <?php echo date("o") + 1; ?></div>-->
<div id="birthYear" style="padding: 10px; font-size: 12px; line-height: 21px; font-weight: bold; padding-bottom: 30px;"><?php include 'birthyear.php';?><?php include 'ritualkey.php';?>
</div>
</div>
<div id="styleContainer" style="font-family: Sans-Serif; font-size: 12px; font-style:italic; color: #000; background:#555; text-align: center; padding: 20px;">
  <div id="panelContainer" style="display: none;">
    <div class="panel" style="font-weight: bold;">Elastic Time Legend</div>
    <div id="dayAction" style="padding: 10px;">&nbsp;</div>
    <div id="dayMoment" style="padding: 10px;">&nbsp;</div>
    <div id="nightAction" style="padding: 10px;">&nbsp;</div>
    <div id="nightMoment" style="padding: 10px;">&nbsp;</div>
  </div>
  <div id="detail" style="padding: 10px;"></div>
  <div style="font-weight: bold;">Logistic Time</div>
  <div id="now" style="margin-bottom: 25px;">&nbsp;</div>
  <div id="detail2"></div>
  <div id="out" style=""></div>
  <div><a href="https://calicommons.net/lucluke/DC/content.php?singlePostID=1370"><img src="img/lucluke-logo-web.png" alt="ElasticTime.me by LucLuke" style="width:75px; border:none;"/></a></div>
</div>
</body>
</html>