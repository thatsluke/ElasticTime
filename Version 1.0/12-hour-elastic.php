<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=500" />
<meta property="og:url" content="https://elastictime.me" />
<meta property="og:type" content="app" />
<meta property="og:title" content="Try the Personal Elastic Time clock! - 12 Moments Day / 12 Moments Night" />
<meta name="author" content="Luc Amstrong">
<meta property="og:description"  content="What would make time feel better to you? Who designed our clocks?  What impact does this simple clock have on our lives?" />
<meta property="og:image" content="https://elastictime.me/screenshot.png" />

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
  var moments = 12;
  var ms = 1440 * 60 * 1000;
  var dawn = begin * 60 * 1000;
  var dusk = end * 60 * 1000;
  var day = false;
  var now = new Date();
  // var midnight = now.setHours(0,0,0,0);
  var midnight = moment().startOf("day").toDate();
  var day, currentMoment;

  var options = { weekday: "long", year: "numeric", month: "short",  day: "numeric", hour: "2-digit", minute: "2-digit" };  
  var currentMs = now - midnight;
  var dayMs = dusk - dawn;
  var nightMs = ms - dayMs;

  if (currentMs >= dawn && currentMs <= dusk) {
    day = true;
    var msPastDawn = currentMs - dawn;
    var percentOfDayPast = msPastDawn / dayMs;
    var currentMoment = percentOfDayPast * moments;
    var momentOnly = Math.floor(currentMoment);
    var actionOnly = Math.floor(currentMoment * 10) % 10;
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
    var momentOnly = Math.floor(currentMoment);
    var actionOnly = Math.floor(currentMoment * 10) % 10;
  }
  document.getElementById('now').innerHTML = now.toLocaleTimeString("en-us", options);
  document.getElementById('day').innerHTML =  (day ? "Day Phase" : "<span style='color:#555'>Night Phase</span>");
  document.getElementById('moment').innerHTML =  momentOnly;
  document.getElementById('action').innerHTML =  "action " + actionOnly;
  document.getElementById('detail').innerHTML =  "( ! ) this exact moment is fleeting ( ! )</br><span style='display:inline-block; width:175px; text-align:center;'>" + currentMoment + "</span></br></br>";
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
<div style="position: relative; margin: 0 auto;color: #ccc; background: #000; border-radius: 0 0 10px  10px ; padding: 10px; text-align: center; font-family: Sans-Serif; font-size: 26px; letter-spacing: 3px; width: 200px; ">moment</div>
<div id="moment" style="text-align: center; font-family: Sans-Serif; font-size: 160px; font-weight:bold;color: #ccc;">&nbsp;</div>
<div id="container" style="text-align: center; font-family: Sans-Serif; background: #000; color: #777;">
<div id="action" style="padding: 10px; font-size: 50px; font-weight: bold;">&nbsp;</div>
<div id="day" style="padding: 10px; font-size: 14px; border-top: 1px solid #555; border-bottom: 1px solid #555;  margin: 10px; font-weight:bold; font-style:italic;">&nbsp;</div>
<div id="yearday" style="padding: 10px; font-size: 36px; font-weight: bold; margin-top: 30px;">day <?php echo date("z") + 1; ?></div>
<div id="cycle" style="padding: 10px; font-size: 24px; font-weight: bold;">cycle <?php echo date("W"); ?></div>
<div id="detail" style="margin-top: 60px; padding-bottom: 60px; font-size: 12px; font-style:italic; color: #777;"></div>
</div>
<div style="font-family: Sans-Serif; font-size: 12px; font-style:italic; color: #000; background:#777; text-align: center; padding: 20px; ">
<div>Logistic Time</div>
<div id="now" style="margin-bottom: 25px;">&nbsp;</div>
<div id="detail2"></div>
<div id="out" style=""></div>
<div><a href="https://calicommons.net/lucluke/DC/content.php?singlePostID=1370"><img src="lucluke-logo-web.png" alt="ElasticTime.me by LucLuke" style="width:75px; border:none;"/></a></div>
</div>
</body>
</html>
