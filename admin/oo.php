<?php
$receiver = "youssefbindouu@gmail.com";
$subject = "Email Test via PHP using Localhost";
$body = '
    <html>
    <body>
        <h1>Hi, there!</h1>
        <p>This is a test email sent from Localhost.</p>
        <img src="https://ci3.googleusercontent.com/mail-sig/AIorK4ygxuFATywoHwbIxmbju1krjs1mq4NKWimktk-RUQHZFkBBWcbTEStyzbFaK0G3gmtb3_4RqRKowP-QtJDOEzQ0EHaF2fYMueSFR6Y57w" alt="Centered Image">
    </body>
    </html>
';
$sender = "From: items.swap@gmail.com\r\n";
$sender .= "MIME-Version: 1.0\r\n";
$sender .= "Content-Type: text/html; charset=UTF-8\r\n";

if(mail($receiver, $subject, $body, $sender)){
    echo "Email sent successfully to $receiver";
}else{
    echo "Sorry, failed while sending mail!";
}
?>
