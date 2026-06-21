
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <h2 >This is Admin pannel</h2>
    <h3 >Login as an Admin</h3>
    <form class=" w-25 border mx-auto justify-content-md-center p-5" action="admin_view.php" method="post">

     <div class=" mb-2">
  <label  class="form-label">email</label>
  <input name="email" type="text" class="form-control mt-1" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
</div> 
<div class="mb-2">
    <label class="form-label">password</label>
    <input class="form-control mt-1" type="password" name="password" placeholder="enter password">
    </div>
    <input class="btn btn-primary mt-2"type="submit">
    </form>
</body>
</html>
