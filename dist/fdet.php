<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stocks</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <?php require_once('../include/st.php'); ?>

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
    $mysqli = new mysqli('localhost', 'root', '', 'ims') or die(mysqli_error($mysqli));
    $result = $mysqli->query("select * from stocks") or die($mysqli->error);
    //pre_r( $result );
    ?>

    <div class="justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>P_id</th>
                    <th>P_name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>W_name</th>
                    <th>Movedin_date</th>
                    <th>Expiry_date</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

            <?php 
            while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['p_id']; ?></td>
                <td><?php echo $row['p_name']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['w_name']; ?></td>
                <td><?php echo $row['movedin_date']; ?></td>
                <td><?php echo $row['expiry_date']; ?></td>
                <td>
                    <a href="../dist/stocks.php?edit=<?php echo $row['p_id']; ?>"
                        class="btn btn-info">Edit</a>
                    <a href="../include/st.php?delete=<?php echo $row['p_id']; ?>"
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



    <h3 class="h3">Stocks Details</h3>
        <div class="justify-content-center">
        <form action="../include/st.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>" >
            <div class="form-group">
                <label>P_id: </label>
                <input type="text" name="pid" class="form-control" value="<?php echo $pid; ?>">
            </div>
            <div class="form-group">
                <label>P_name: </label>
                <input type="text" name="pname" class="form-control" value="<?php echo $pname; ?>">
            </div>
            <div class="form-group">
                <label>Price: </label>
                <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
            </div>
            <div class="form-group">
                <label>Quantity: </label>
                <input type="text" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
            </div>
            <div class="form-group">
                <label>W_name: </label>
                <input type="text" name="wname" class="form-control" value="<?php echo $wname; ?>">
            </div>
            <div class="form-group">
                <label>Movedin_date: </label>
                <input type="date" name="midate" class="form-control" value="<?php echo $midate; ?>">
            </div>
            <div class="form-group"> 
                <label>Expiry_date: </label>
                <input type="date" name="expdate" class="form-control" value="<?php echo $expdate; ?>">
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





