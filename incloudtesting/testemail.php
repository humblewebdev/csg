<?php
$a_message = "
		<p>Dear $approve_first $approve_last,<p>
        <p>
		Congratulations!  Your application for the CSG FAST offering has been reviewed and approved.  You are now able to customize this service to your agency in several ways.  Please review the steps outlined in this email.  CSG will be reaching out to your office today to schedule a phone appointment to make sure you are familiar with all the systems and that the voice recordings are completed.  This is the final step in the process to get you started. If you have any questions please contact us at (888) 516-4088.
		</p>
        
		Your dedicated toll-free number is:  <b>$approve_poc</b> <br>
		Starting on <b>$approve_startdate</b> you will forward your main line to this number.
        <br><br>
		<p><b>1. FAST Portal - (please use Google Chrome)</b> This portal <b>must</b> be updated with your special requests <b>daily.</b>  The items listed below are all ways you customize this service to your office. </p>
		<ul>
		<li>Are you in or out of the office today?</li>
		<li>Greeting (how do you want us to answer call)</li> 
		<li>Staff- Schedules/responsibilities/E-mail. The reason for this is when customers call in and specifically want to speak to someone in your office we want to be prepared for that.</li> 
		<li>Calls to be transferred to Farmers or your office.</li> 
		<li>How do we end your call?</li> 
		<li>Special notes specific to your business.</li>
		</ul>
		<b>FAST Portal:</b> www.csgfast.com <br>
		<b>Username:</b> $approve_username <br>
		<b>Password:</b> -You set this when signing up on the Website <br><br>
        <p>
		<b>2. InContact Website - </b>This website is where you will listen to phone calls.  Log in info is below.  Once logged in, go to the tab called <b>Reports</b>, choose <b>Contact History</b>.   This will pull up your call history for the day.  You are able to change the date range as needed.  On the left hand side of the page, you can click on Contact ID #.  From there, you can download the call recording and listen to the call. 
        </p>
		<p>
		When looking at the details of a call, you will see all the information about that call including: the Fast Agent that took the call, duration of the call, and ANI/From (the number that the customer called from). This will come in handy when you get a voicemail that isn’t clear or is has incomplete information. 
        </p>
		<b>Web site:</b> login.incontact.com <br>
		<b>Username:</b> $approve_email <br>
		<b>Password:</b>  American1 <br><br>
		<p>
		<b>3. Voice Recordings - </b>Please dial (888) 369-4416 from your main line phone  # <b>$approve_mainline</b>.  Choose option one and following the instructions for all the recordings.  Below are the three recordings that will need to be done.  
        </p>
		<p>
		<b>Greeting - </b>\"Thank you for calling the $approve_last Agency.  If you’re calling for a new quote or to follow-up on an existing quote, press 1, otherwise remain on the line for the next available staff member.\"
        </p>
		<p>
		<b>Voicemail - </b>\"You have reached the $approve_last Agency. I am sorry we can not answer the phone right now, but if you leave a detailed message we will return the call.\" 
		</p> 
		<p>
		<b>Whisper - </b>\"$approve_last Insurance Agency\" 
        </p>
		<p>
		The whisper will be what the reps hear every time your calls come in so they answer the call specifically for your office.
        </p>
		<p>
		Again, we will contact you to review this email and ensure all the items are complete.  We look forward to working with you and helping your business grow!
		</p>
		Sincerely, <br><br>

		CSG FAST Team<br><br>

		(888) 516-4088<br>

		FAST_Support@csgemail.com
		";
		$a_to = "ericr@csgemail.com";
		$a_subject = 'CSG FAST PROGRAM USER APPROVAL';
		$a_headers .= "MIME-Version: 1.0\r\n";
		$a_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

		mail($a_to, $a_subject, $a_message, $a_headers);

?>