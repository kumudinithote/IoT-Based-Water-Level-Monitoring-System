<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script async defer type="text/javascript" src="area_latlng.js"></script>


</head>
<body>
  <h3 class="text-primary">Area Details</h3>
<div class=" col-lg-12 content-wrapper">

      <div class="row" id="show">

                    <table class="table table-hover">
                       <thead>
                          <tr class="text-primary">
                             <th>#</th>
                             <th>BuildingId</th>
                             <th>Area_name</th>
                             <th>number_of_tank</th>
                          </tr>
                       </thead>

<?php
include('config.php');

$sql = "Select DISTINCT A.b_id,A.b_name,IFNULL(C.abc,0) as abc FROM building as A LEFT JOIN (SELECT b_id,COUNT(tank_id) as abc from tanks group by (b_id)) as C ON A.b_id";


if (mysqli_query($db, $sql)) {
echo "";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($db);
}
$count=1;
$result = mysqli_query($db , $sql);

if (mysqli_num_rows($result) > 0) {
// output data of each row
while($row = mysqli_fetch_assoc($result)) { ?>
                        <tbody>
                           <tr>
                              <th scope="row">
                              <?php echo $count; ?>
                              </th>
                              <td>
                              <?php echo $row['b_id']; ?>
                              </td>
                              <td>
                              <?php echo $row['b_name']; ?>
                              </td>
                              <td>
                              <?php echo $row['abc']; ?>
                              </td>

                              <td>
                                  <button type="button" class="btn btn-primary" onclick="area(<?php echo $row['b_id']; ?>)">locate tank in <?php echo $row['b_name']; ?></button>
                               </td>
                           </tr>
                        </tbody>
<?php
$count++;
}
} else {
echo "0 results";
}
?>
 </table>
</div>

<div id="map" style="width:100%;height:400px;"></div>

<script type="text/javascript" >
	var map;
  var markers = [];
	var geolocate;
	function init() {
	var mapProp= {
		center: new google.maps.LatLng(42.1048817,-75.9360608),
		zoom:13,
	};
	map = new google.maps.Map(document.getElementById("map"),mapProp);
	var geolocate = new google.maps.LatLng(42.1048817,-75.9360608);

	var marker = new google.maps.Marker({
                        position: geolocate,
                        map: map,
                        title: 'Current Location',
                        icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png'
                      });

	google.maps.event.addListener(marker, 'click', function() {
									      infowindow.setContent('Current Location');
									      infowindow.open(map, this);
									    });
	}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAkCxbsl5ujOb2B1IkdGQoJ0Fsk97uyEQ &callback=init"></script>



        </div>
</div>
</body>
</html>
