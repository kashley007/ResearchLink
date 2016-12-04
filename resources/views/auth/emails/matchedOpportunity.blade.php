<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        
        <img src="{{ $message->embed(public_path() . '/images/ODULogo.jpg') }}" style="padding:0px; margin:0px; width:16%;" alt="ODU" />
        <h3>A new Opportunity has been created!</h3>
        <div>
        	<p>
        		Hey {{ $user['first_name'] }}!,<br/>
            		A new research opportunity has been created related to your interests.
           		Please follow the link below to access the new opportunity.</p><br/>
            <br/>
            <a style="margin-top: 20px;" href="{{ $link = url('register/verify', $user['confirmation_code']) }}"> {{ $link }} </a>
        </div>
    </body>
</html>