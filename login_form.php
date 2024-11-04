<form action='login_ir.php' method='post' target='kisablak'>
    <input  name='email'                 placeholder='email cím'><br>
    <input  name='pw' type='password'    placeholder='jelszó'><br>
    <input            type='submit'      placehorder='Belépés'><br>

</form>


<div class="regisztracio">
    <input type='button' value='Regisztráció' onclick='location.href="./?p=regisztracio"'>
</div>
<style>
  body{
        
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to top, #bf1d17, #42100f); 
            margin: 0;
            padding: 20px;
    }
    form {
            background-color: rgb(80, 73, 73);
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        input[type="button"] {
            
            background-color:black; 
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            padding: 10px; 
            
        }
        .regisztracio{
            text-align:center;
        }
</style>