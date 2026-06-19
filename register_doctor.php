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

     <label >specialization </label>
     <input type="text" name="specialization" placeholder="enter specialization feild" required><br>


     <label >Fee(rs) </label>
     <input type="number" name="fee" placeholder="enter fee" required><br>
     <label >Available</label>
     <select name="available" required>
        <option value="y">Y</option>
        <option value="N">N</option>
     </select>
     <br><br>
     <input type="submit">

    </form>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=='POST'){
 
if(isset($_POST["name"],$_POST["available"]))
    {
        try{
        // insert in db
          $stmt = $pdo->prepare(
            "INSERT INTO doctors
            (name, specialization , fee , available)
             VALUES (?,?,?,?);"
          );
          $stmt->execute([$_POST["name"],$_POST["specialization"],$_POST["fee"],$_POST["available"]]);
          echo "<script>
alert('Doctor registered successfully');
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
