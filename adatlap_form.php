<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lilita One">
    <title>Adatlap</title>
</head>
<body>
    <h2>Adatlap</h2>
<?php
       $user = mysqli_fetch_array(mysqli_query($adb , "SELECT * FROM user WHERE uid='$_SESSION[uid]'"));
?>

    

    
    <form action='adatlap_ir.php' method='post' target='kisablak' class='reglog' enctype='multipart/form-data' id='adatlap'>
    <input type='hidden' name='uid' value='<?=$user['uid']?>'>

    <label for='Email'>Email: </label>
    <input type='text' name='umail' value='<?=$user['umail']?>'>
    <br>
    <br>

    <label for='felhasznalonev'>Felhasználónév: </label>
    <input type='text' name='unick' value='<?=$user['unick']?>'>
    <br>
    <br>

    <label for='szuldatum'>Születési dátum: </label>
    <input type='date' name='uszuldatum' value='<?=$user['uszuldatum']?>'>
    <br>
    <br>

   
    <label for='profkep'>Új profilkép: </label>
    <input type='file' name='profkep'>
    <br>
    <br>


    <input type='submit' value='Adatok módosítása'>
</form>

<h2>Jelszómódosítás</h2>
<form action='adatlap_ir.php' method='post' target='kisablak' class='reglog' enctype='multipart/form-data' id='jelszomodositas'>
<label for='jelszo'>Új jelszó: </label>
    <input type='password' name='upw' maxlength='8' minlength='4'>
    <br>
    <br>
    <label for='jelszo'>Új jelszó megint: </label>
    <input type='password' name='upw' maxlength='8' minlength='4'>
    <br>
    <br>
    <label for='jelszo'>Mostani jelszó: </label>
    <input type='password' name='upw' maxlength='8' minlength='4'>
    <br>
    <br>

    <input type='submit' value='Jelszó módosítása'>


</body>
<style>
     body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to top, #bf1d17, #42100f); 
            margin: 0;
            padding: 20px;
        }
        h2 {
            font-family:"Lilita One";
            font-size: 50px;
            text-align: center;
            color: white; 
        }
        form {
            text-align:center;
            background-color: rgb(80, 73, 73);
            max-width: 400px;
            margin:auto; 
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: white;
        }
        input {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid black; 
            border-radius: 5px;
            transition: border-color 0.3s;
            background-color: rgb(255, 255, 255);
        }
        input:focus {
            border-color: grey; 
            outline: none;
        }
        input[type="submit"] {
            background-color:black; 
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            padding: 10px;
            
        }
        input[type="submit"]:hover {
            background-color: rgb(153, 82, 82); 
        }
        
</style>
</html>














