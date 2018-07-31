<?php

$DB_Server = "localhost"; //MySQL Server    
$DB_Username = "hr_online_app_db"; //MySQL Username     
$DB_Password = "hr_online_app_db";             //MySQL Password     
$DB_DBName = "hr_online_app_db4";         //MySQL Database Name  
$DB_TBLName = "tbl_application"; //MySQL Table Name   
$filename = "email_export_" . date("Y_m_d-h:i:sa");         //File Name


/*LEAVE EVERYTHING BELOW*/

//create MySQL connection   
$sql = "SELECT DISTINCT `POSITION`, `SHIFTING_SCHEDULE`, `WEEKENDS_HOLIDAYS`, `EMPLOYMENT_DATE`, `NAME`, `LASTNAME`, `FIRSTNAME`, `MIDDLENAME`, `EXTENSIONNAME`, `NICKNAME`, `AGE`, `DATE OF BIRTH`, `PLACE OF BIRTH`, `PBO_MUNICIPALITY`, `PBO_PROVINCE`, `PBO_REGION`, `GENDER`, `CIVIL STATUS`, `CITIZENSHIP`, `CURRENT ADDRESS`, `CURRENT_HOME_STREET`, `CURRENT_BARANGAY`, `CURRENT_MUNICIPALITY`, `CURRENT_PROVINCE`, `CURRENT_REGION`, `CONTACT NO.`, `EMAIL ADDRESS`, `SPOUSE'S NAME`, `S_LNAME`, `S_FNAME`, `S_MNAME`, `SPOUSE'S OCCUPATION`, `FATHER'S NAME`, `F_LNAME`, `F_FNAME`, `F_MNAME`, `MOTHER'S MAIDEN NAME`, `M_LNAME`, `M_FNAME`, `M_MNAME`, `1. Inclusive Dates`, `1.1 Employer's Name, Address and Phone`, `1.2 Position Title`, `1.3 Name_Position and Contact No. of Immediate Supervisor`, `1.4 Monthly Salary`, `1.5 Reason for Leaving`, `2. Inclusive Dates`, `2.1 Employer's Name, Address and Phone`, `2.2 Position Title`, `2.3 Name_Position and Contact No. of Immediate Supervisor`, `2.4 Monthly Salary`, `2.5 Reason for Leaving`, `3. Inclusive Dates`, `3.1 Employer's Name, Address and Phone`, `3.2 Position Title`, `3.3 Name_Position and Contact No. of Immediate Supervisor`, `3.4 Monthly Salary`, `3.5 Reason for Leaving`, `4. Inclusive Dates`, `4.1 Employer's Name, Address and Phone`, `4.2 Position Title`, `4.3 Name_Position and Contact No. of Immediate Supervisor`, `4.4 Monthly Salary`, `4.5 Reason for Leaving`, `5. Inclusive Dates`, `5.1 Employer's Name, Address and Phone`, `5.2 Position Title`, `5.3 Name_Position and Contact No. of Immediate Supervisor`, `5.4 Monthly Salary`, `5.5 Reason for Leaving`, `ELEM_Name of School`, `ELEM_Year Graduated`, `ELEM_Highest Grade/ Level/ Units Earned`, `ELEM_Inclusive Dates of Attendance`, `ELEM_Scholarship/ Academic Honors Received`, `HS_Name of School`, `HS_Year Graduated`, `HS_Highest Grade/ Level/ Units Earned`, `HS_Inclusive Dates of Attendance`, `HS_Scholarship/ Academic Honors Received`, `COL_Name of School`, `COL_Degree Course`, `COL_Graduated`, `COL_Year Graduated`, `COL_Highest Grade/ Level/ Units Earned`, `COL_Inclusive Dates of Attendance`, `COL_Scholarship/ Academic Honors Received`, `FORMALLY_CHARGED`, `ADMINISTRARIVE_OFFENSE`, `CRIME_VIOLATION`, `MODES`, `REF_Name`, `REF_Address`, `REF_ContactNum`, `CERTIFY`, `SALARY`, `HEIGHT`, `WEIGHT`, `BLOODTYPE`, `PROVINCIAL_ADDRESS`, `PROV_HOME_STREET`, `PROV_BARANGAY`, `PROV_MUNICIPALITY`, `PROV_PROVINCE`, `PROV_REGION`, `HOME_TELNUM`, `SKYPE_USERID`, `CONTACT NAME`, `CONTACT DETAILS`, `EMAIL`, `MOBILE_NUMBER`, `FATHER PLACEBIRTH`, `F_MUNICIPALITY`, `F_PROVINCE`, `F_REGION`, `MOTHER PLACEBIRTH`, `M_MUNICIPALITY`, `M_PROVINCE`, `M_REGION`, `RELIGION`, `HAVE_CHILD`, `REF_Name2`, `REF_Address2`, `REF_ContactNum2`, `REF_Name3`, `REF_Address3`, `REF_ContactNum3`, `GRAD_Name of School`, `GRAD_Degree Course`, `GRAD_Graduated?`, `GRAD_Year Graduated`, `GRAD_Highest Grade/ Level/ Units Earned`, `GRAD_Inclusive Dates of Attendance`, `GRAD_Scholarship`, `PROF_License1`, `PROF_Rating1`, `PROF_DateGranted1`, `PROF_Institution1`, `PROF_Licensennum1`, `PROF_DateReleased1`, `PROF_License2`, `PROF_Rating2`, `PROF_DateGranted2`, `PROF_Institution2`, `PROF_Licensennum2`, `PROF_DateReleased2`, `PROF_License3`, `PROF_Rating3`, `PROF_DateGranted3`, `PROF_Institution3`, `PROF_Licensennum3`, `PROF_DateReleased3`, `APPLICATION_SOURCE`, `Status`, `Physical Checkup`, `MOBILE_NUMBER2`, `MOBILE_NUMBER3`, `FB_Account`, `Twitter_Account`, `Timestamp`, `ID`, `REFERENCE_NO`, `APPLICANT_STATUS`, `PHOTO_DIRECTORY`, `email_status`, `Note`, `Schedule`, `hr_email`, `source` FROM $DB_TBLName ";
$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
//select database   
$Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());   
//execute query 
$result = @mysql_query($sql,$Connect) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    
$file_ending = "xls";
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . "\t";
}
print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysql_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }   
?>