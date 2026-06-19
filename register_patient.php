<?php
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">

     <label >Name </label>
     <input type="text" name="name" placeholder="enter name" required><br>

     <label >DOB </label>
     <input type="date" name="dob" placeholder="enter date" required><br>

     <label >Gender </label>
     <select name="gender" required>
        <option value="M">M</option>
        <option value="F">F</option>
     </select><br>
     <!-- bg -->

    <label for="bloodGroup">Blood Group:</label>
<select id="bloodGroup" name="blood_group" required>
    <option value="">Select Blood Group</option>
    <option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
</select><br>

     <label >Phone Number </label>
     <input type="text" name="phone" placeholder="enter contact number" required><br>
     <label >Address</label>
     <input type="text"  name="address" placeholder="enter valid address" required>
     <br><br>
     <input type="submit">

    </form>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=='POST'){
 
if(isset($_POST["name"],$_POST["phone"]))
    {
        try{
        // insert in db
          $stmt = $pdo->prepare(
            "INSERT INTO patients
            (name, dob, gender, blood_group, phone, address)
             VALUES (?,?,?,?,?,?);"
          );
          $stmt->execute([$_POST["name"],$_POST["dob"],$_POST["gender"],$_POST["blood_group"],$_POST["phone"],$_POST["address"]]);
          echo "<script>
alert('Patient registered successfully');
window.location.href='admin_view.php';
</script>";
         exit();
        
        }
        catch(Exception $e)
        {
            echo "<script>alert('error in inserting values')</script>";
            echo $e;
}
        }
    }


?>
