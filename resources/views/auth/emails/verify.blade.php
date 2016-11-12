<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
       
        <h3>Verify Your Email Address</h3>
        <div>
        	<p>
        		Hey {{ $userData['first_name'] }},<br/>
            		Thank you for creating an account with ResearchLink.
           		Please follow the link below to verify your email address.</p><br/>
            <br/>
            <a style="margin-top: 20px;" href="{{ $link = url('register/verify', $userData['confirmation_code']) }}"> {{ $link }} </a>
        </div>
    </body>
</html>