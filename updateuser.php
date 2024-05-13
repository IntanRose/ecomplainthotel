<?php

print_r($_POST);

include 'db.php';

if(isset($_POST['data']) and isset($_POST['op'])){
    if ($_POST['op']=='update'){
        //Prepare data from apps into array
        $jsonobj = $_POST['data'];
        $arr = json_decode($jsonobj, true);
        $uid = $arr["uid"];
        $email = $arr["email"];
        $provider = $arr["provider"];
        $fullname = $arr["name"];
        $dob = $arr["dob"]; 
        $weight = $arr["weight"];
        $height = $arr["height"];

        //Check if record exists
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            //If Exist, Update
            $sql = "UPDATE user
            SET uid='$uid', provider='$provider', fullname='$fullname', dob='$dob', weight='$weight', height='$height' WHERE email='$email'";

            if ($conn->query($sql) === TRUE) {
                echo "Update record successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else {
            //Record does not exist, create new
            $sql = "INSERT INTO user (uid, email, provider, fullname, dob, weight, height) VALUES ('$uid', '$email', '$provider', '$fullname', '$dob', '$weight', '$height')";

            if ($conn->query($sql) === TRUE) {
                echo "Update record successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

    }
    else if($_POST['op']=='check'){
        $email = $_POST['data'];
        $sql = "SELECT * FROM user WHERE email ='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $data = array();
            while($row = $result->fetch_assoc()) {
                $data['name']=$row['fullname'];
                $data['dob']=$row['dob'];
                $data['weight']=$row['weight'];
                $data['height']=$row['height'];
            }
            echo json_encode($data);
        } else {
            echo "User Not Found";
        }

    }
    else {
        echo "Error: operation not defined";
    }

}
else {
    echo "Error: Post data not received";
}

$conn->close();
?>