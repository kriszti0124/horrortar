<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lilita One">
    <title>Regisztráció</title>
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
        .blood{
            text-align:center;
            padding-top:0px;

        }
      #saw{
        text-align:left;
        width:100px;
        height:50px;
      }
      
        
    </style>
</head>
<body>
    <h2>Regisztráció</h2>
   
        <div id='saw'>
            <!-- <img src="saw.png" alt="furesz">  -->
        </div>
 
    <form action="reg_ir.php" method="POST" target="kisablak">
        <label for="email">Email:</label>
        <input type="email" id="email" name="umail" >

        <label for="felhasznalonev">Felhasználónév:</label>
        <input type="text" id="becenev" name="unick" >
        
        <label for="jelszo">Jelszó:</label>
        <input type="password" id="jelszo" name="upw" maxlength="8" minlength="4" >
        
        <label for="szuldatum">Születési dátum:</label>
        <input type="date" id="szuldatum" name="uszuldatum" >
        
        <input type="submit" value="Regisztrálás">
       
    </form>
    <div class="blood">
    <img src="blood.png" alt="blood">
    </div>
    
</body>
</html>
