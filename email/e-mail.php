<?php

//Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);



    if (isset($_POST['book_room'])){

        $name =  $_POST['name'];

        $from =  $_POST['email'];
        $number =  $_POST['number'];

        $arrival_date = $_POST['arrival_date'];
        $departure_date = $_POST['departure_date'];
        $adult = $_POST['adult'];
        $children = $_POST['children'];
        $room = $_POST['room'];
        $service = $_POST['service'];

        $message = " Name : - " . $name . " <br> Number : - " . $number ." <br> Email : - " . $from .  "<br> Arrival Date : - " . $arrival_date .  "<br> Departure Date : - " . $departure_date .  " <br> Adult : - " . $adult .  " <br> Child : - " . $children .  " <br> Room Name : -  " . $room .  " <br> Room Service : - " . $service   ;
        $message_2 = " Mr / Miss " . $name . " , Nameste, Thank You for choosing hotelsrimanpalace Resort, Gopalpur on Sea. I'm Pleased to receive your Inquiry for Room for  Bookings and will revert back soon. <br> Regards, <br> hotelsrimanpalace Resort <br> Mobile No : +91 7077683888 <br> Email ID : reservations@hotelsrimanpalace.com " ;

        try {

            $mail->isSMTP();                                            
            $mail->Host       = 'mail.hotelsrimanpalace.com';        
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = 'booking@hotelsrimanpalace.com';                 
            $mail->Password   = 'Qwertyuiop1@';                         
            $mail->SMTPSecure = 'tls';                                  
            $mail->Port       = 587;                                    
            
            $mail->setFrom( "Noreplay@hotelsrimanpalace.com", $name); 
            $mail->addAddress("hotelsrimanpalace.reservation@gmail.com", "hotelsrimanpalace Resorts");     
           
            $mail->isHTML(true);
            $mail->Subject = "Book Room";
            $mail->Body    = $message;
    
            $mail->send();
            
            
            
            
            echo "
                <script>

                    localStorage.setItem('alert_Email', '1');
                    window.location.href='../book_room.php';
                
                </script>
            ";
            exit;

        } catch (Exception $e) {

            echo "
                <script>

                    localStorage.setItem('alert_Email', '2');
                    window.location.href='../book_room.php';
                
                </script>
            ";
            exit;

        }






        
    }
    
    
    
    
    if (isset($_POST['book_table'])) {
    
        $name =  $_POST['name'];

        $from =  $_POST['email'];
        $number =  $_POST['number'];

        $date = $_POST['date'];
        $person = $_POST['person'];
        $table_name = $_POST['table_name'];
        
        $message = " <br> Name :- " . $name . "<br> Number :- " . $number .  "<br> Date :- " . $date .  "<br> person :- " . $person .  "<br> Table Name :- " . $table_name ;



        try {

            $mail->isSMTP();                                            
            $mail->Host       = 'mail.hotelsrimanpalace.com';        
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = 'booking@hotelsrimanpalace.com';                 
            $mail->Password   = 'Qwertyuiop1@';                         
            $mail->SMTPSecure = 'tls';                                  
            $mail->Port       = 587;                                    
            
            $mail->setFrom( "Noreplay@hotelsrimanpalace.com", $name); 
            $mail->addAddress("hotelsrimanpalace.reservation@gmail.com", "hotelsrimanpalace Resorts");     
           
            $mail->isHTML(true);
            $mail->Subject = "Book Table";
            $mail->Body    = $message;
    
            $mail->send();
            
            
            
            
           echo "
                <script>

                    localStorage.setItem('alert_Email_2', '1');
                    window.location.href='../book_DINING.php';
                
                </script>
            ";
            exit;

        } catch (Exception $e) {

            echo "
                <script>

                    localStorage.setItem('alert_Email_2', '2');
                    window.location.href='../book_DINING.php';
                
                </script>
            ";
            exit;

        }
    
    }
    
    
    
    
    
    
    
    
    
    if (isset($_POST['book_event'])) {
    
        $f_name =  $_POST['first_name'];
        $l_name =  $_POST['last_name'];

        $from =  $_POST['email'];
        $number =  $_POST['number'];

        $date = $_POST['date'];
        $event = $_POST['event'];
        $event_message = $_POST['event_message'];

        
        $message = " Name :- " . $f_name . " " . $l_name . "<br> Number :- " . $number .  " <br> Date :- " . $date .  " <br> Event :- " . $event .  "<br> Message :- " . $event_message ;

        
        
         try {

            $mail->isSMTP();                                            
            $mail->Host       = 'mail.hotelsrimanpalace.com';        
            $mail->SMTPAuth   = true;                                  
            $mail->Username   = 'booking@hotelsrimanpalace.com';                 
            $mail->Password   = 'Qwertyuiop1@';                         
            $mail->SMTPSecure = 'tls';                                  
            $mail->Port       = 587;                                    
            
            $mail->setFrom( "Noreplay@hotelsrimanpalace.com", $f_name. " ". $l_name); 
            $mail->addAddress("hotelsrimanpalace.reservation@gmail.com", "hotelsrimanpalace Resorts");     
           
            $mail->isHTML(true);
            $mail->Subject = "Book Event";
            $mail->Body    = $message;
    
            $mail->send();
            
            
            
            
            echo "
                <script>

                    localStorage.setItem('alert_Email_3', '1');
                    window.location.href='../book_Event.php';
                
                </script>
            ";
            exit;

        } catch (Exception $e) {

           echo "
                <script>

                    localStorage.setItem('alert_Email_3', '2');
                    window.location.href='../book_Event.php';
                
                </script>
            ";
            exit;

        }
        
    
        
    
    }


    

    


?>