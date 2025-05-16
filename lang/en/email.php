<?php
return [
    'update' => [
        'success' => 'Congratulations, we have sent a verification email to the address :email.
        
Please check your inbox and click on the verification link.
        
The verification process may take a few minutes, if after 5 minutes you still have not received the verification email. Please try again.',
        
        'fail' => 'The login email update failed.',
        
        'exception' => 'The login email update has an error. Please contact GM immediately to resolve it.',
        
        'verified' => 'The login email has been approved. We do not support changing this email!',
    ],
    
    'verify' => [
        'success' => 'Congratulations, you have successfully updated your new login email.',
        
        'fail' => 'The login email verification failed.',
        
        'exception' => 'The login email verification has an error. Please contact GM immediately to resolve.'
    ],
    'resend' => [
        'success' => 'Successfully resending email confirmation.',
        
        'fail' => 'Failed to resend email confirmation.',
        
        'exception' => 'Error in resending email confirmation. Please contact GM immediately to resolve.'
    ]
];