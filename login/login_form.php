<form action='login_ir.php' method='post' target='kisablak'>

    <label for="email">Email cím:</label>
    <input  name='email'>

    <label for="jelszo">Jelszó:</label>
    <input  name='pw' type='password' maxlength="8" minlength="4" >

    <input type="submit" value="Belépés">

    <div class="regisztracio">
        <input type='button' value='Regisztráció' onclick='location.href="./?p=regisztracio"'>
    </div>


</form>



<style>
    body {
        background-image: url(horror.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        font-family: 'Arial', sans-serif;
        /* background: linear-gradient(to top, #bf1d17, #42100f);  */
        margin: 0;
        padding: 20px;
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
            background-color: rgb(135, 178, 169); 
    }

    .regisztracio {
        text-align:center;
        width: 100px;
    }
</style>