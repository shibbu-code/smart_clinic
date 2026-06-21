<?php
require_once 'db.php';
if(isset($_POST["logout"]))
    { 
        header("Location:admin.php");
        exit();
    }
require_once "db.php";
// verify
if(isset($_POST["email"],$_POST["password"]))
    {
$stmt = $pdo->prepare(
"SELECT * FROM users where email = ? AND password_h = ?"
);
$stmt->execute(
    [$_POST["email"],
    $_POST["password"]]
    );

$user = $stmt->fetch();
if($user)
    {
        echo "Login succesfull"."<br>";
        echo "welcome ".$user["name"];
       
    }
    else{
        echo "error";
    }
    }
?>
<html>

<a href="register_patient.php">
    <button>Register Patient</button>
    
</a><br><br>
<a href="register_doctor.php">
    <button>Register Doctor</button>
    
</a>

</html>
<html>
    <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
   <form method="post">
   <button class="btn btn-primary" type="submit" name="logout">Logout</button>
   </form>
   <br>
   <br>
</html>
 <!-- style  -->

<style>
table {
    border-collapse: collapse;
    width: 80%;
    
    font-family: Arial, sans-serif;
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

th {
    background-color: #4CAF50;
    color: white;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}
</style>
<?php
echo "<h2>registered Patients</h2>";
$stmt = 
    "SELECT * FROM patients";

$res = $pdo->query($stmt);
if($res->rowCount() >0)
    {
        echo "<table>
        <tr> 
        <th>Name</th>
        <th>Gender</th>
        <th>Blood_group</th>
        <th>DOB</th>
        </tr>
        ";
        while($row=$res->fetch())
            {
                echo "<tr>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["gender"]."</td>";
                echo "<td>".$row["blood_group"]."</td>";
                echo "<td>".$row["dob"]."</td>";
            }
           echo"</table>";
         
    }
    else{
        echo "no data here...";
    }

    //  doctors 
     echo "<br><br>";


?>
<html>
<h2>Doctors details</h2>
</html>
<?php
$stmt = 
    "SELECT * FROM doctors";

$res = $pdo->query($stmt);
if($res->rowCount() >0)
    {
        echo "<table>
        <tr> 
        <th>name</th>
        <th>specialization</th>
        <th>fee</th>
        <th>available</th>
        </tr>
        ";
        while($row=$res->fetch())
            {
                echo "<tr>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["specialization"]."</td>";
                echo "<td>".$row["fee"]."</td>";
                echo "<td>".$row["available"]."</td>";
            }
            echo "</table>";
           
           
    }
    else{
        echo "no data here...fuck !";
    }
    // dashboard 
    
   

?>
<!-- for doctor list -->

