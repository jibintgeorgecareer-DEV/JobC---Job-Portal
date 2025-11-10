
    			<option value="">-- Select Place --</option>
   				<?php
				include( "../Connection/connection.php");
$sql = "SELECT * FROM tbl_place where district_id='".$_GET['did']."'";
$result = $con->query($sql);
    while($row = $result->fetch_assoc()) {
 ?>
 <option value=<?php echo $row["place_id"] ?>><?php echo $row["place_name"]?></option>
  <?php
	}
    ?>