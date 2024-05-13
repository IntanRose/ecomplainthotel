<?php
include 'db.php';

if (isset($_POST['data'])){
  $data = json_decode($_POST['data'],true);
  $aduan = $data['aduan'];
  $date = $data['date'];
  $time = $data['time'];
  $place = $data['place'];
  $hotelstaffid = $data['hotelstaffid'];
  $hotelcustomerid = $data['hotelcustomerid'];

  $sql = "INSERT INTO ecomplaint (aduan, `date`, `time`, place, hotelstaffid, hotelcustomerid)
VALUES ('$aduan', '$date', '$time', '$place', '$hotelstaffid', '$hotelcustomerid')";

if ($conn->query($sql) === TRUE) {
  echo "Complaint successfully Issued";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

}

$conn->close();

?>