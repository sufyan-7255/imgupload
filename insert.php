
<?php
include("connection.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Upload</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="productnameinput" placeholder="Enter product name" class="form-control" required>
                <br> 
                <input type="text" name="productpriceinput" placeholder="Enter product price" class="form-control" required>
                <br> 
                <input type="file" name="productimageinput" class="form-control" required>
                <br><br>
                <button type="submit" name="addbtn" class="btn btn-success">Add Product</button>
            </form>
        </div>
    </div>
    <br><br>

    <table class="table table-hover table-bordered">
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>PRICE</th>
            <th>IMAGE</th>
            <th>ACTION</th>
        </tr>


        <?php
        $selectquery = "select * from producttbl";
        $selectqueryconnect = mysqli_query($con, $selectquery);
        while($r = mysqli_fetch_array($selectqueryconnect))
        {
            ?>
            <tr>
                <td><?php echo $r["id"]?></td>
                <td><?php echo $r["productname"]?></td>
                <td><?php echo $r["productprice"]?></td>
                <td><img src="<?php echo $r["productimg"]?>" alt="product-image" style = "height:50px;"></td>
                <td><a href="delete.php?pid=<?php echo $r["id"]?>" class= "btn btn-danger">Delete</a></td>
            </tr>
            <?php
        }
        ?>

    </table>
    
</div>
     


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<?php
if(isset($_POST["addbtn"]))
{
    $productname = $_POST["productnameinput"];
    $productprice = $_POST["productpriceinput"];
    $filename = $_FILES["productimageinput"]["name"];
    $tmpname = $_FILES["productimageinput"]["tmp_name"];
    $location = "images/";
    $saveimg = $location.$filename;
    if(move_uploaded_file($tmpname,$saveimg))
    {
        $insertquery = "insert into producttbl(productname, productprice, productimg) values ('".$productname."', '".$productprice."', '".$saveimg."')";
        $insertqueryconnect = mysqli_query($con,$insertquery);
        // if($insertqueryconnect)
        // {
        //     echo "Record inserted";
        // }
        // else
        // {
        //     echo "Nt inserted";
        // }
    }

}
?>

</body>
</html>