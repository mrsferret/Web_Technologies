<php
 $summer= "July-Aug";
 $winter= "Jan-Feb";
 $temperature = array("summer_low" =>11, "summer_high" =>19, "winter_low" =>1, "winter_high" =>7);
	   
echo "<table  class=\"table table-condensed\">
 <tr>
  <h1>Average Temperature in Edinburgh</h1>
 </tr>
 
 <tr>
  <th>Month</th>
  <th>High</th>
  <th>Low</th>
 </tr>

 <tr>
  <th>$summer</th>
  <th>" . $temperature['summer_high'] . " ℃</th>
  <th>" . $temperature['summer_low'] . " ℃</th>
 </tr>

 <tr>
  <th>"$winter/th>
  <th>" . $temperature['winter_high'] . " ℃</th>
  <th>"" . $temperature['winter_low'] . " ℃</th>
 </tr>
</table>";
?>	