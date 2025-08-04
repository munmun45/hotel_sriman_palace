<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <style>
        * {
            margin: 0px;
            pad: 0px;
        }

        .background_img {
            height: 100vh;
            width: 100%;
            object-fit: cover;

        }

        .login_con {
            position: fixed;
            top: 0px;
            left: 0px;
            height: 100%;
            width: 100%;
            background-color: #04133891;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login_sub_con {
            width: 400px;
            height: 450px;
            background-color: white;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo_icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 50px;
        }

        form {
            width: -webkit-fill-available;
  width: -moz-available;
  width: fill-available;
  height: -webkit-fill-available;
  height: -moz-available;
  height: fill-available;
            /* background-color: green; */
            padding: 30px;
        }

        input {
            width: -webkit-fill-available;
  width: -moz-available;
  width: fill-available;
            height: 30px;
            margin-bottom: 20px;

            outline: none;
        }
    </style>

</head>

<body>

    <?php
        echo "
                <script>
                
                    sessionStorage.setItem('login', '_');
                    
                </script>
            ";
    ?>

    <img class="background_img" src="images/other/bg2.jpg" alt="">

    <div class="login_con">


        <div class="login_sub_con">

            <img class="logo_icon" src="images/logo_icon.jpg" alt="">

            <form action="login.php" method="post">

                <input type="text" name="Uid" id="" placeholder="User Name">
                <input type="password" name="pass" id="" placeholder="Password">

                <input style="background-color: green; color:white; border:none; cursor: pointer;" type="submit" name="Submit" value="Login">

            </form>

        </div>

    </div>

</body>

</html>