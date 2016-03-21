<!DOCTYPE html>
<?php 


?>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Welcome to Gobind Sarver!</h2>

        <div>
            Thank you for signing up with Gobind Sarver. Please verify your email address by clicking the link below so that we can send you upcoming information. <br><br>
             {{ URL::to('/verify/'.$verification_code ) }}

        </div>

    </body>
</html>