<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP: Simple-CRUD</title>
</head>

<body>
    <h1>PHP: Simple-CRUD</h1>
    <h2>ListView</h2>

    <table border="1">
        <tr>
            <th>Index</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>Action</th>
        </tr>

        <?php 
        try {   
            // Connection to database
            $user = 'cruduser';
            $password = '123';     
            $db = new PDO('mysql:host=localhost;dbname=cruddb', $user, $password);
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $vorname = $_POST["vorname"];
                $nachname = $_POST["nachname"];

                if($_POST['action'] === 'create'){
                    // CREATE            
                    $sql = "INSERT INTO schueler
                    SET vorname = '" . $vorname . "',
                        nachname = '" . $nachname . "';";
                }

                if($_POST['action'] === 'update'){
                    // UPDATE            
                    $id = $_POST['id'];
                    $sql = "UPDATE schueler
                    SET vorname = '" . $vorname . "',
                        nachname = '" . $nachname . "
                        ' WHERE id = " .$id;
                }
                
                $db->exec($sql);
            }

            // DELETE
            if(isset($_GET['id'])){               
                $id =$_GET['id'];             
                
                $sql = "DELETE FROM schueler
                        WHERE id = " . $id . ";";                            
                $db->exec($sql);
            }

            // READ
            $sql = 'SELECT * FROM schueler';
            foreach ($db->query($sql) as $row) {    
                $id = $row['id'];
                $vorname = $row['vorname'];
                $nachname = $row['nachname'];

                $htmlRow = '<tr><td>' . $id .
                 '</td><td>' . $vorname .
                  '</td><td>' . $nachname . 
                   '</td><td><a href="index.php?id=' . $id . '">Delete</a>
                   <a href="updateview.php?id=' . $id . '">Update</a></td><tr>';
                echo $htmlRow;
            }

            $db = null;
        } catch(PDOException $e){
            echo 'ERROR!<br>';
            echo $e; //->getMessage();
        }
    ?>

    </table>
    <a href="createview.html">New</a>
</body>

</html>