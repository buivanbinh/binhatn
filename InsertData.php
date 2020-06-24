<!DOCTYPE html>
<html>

<head>
    <title>ANTStore</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        li {
            list-style: none;
        }
    </style>
    <link rel="stylesheet" href="css/insert.css">
</head>

<body>
    <div class="Insertbase">
        <h1>ATN Store</h1>
        <h2>INSERT DATA TO DATABASE</h2>
        <h2>Enter data into table</h2>
        <ul>
            <li><a href="index.php"><i class="fa fa-shopping-basket"></i>Home</a></li>
            <li><a href="InsertData.php">Insert</a></li>
            <li><a href="#">Cart</a></li>
        </ul> 
        <ul>
            <form name="InsertData" action="InsertData.php" method="POST">
                <li>ID:</li>
                <li><input type="text" name="id" /></li>
                <li>Name:</li>
                <li><input type="text" name="name" /></li>
                <li>Price:</li>
                <li><input type="text" name="price" /></li>
                <li><input type="submit" value="Submit" /></li>
            </form>
        </ul>
        
    </div>
  




</body>

</html>

<?php

if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
         "host=
ec2-54-211-210-149.compute-1.amazonaws.com
;port=5432;user=kmjjrpdgkylzur;password=1aa00070fbe552f02e73162031030aff5170c18bf6fa1a0bf3d05603fce4e5d9;dbname=dbq255b4fs6nga
",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

if($pdo === false){
     echo "ERROR: Could not connect Database";
}

//Khởi tạo Prepared Statement
//$stmt = $pdo->prepare('INSERT INTO student (stuid, fname, email, classname) values (:id, :name, :email, :class)');

//$stmt->bindParam(':id','SV03');
//$stmt->bindParam(':name','Ho Hong Linh');
//$stmt->bindParam(':email', 'Linhhh@fpt.edu.vn');
//$stmt->bindParam(':class', 'GCD018');
//$stmt->execute();
//$sql = "INSERT INTO student(stuid, fname, email, classname) VALUES('SV02', 'Hong Thanh','thanhh@fpt.edu.vn','GCD018')";
$sql = "INSERT INTO product(id, name, price)"
        . " VALUES('$_POST[id]','$_POST[name]','$_POST[price]')";
$stmt = $pdo->prepare($sql);
//$stmt->execute();
 if (is_null($_POST[id])) {
   echo "ID must be not null";
 }
 else
 {
    if($stmt->execute() == TRUE){
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: ";
    }
 }
?>
</body>
</html>
