<?php
if(isset($_POST['submit'])){
    $labname = $_POST['labname'];
    $series = $_POST['series'];
    $myfile = fopen($labname.".txt", "w");
    $i = 0;
    for($i=1;$i<=255;$i++){
        $txt = $series.".".(string)$i."\n";
        echo $txt;
        fwrite($myfile, $txt);    
    }
    fclose($myfile);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ping</title>
</head>
<body>
    <form action="index.php" method="POST">
        LabName:<input type="text" name="labname" id="labname"><br>
        IPRange<input type="text" name="series" id="series"><br>
        <input type="submit" value ="submit" name = "submit">
    </form>
</body>
</html>