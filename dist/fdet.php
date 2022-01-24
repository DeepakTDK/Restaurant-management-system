<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Details</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <?php require_once('../include/fd.php'); ?>

    <?php
    if(isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
    </div>
    <?php endif ?>
    <div class="container">
    <?php 
    $mysqli = new mysqli('localhost', 'root', '', 'restaurant ms') or die(mysqli_error($mysqli));
    $result = $mysqli->query("select * from food_items") or die($mysqli->error);
    //pre_r( $result );
    ?>

    <div class="justify-content-center">
        <h3><u>Food Details</u></h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Food Name</th>
                    <th>Price</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

            <?php 
            while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['fprice']; ?></td>
                <td>
                    <a href="../dist/fdet.php?edit=<?php echo $row['id']; ?>"
                        class="btn btn-info">Edit</a>
                    <a href="../include/fd.php?delete=<?php echo $row['id']; ?>"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>


<?php   
    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
?>



    <h3 class="h3"><u>Food</u></h3>
        <div class="justify-content-center">
        <form action="../include/fd.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>" >
            <div class="form-group">
                <label>ID: </label>
                <input type="text" name="id" class="form-control" value="<?php echo $id; ?>">
            </div>
            <div class="form-group">
                <label>Food Name: </label>
                <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
            </div>
            <div class="form-group">
                <label>Price: </label>
                <input type="text" name="fprice" class="form-control" value="<?php echo $fprice; ?>">
            </div>
            <div class="form-group">
                <?php 
                    if($update == true):
                ?>
                <button type="submit" class="btn btn-info" name="update">Update</button>
                <?php else: ?>
                <button type="submit" class="btn btn-primary" name="save">Save</button>
                <?php endif; ?>
            </div>            
        </form>
        </div>
</div>
    
</body>
</html>

