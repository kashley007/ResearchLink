<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        
        <img src="{{ $message->embed(public_path() . '/images/ODULogo.jpg') }}" style="padding:0px; margin:0px; width:16%;" alt="ODU" />
        <h3>New Opportunity</h3>
        <div>
        	<p>
        		Hey {{ $user['first_name'] }}!,<br/>
            		A new research opportunity has been created that relates to your interests.<br/>
           		<a href="http://researchlink.odu.edu/" target="_blank">Login</a> to ResearchLink to see what is new!</p><br/>
            <br/>
        </div>
    </body>
</html>