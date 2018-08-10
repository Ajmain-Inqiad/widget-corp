<!DOCTYPE html>
<html>
    <head>
        <title>Widget Corp</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css">
        <script src="stylesheets/jquery.min.js"></script>
		<script src="stylesheets/jquery-2.1.1.min.js"></script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYRKN2Ws4VtVfD6V5HYiddvlcxsv8CODM">
        </script>
    </head>
   
    <body>
       <div id="header">
			<h1 style="text-align:left; padding-top:1em; margin:0">Widget Corp</h1>
		</div>
		<p><a href="index.php">&laquo; Main Page</a></p>
			<div id="googleMap" style="width:70%;height:500px; margin:1em 0em 1em 0em; padding-left:15%; float:left"></div>

        <div id="footer" style="height:50px">
			<a href="form.php" target="_blank" style="color:powderblue">Drop Your CV here </a><br/>
			Copyright <?php echo date("Y"); ?>, Widget Corp
		</div>
		
		
        <script>
            var myCenter=new google.maps.LatLng(23.78017,90.40719);

			function initialize() {
			  var mapProp = {
				center:myCenter,
				zoom:9,
				mapTypeId:google.maps.MapTypeId.RoadMap
			  };
			var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

			var marker_build_1=new google.maps.Marker({
			  position:new google.maps.LatLng(23.78017,90.40719)
			});

			marker_build_1.setMap(map);
			var infowindow1 = new google.maps.InfoWindow({
			  content:'Office building'
			});
			google.maps.event.addListener(marker_build_1, 'click', function() {
			  infowindow1.open(map,marker_build_1);
			});
			}
			google.maps.event.addDomListener(window, 'load', initialize);
		</script>
        
    </body>
</html>

		
		
		