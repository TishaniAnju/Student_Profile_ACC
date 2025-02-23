<?php
    require_once("dbAccess.php");
	$db = new DBOperations();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
    <title>Position Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <div class="container">
                        <h2 class="pull-left">Position Details</h2>
                        <br><br><br>
                        <h4 class="left"><a href="addpositions.php">Add</a></h4>
                        <br>
                        <?php
                            $query = "SELECT * FROM positions";
                            $result = $db->executeQuery($query);
                        ?>
                        <?php
                            if (mysqli_num_rows($result) > 0) {
                        ?>

                        <table class="table table-bordered" style="width:500px;">
                            <tr>
                                <th>id</th>
                                <th>position</th>
                                <th>Postition Name</th>
                                <th></th>
                            </tr>
                            <?php
                                $i=0;
                                while($row = mysqli_fetch_array($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row["id"]; ?></td>
                                <td><?php echo $row["position"]; ?></td>
                                <td><?php echo $row["p_name"]; ?></td>
                                <td>
                                    <a href="editpoistions.php?id=<?php echo $row["id"]; ?>">Update</a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="deletePositions.php?del=<?php echo $row["id"]; ?>" onclick="return confirm('Please confirm to DELETE this Data?')">Delete</a>
                                </td>
                            </tr>
                            <?php
                                $i++;
                                }
                            ?>
                        </table>

                            <?php
                                }else{
                                    echo "No result found";
                                }
                            ?>

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
