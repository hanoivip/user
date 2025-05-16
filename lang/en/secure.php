<?php
return [
    
    'email' => [
        'update' => [
            'success' => 'We have just sent an email to your email address.
Please check the inbox and click to validation links. (You might have to check in Spam folder).
This may take a few minutes, If you still receive no email after 5 minutes, please try again!',
            
            'fail' => 'Fail to update your email. Please try again!',
            
            'exception' => 'Error occurred while updating your email. Please contact our customer support.'
        ],
        
        'verify' => [
            'success' => 'Congratulation! Your secure email has been updated!', 
            'fail' => 'Fail to update your secure email. Please try again!',       
            'exception' => 'Error occurred while updating your secure email. Please contact our customer support.'
        ],
        
        'resend' => [
            'success' => 'Successfully resending email confirmation.',
            'fail' => 'Failed to resend email confirmation.',
            'exception' => 'Error in resending email confirmation. Please contact GM immediately to resolve.',
            'toofast' => 'The request to send email confirmation is too fast, you need to wait 5 minutes.'
        ],
        'exists' => 'Email already exists.',
        
        'verified' => 'Email has been set up. Resetting is not allowed.'
    ],
    'pass2' => [
        'update' => [
            'success' => 'Successfully updating security password.',
            'fail' => 'Failed to update security password.',
            'exception' => 'Error in updating security password. Please contact GM immediately to resolve.'
        ],
        
        'duplicated_not_good' => 'Security question update failed, must be different from current password.'
    ],
    
    'qna' => [
        'update' => [
            'success' => 'Security question update successful.',
            
            'fail' => 'Security question update failed.',
            
            'exception' => 'Security question update failed. Please contact GM immediately to resolve.'
        ],
        'question1' => 'What do you hate the most?',
        'question2' => 'What do you usually do in your free time?',
        'question3' => 'Who do you admire the most?',
        'question4' => 'Which movie impressed you the most?',
        'question5' => 'Which singer is your idol?',
        'question6' => 'What is your ideal job?',
        'question7' => 'Which actor is your idol?',
        'question8' => 'What is your dream?',
        'question9' => 'Your favorite food?',
        'question10' => 'What is your favorite sport?',
        'question11' => 'Who is your best friend?',
        'question12' => 'The PinCode on the pre-made card?',
        'question13' => 'Where was your birthplace?',
        'question14' => 'School What was your primary school name?',
        'question15' => 'What was your mother\'s last name?',
        'question16' => 'The name of the first company you worked for?',
        'question17' => 'The name of the university you attended?',
        'question18' => 'Where did you meet your spouse?',
        'question18' => 'What is your father\'s last name?',
        'question18' => 'What is your grandfather\'s first name?'
    ],
            
    'reset' => [
        'email-invalid' => 'Email does not exist! Please remember your security email! (Please note that the security email must be authenticated first. It is case sensitive)',
        'email-sent' => 'We have sent you an email with instructions on how to reset your password. Please check your email and follow the instructions.',
        'token-invalid' => 'Please check your email and follow the instructions again.',
        'success' => 'Password reset successful!',
        'too-fast' => 'The email request was sent too quickly. You need to wait at least 2 minutes between requests.'
    ]
];