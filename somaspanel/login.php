<?php
    require("../mysqli_con/mysqli_con.php");

    
    if(isset($_POST['Submit']))
    {


        $sql = "SELECT * FROM `account` ";
        $result = mysqli_query($conn, $sql);
        $_value = mysqli_fetch_assoc($result);

        $user = $_POST['Uid'];
        $pass = $_POST['pass'];

        if($user == $_value['us_name'] && $pass == $_value['password'] ){

            echo "
                <script>
                
                    sessionStorage.setItem('login', 'login');
                    window.location.href = 'dashboard.php';
                    
                </script>
            ";

        }else{
             echo "
                <script>
                
                    sessionStorage.setItem('login', '_');
                    window.location.href = 'index.php';
                    
                    
                </script>
            ";
        }




        
    }else{
         echo "
            <script>
            
                sessionStorage.setItem('login', '_');
                window.location.href = 'index.php';
                
            </script>
        ";
    }
?>