<?php
include 'db.php';
if(isset($_POST['stid'])){
$stid = $_POST['stid'];
$sql = "SELECT 
user.Hotelcustomerid AS Hotelcustomerid, hotelstaff.hotelstaffname AS hotelstaffname, ecomplaint.aduan AS aduan, ecomplaint.date AS tarikh, ecomplaint.time AS masa, ecomplaint.place AS tempat
FROM
hotelstaff
JOIN ecomplaint
ON hotelstaff.hotelstaffid=ecomplaint.hotelstaffid
JOIN user
ON user.customerid=ecomplaint.customerid 
WHERE customerhotelid='$stid'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $data[]=['aduan' => $row['aduan']];
    $data[]=['tarikh' => $row['tarikh']];
    $data[]=['masa' => $row['masa']];
    $data[]=['tempat' => $row['tempat']];
  }
  $str = json_encode($data);
  $str = trim($str,'[]');
  $str = str_replace('{','',$str);
    $str = str_replace('}','',$str);
    $str = '{'.$str.'}';
  echo $str;
} else {
  echo "0 results";
}
}
$conn->close();
?>