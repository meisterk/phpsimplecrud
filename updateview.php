<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP: Simple-CRUD</title>
</head>

<body>
    <h1>PHP: Simple-CRUD</h1>
    <h2>UpdateView</h2>

    <?php 
        $id = $_GET['id'];

        try {
            // Connection to database
            $user = 'cruduser';
            $password = '123';     
            $db = new PDO('mysql:host=localhost;dbname=cruddb', $user, $password);

            // READ
            $sql = 'SELECT * FROM schueler WHERE id = ' . $id;
            $stmt = $db->prepare($sql); 
            $stmt->execute(); 
            $row = $stmt->fetch();
            $vorname = $row['vorname'];
            $nachname = $row['nachname'];
            $db = null;
        } catch(PDOException $e){
            echo 'ERROR!<br>';
            echo $e; //->getMessage();
        }
    ?>

    <form action="index.php" method="post">
        <label for="inputVorname">Vorname</label>
        <input type="text" name="vorname" id="inputVorname" value="<?php echo $vorname ?>">

        <label for="inputNachname">Nachname</label>
        <input type="text" name="nachname" id="inputNachname" value="<?php echo $nachname ?>">

        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <button>Save</button>

        <a href="index.php">Cancel</a>
    </form>
</body>

</html>