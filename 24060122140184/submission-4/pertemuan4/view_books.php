<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>

    <div class="container">
    <div class="card mt-5">
        <div class="card-header">Books Data</div>
        <div class="card-body">

            <table class="table table-striped">
                <tr>
                    <th>No</th>
                    <th>ISBN</th>
                    <th>Author</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>

                <?php

                require_once('lib/db_login.php');
                $query = "SELECT * FROM books ORDER BY isbn";
                $result = $db->query($query);

                if(!$result){
                    die ("could not query the database : <br />".$db->error ."<br>Query: ".$query);
                }

                $i = 1;
                while ($row = $result->fetch_object()){
                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td>'.$row->isbn.'</td>';
                    echo '<td>'.$row->author.'</td>';
                    echo '<td>'.$row->title.'</td>';
                    echo '<td>$'.$row->price.'</td>';
                    echo '<td><a class="btn btn-warning btn-sm" href="show_cart.php?id='.$row->isbn.'">Add to Cart</a></td>';
                    echo '</tr>';
                    $i++;
                }

                echo '</table>';
                echo '<br />';
                echo 'Total Rows = '.$result->num_rows;
                $result->free();
                $db->close();
                ?>
            </table>
        </div>
    </div>
    </div>
</body>
</html>