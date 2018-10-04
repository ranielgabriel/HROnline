Some of the files need not to be edited or removed. And if you are not sure of what you are doing, DO NOT edit or remove any file(s) from the file tree. This may result in unwanted errors or malfunction of the whole system. 

This system was written, developed and created by many different software developer who was taught with different strategy and writing codes in their academe, without following any framework or coding structure given by the company. So bare with how the system architecture looks like and how it was structured.

If you are reading this, your best approach in taking over this system is trial and error by using the console of the browser in debugging.

*** IMPORTANT REMINDERS ***
1.) ALWAYS test everything in the development stage before uploading changes into the live server. 
2.) In development stage, if you are testing or working in submission of application forms, put in mind that it will notify and submit an email on the email address of the HR, so remove the mailer function first or if you are working on the mailer, use data that will distinguish that it is for debugging/development purposes only (eg. firstname->'Test').
3.) ALWAYS check if there is anyone who are currently using the system before uploading changes in the system. 
4.) When writing codes, ALWAYS write comments. It will not just help you when going back or debugging the system when a bug occurs but also help the future developers who will takeover the system.

*** IMPORTANT FILES IN THE FILE TREE ***
/HROnline
|-config    ##  This folder contains some of the php files for queries in the HR Online Recruits.
|-css   ##  This folder contains the css files of the HR Online Recruits.
|-fonts ##  This folder contains the fonts of the HR Online Recruits.
|-custom_css    ##  This folder contains the custom css files of the HR Online Recruits.
|-custom_js     ##  This folder contains the custom javascript files of the HR Online Recruits.
|-img   ##  This folder contains the image files of the HR Online Recruits.
|-js    ##  This folder contains the javascript files of the HR Online Recruits.
|-quickapply    ##  This folder for the quickapply feature of the system.
    |-css   ## This folder contains the css files for the quick apply.
    |-img   ## This folder contains the image files for the quick apply.
    |-api   ##  This folder contains the api of the quickapply feature of the system.
        |-addQuickApplicant.php ##  This file is responsible in inserting a quick applicant data in the database and sending a mail to notify the HR.
        |-deleteQuickApplicant.php  ## This file is for deleting a quick applicant in the database.
        |-getAllPositions.php   ##  This file is for retrieving/fetching all the positions to populate the "<select>" element in the quick apply.
    |-constants ##  This folder contains all the constants values for the quickapply feature.
        |-Constants.php ##  This file contains the constants value for the connection string of the quickapply feature.
        |-DbConnect.php ##  This file is the connection string of the system to the MySQL database and Apache server for the quick apply feature of the system.
        |-Operations.php    ##  This file is a class that holds all the methods to be used by the quick apply feature of the system.
    |-index.php ##  This file is the ~/application/quickapply/ or index file of the Quick Apply feature of the HR Online Recruits. If you want to add/remove/update any features in the system's ~/application/quickapply/ page, this is the file you need to edit.
|-account.php   ##  This file is for updating the currently logged in account.
|-applicants.php    ##  This file is for the Applicants List.
|-cms.php   ##  This file is for the Content Management System, adding positions and application source lists.
|-connect.php   ##  This is the connection string of the system to the MySQL database and Apache server.
|-createAccount.php   ##  This file is for creating an account for the HR Online Recruits.
|-google.php    ##  This file is the main page/home/dashboard of the HR after logging in.
|-index.php ##  This file is the ~/application/ or index file of the HR Online Recruits. If you want to add/remove/update any features in the system's ~/application/ page, this is the file you need to edit.
|-formvalidator.js  ##  This file is the validator/checker of the field and values given by the applicant when filling up the application from the index.php.
|-printableResume.php   ##  This file shows a printable resume in pdf when clicking the eye button in google.php for the HR.
|-query.php ##  This file runs the queries for the google.php.
|-quick_applicants_list.php ##  This file is for the Quick Apply Applicants List.
|-reports.php   ##  This file is for the viewing the Reports.
|-sidenavehtml.php  ##  This file is the side navigation bar shown in google.php
|-serverside.php    ##  This file runs the queries for the index.php.
|-update_resume_form.php    ##  This file updates the resume and is used by HR.
|-update_serverside.php ##  This file runs the queries for the update_resume_form.php
|-updateformvalidator.js    ##  This file is the form validator for updating an applicant.
|-user_logs.php ##  This file is for the History Logs of the HR who logged in the system.
|-view_authorization_list.php   ##  This file is for the General List.
|-policy_viewer.php   ##  This file is for the Privacy Policy List.

Note: Many files were not written and included in the "Important Files" section because during working or up to this date upon writing this README, I did not encounter changing or working any codes in the other files. Only the files in the "Important Files" section are the files that I had a chance to worked on.

Update this README if you want to add any other important changes or notes.