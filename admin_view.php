<?php
require_once 'db.php';
if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
        $stm = $pdo->prepare(
        "UPDATE doctors
        SET available=IF(available='y','n','y')
        WHERE id = ?
        "
        );
        $stm->execute([$id]);
    }
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
        echo "<script>alert('Invalid Credentials')
        window.location.href='index.php'
        </script>";
        
        exit();
    }
    }
?>
<html>

<a href="book_appointment.php">
    <button>Register Patient</button>
    
</a><br><br>
<a href="register_doctor.php">
    <button>Register Doctor</button>
    
</a>

</html>
<html>
    <head>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
     <link rel="stylesheet" href="admin_view.css">

     <script>
        function chnge(id)
        {
            var btn = document.getElementById("toggle_"+id);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function()
            { 
                if(this.readyState == 4 && this.status == 200)
            {
               btn.classList.toggle("btn-success");
               btn.classList.toggle("btn-warning");

               btn.innerHTML = btn.innerHTML == "y" ? "n" : "y";
            }
}
                xmlhttp.open('GET','admin_view.php?id='+id,true);
                xmlhttp.send();
           
            
        }

// functioon for request view
function view()
{
    
    var card = document.getElementById("crd");
    card.classList.toggle("d-none");
   card.classList.toggle("d-block");
}
// accept 
function accept_req(id)
{
    var patient = document.getElementById("req_"+id);
    patient.classList.remove("btn-warning");
    patient.classList.add("btn-success");
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(this.readyState==4 && this.status==200)
        {
            patient.innerText = 'accepted';
        }
    }
    xmlhttp.open('GET','update_ptdb.php?id='+id,true);
    xmlhttp.send();
}
        

     </script>
     </head>
     <br>
     <button class="btn btn-primary mt-2" onclick="view()">Appointment Requests</button>
     <br>
   <form method="post">
   <button class="btn btn-primary mt-2" type="submit" name="logout">Logout</button>
   </form>
   <br>
   <br>
</html>
 <!-- style  -->

 <!-- card for requests  -->
<html>

<div class="card d-none ml-5" id="crd" style="width: 22rem;">
<div card-header>
    Appointment Requests
</div>
<div class="card-body">
    
    <?php
          $sql = "select * from patients where status = 'pending'";
          $res = $pdo->query($sql);
          if($res->rowCount()>0)
            {
                echo "<table><tr>
                <th>patient_id</th>
                <th>name</th>
                <th>status</th>
                </tr>";
                while($row = $res->fetch())
                  {
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>
                    <button id='req_".$row['id']."'
                class='btn btn-warning'
                onclick='accept_req(".$row['id'].")'>
            ".$row['status']."
        </button>
      </td>";
                    echo "</tr>";
                  }
                  echo "</table>";
            }
            else
                {
                    echo " no results here";
                }
    ?>
    
</div>
<button class="btn btn-outline-info justify-content-center" onclick="view()">close</button>
</div>
</html>

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
        <th>Requirement</th>
        </tr>
        ";
        while($row=$res->fetch())
            {
                echo "<tr>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["gender"]."</td>";
                echo "<td>".$row["blood_group"]."</td>";
                echo "<td>".$row["dob"]."</td>";
                echo "<td>".$row["requirement"]."</td>";
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
                $clss = ($row["available"]=='y')?"btn-success":"btn-warning";
                echo "<tr>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["specialization"]."</td>";
                echo "<td>".$row["fee"]."</td>";
                echo "<td><button id='toggle_".$row['id']."'
                onclick='chnge(".$row['id'].")' class='btn ".$clss."'>"
               .$row["available"]."</button></td>";
            }
            echo "</table>";
           
           
    }
    else{
        echo "no data here...fuck !";
    }
    // dashboard 
    
   

?>

<!-- dynamic requests view -->
<?php

?>

