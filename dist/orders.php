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
<script src="../script.js"></script>
</head>
<body>
    <?php require_once('../include/od.php'); ?>

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
    $result = $mysqli->query("select * from orders") or die($mysqli->error);
    //pre_r( $result );
    $total = $mysqli->query("SELECT invoice, SUM(subtotal) as total FROM orders GROUP BY invoice;")
    ?>

    <div class="justify-content-center">
        <h3>Order Details</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Invoice</th>
                    <th>Date</th>
                    <th>Fname</th>
                    <th>Quantity</th>
                    <th>Fprice</th>
                    <th>Subtotal</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

            <?php 
            while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['invoice']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['fname']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['fprice']; ?></td>
                <td><?php echo $row['subtotal']; ?></td>
                <td>
                    <a href="../dist/orders.php?edit=<?php echo $row['id']; ?>"
                        class="btn btn-info">Edit</a>
                    <a href="../include/od.php?delete=<?php echo $row['id']; ?>"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>

<div class="justify-content-center">
    <h3>Order Total</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <?php 
                    while($row = $total->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['invoice']; ?></td>
                        <td><?php echo $row['total']; ?></td>
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



    <h3 class="h3">Orders</h3>
        <div class="justify-content-center">
        <form action="../include/od.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>" >
            <div class="form-group">
                <label>Invoice: </label>
                <input type="text" name="invoice" class="form-control" value="<?php echo $invoice; ?>">
            </div>
            <div class="form-group">
                <label>Date: </label>
                <input type="date" name="date" class="form-control" value="<?php echo $date; ?>">
            </div>
            <div class="form-group">
                <label>Food Name: </label>
                <select name="fname">
                    <?php
                    while($rows = $resultset->fetch_assoc())
                    {
                        $fname = $rows['fname'];
                        echo "<option value='$fname'>$fname</option>";
                    }
                    ?>

                </select>
            </div>
            <div class="form-group">
                <label>Quantity: </label>
                <input type="text" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
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
    
</body>
</html>

