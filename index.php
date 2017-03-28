
<?php
session_start();
require_once('model/database.php');
require_once('model/employee_db.php');
require_once('model/user_db.php');
require_once('view/print_db.php');
require_once('model/department_db.php');
require_once('model/group_db.php');
require_once('model/message_db.php');
require_once('model/word_db.php');
require_once('model/homepage_db.php');

//get the action to be performed
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL ) {
        $action = 'home_view';
    } 
} 
if (!isset($_SESSION['is_valid_user'])) {
       $action = 'login';
       
    }
   
//The main switchboard for site navigation
switch ($action){
    //take the user to the main menu
    case 'home_view':
        $userName = $_SESSION['username'];
        $userFirstName = get_user_first_name($userName);
        $userLastName = get_user_last_name($userName);
        $userGroups = get_user_groups($userName);
        $userRoles = get_user_roles($userName);
        $userLastLogin = get_last_login_time($userName);
        $userReceivedMessages = get_received_messages($userName);
        $userPendingMessages = get_pending_messages($userName);
        $popularUsers = get_24_hr_popular($userName);
        $words_24hrs = findwords_24();
        $words_5hrs = findwords_5();
        include('view/home_view.php');
       //echo get_member(1);
        break;
    case 'member_view':
        include('view/directory/members/member_view.php');
        break;
    case 'group_view':
        include('view/directory/groups/group_view.php');
        break;
    case 'view_messages_view':
     
        include('view/messages/view_messages_view.php');
        break;
    case 'send_messages_view':
        include('view/messages/send_messages_view.php');
        break;
    ///there///
   
    case 'man_profile_view':
        //only returns employees that don't already have login profiles
        $employees = get_employees_without_logins();
        //returns the type of logins currently available
        $privileges = get_employee_privileges();
        $new_user_login_message="";
        include('view/manage_directory/user_profiles.php');
        break;
    case 'man_department_view':
        $departments = get_departments();
        $man_dpt_message = "";
        include('view/manage_directory/departments.php');
        break;
     case 'edit_department':
        $dept_id = filter_input(INPUT_POST, 'Dept_ID');
        $department= search_gp_dpt(" ", " ", " ", $dept_id, " ", 0) ;
        $depname = $department['Dept_Name'];
        $depdes = $department['Dept_Description'];
        $depmanager = $department['Manager_ID'];
        
        if ($status=='Active'){
            $status_check = 'Y';
        }
         
        $this_action_message = "Edit Existing Department";
        include('view/manage_directory/department_add.php');
        break;
        
        case 'add_or_edit_department':
        $dptid = filter_input(INPUT_POST, 'dpt_id');
        $dptname = filter_input(INPUT_POST, 'dptame');
        $dptdes = filter_input(INPUT_POST, 'dpdes');
        $dptmrg = filter_input(INPUT_POST, 'dpmrg');
        $check_status = filter_input(INPUT_POST, 'status');
       $status = 'Inactive';
        if (isset($check_status)){
            $status = 'Active';
        }     
        if (search_gp_dpt(" ", " ", " ", $dptid, " ", 0)!=NULL){
           edit_department( $dptid,$dptname, $dptdes, $dptmrg, $status);
            $man_dpt_message = "Modified department ID ".$dptid;
            
        } else{
            add_department( $dptid,  $dptname, $dptdes, $dptmrg, $status);
            $man_dpt_message = "Added new department ID ".$dptid;
        }
        
        $departments = get_departments();
        include('view/manage_directory/departments.php');
        break;
      case 'add_department':
        $dept_id = get_next_Dept_ID();
        $depname = " ";
        $depdes = " ";
        $depmanager = " ";
        $status_check = "N";
        $this_action_message = "Add New Department";
        include('view/manage_directory/department_add.php');
        break;  
      
    /////////////////////////////////////////////////////////////////
    case 'man_role_view':
        $roles = get_roles();
        $man_role_message = "";
        include('view/manage_directory/roles.php');
        
        break;   
      
        case 'edit_role':
        $role_id = filter_input(INPUT_POST, 'Role_ID');//from the role.php
        $role= searchRole($role_id) ;
        $role_name = $role['Role_Name'];
        $role_des = $role['Role_Description'];
         $role_dpt = $role['Dept_ID'];
          $role_em = $role['EM_ID'];
         $status =$role['Role_Status'];
        if ($status=='Active'){
            $status_check = 'Y';
        }
         
        $this_action_message = "Edit Existing Role";
        include('view/manage_directory/role_add.php');
        break;
    
         
        case 'add_or_edit_role':
        $rlid = filter_input(INPUT_POST, 'rid');
        $rlname = filter_input(INPUT_POST, 'rname');
       $rldes = filter_input(INPUT_POST, 'rdes');
        $rldpt = filter_input(INPUT_POST, 'rdepid');
        $rlemp = filter_input(INPUT_POST, 'remid');
        $check_status = filter_input(INPUT_POST, 'status');
          
       $status = 'Inactive';
       if (isset($check_status)){
            $status = 'Active';
        }     
        if (searchRole( $rlid )!=NULL){
            
             edit_role( $rlid,  $rlname, $rldes, $rldpt,$rlemp, $status);
             $man_role_message = "Modified Role ID ".$rlid;
          
        } else{
            add_role( $rlid,  $rlname, $rldes, $rldpt,$rlemp, $status);
            $man_role_message = "Added new Role ID ".$rlid;
        }
        $roles = get_roles();
        include('view/manage_directory/roles.php');
        break;
       
      case 'add_role':
        $role_id = get_next_Role_ID();
        $role_name ="";
        $role_des = "";
        $role_dpt = "";
        $role_em="";
        $status_check = "N";
        $this_action_message = "Add New Role";
        include('view/manage_directory/role_add.php');      
        break;  
 
    ////////////////////////////////////////////////////////////////
     case 'man_group_view':
        $groups = get_groups();
        $man_group_message = "";
        include('view/manage_directory/groups.php');
        break;   
        case 'edit_group':
        $group_id = filter_input(INPUT_POST, 'Group_ID');//from the role.php
        $group=search_gp_dpt(" ", $group_id, " ", " ", " ", 0);
        $group_name = $group['Group_Name'];
         $group_des = $group['Group_Description'];
         $group_ldr= $group['Group_Leader_ID'];
         $status =$group['Group_Status'];
         
        if ($status=='Active'){
            $status_check = 'Y';
        }
        $this_action_message = "Edit Existing Group";
        include('view/manage_directory/group_add.php');
        
        break;
     case 'add_or_edit_group':
        $grpid = filter_input(INPUT_POST, 'grpid');
        $grpname = filter_input(INPUT_POST, 'grpname');
        $grpdes = filter_input(INPUT_POST, 'grpdes');
        $grpldr = filter_input(INPUT_POST, 'grpldr');
        $check_status = filter_input(INPUT_POST, 'status');
       
            $status = 'Inactive';
        if (isset($check_status)){
            $status = 'Active';
        }    
      
        if (search_gp_dpt(" ", $grpid, " "," ", " ", 0)!=NULL){
           edit_group( $grpid,$grpname, $grpdes, $grpldr, $status);
            $man_group_message = "Modified group ID ".$grpid;
            
        } else{
             add_group( $grpid,$grpname, $grpdes, $grpldr, $status);
            $man_group_message = "Added new group ID ".$grpid;
        }
        $groups = get_groups();
        include('view/manage_directory/groups.php');
        break;
         
     case 'add_group':
        $group_id = get_next_Grp_ID();
        $group_name ="";
        $group_des = "";
        $group_ldr = "";
        $status_check = "N";
        $this_action_message = "Add New Group";
        include('view/manage_directory/group_add.php');
        break;
    
    ////////////////////////////////////////////////////////////////
    case 'man_grp_member_view':
        $grpmbrs = printAll(5,0);
        
        $man_grpmbr_message = "";
        include('view/manage_directory/group_members.php');
        break;
     case 'edit_grpmbr':
        $grpmbr_ID=filter_input(INPUT_POST, 'GrpMbr_ID');
        $grpmbr=get_grpmbr($grpmbr_ID);
         $em_id = $grpmbr['EM_ID'];
        $grp_id=$grpmbr['Group_ID'];
        $role=$grpmbr['Group_Role'];
         $status =$grpmbr['Group_Status'];
         
        if ($status=='Active'){
            $status_check = 'Y';
        }
        $this_action_message = "Edit Existing Group member";
        include('view/manage_directory/group_members_add.php');
        
        break;
       
        case 'add_or_edit_grpmbr':
        $grpmbr_ID=filter_input(INPUT_POST, 'gpmbid');
        $emid = filter_input(INPUT_POST, 'emid');
        $grpid = filter_input(INPUT_POST, 'grpid');
        $grprole = filter_input(INPUT_POST, 'grprole');
        $check_status = filter_input(INPUT_POST, 'status');
       
            $status = 'Inactive';
        if (isset($check_status)){
            $status = 'Active';
        }    
      
        if (get_grpmbr($grpmbr_ID)!=NULL){
          edit_grpmbr( $grpmbr_ID,$emid,  $grpid, $grprole,  $status);
            $man_grpmbr_message = "Modified group member ID ".$grpmbr_ID;
            
        } else{
             add_grpmbr( $grpmbr_ID,$emid,  $grpid, $grprole,  $status);
            $man_grpmbr_message = "Add New grouop member ID ".$grpmbr_ID;
        }
         $grpmbrs = printAll(5,0);
        include('view/manage_directory/group_members.php');
        break;
        
        case 'add_grpmbr':
            
        $grpmbr_ID=get_next_GrpMbr_ID();
        $em_id = "";
        $grp_id="";
        $role="";
        $status_check = "N";
        $this_action_message = "Add New Group";
        include('view/manage_directory/group_members_add.php');
        
        
        break;
        
        
        
        
    /////////////////////////////////////////////////////////////
   case 'man_word_view':
       $words = printAll(3,0);
        $man_word_message = "";
        include('view/manage_directory/words.php');
        break;
    
    
   
    case 'edit_word':
        $word_id = filter_input(INPUT_POST, 'Word_ID');//from the role.php
        $word= searchw($word_id," "," ",0);
        $word_content = $word['Word'];
         $status =$word['Word_Status'];
         
        if ($status=='Active'){
            $status_check = 'Y';
        }
        $this_action_message = "Edit Existing Word_filter";
        include('view/manage_directory/word_add.php');
        
        break;
         case 'add_or_edit_word':
        $wdid = filter_input(INPUT_POST, 'wd_id');
        $wdcont = filter_input(INPUT_POST, 'wd_cont');
        $check_status = filter_input(INPUT_POST, 'status');
       
            $status = 'Inactive';
        if (isset($check_status)){
            $status = 'Active';
        }    
      
        if (searchW($wdid," ", " ", 0)!=NULL){
            
           edit_word( $wdid, $wdcont,$status);
            $man_word_message = "Modified word ID ".$wdid;
            
        } else{
            add_word( $wdid, $wdcont,$status);
            $man_word_message = "Added new group ID ".$wdid;
        }
        $words = printAll(3,0);
        include('view/manage_directory/words.php');
        break;
         
    case 'add_word':
        $word_id = get_next_wd_ID();
        $word_content ="";
        $status_check = "N";
        $this_action_message = "Add New word";
        include('view/manage_directory/word_add.php');
       
        break;
    /////////////////////////////////////////////////////////////
   case 'man_employee_view':
        $employees = get_employees();
        $departments = get_departments();
        $man_emp_message = "";
        include('view/manage_directory/employees.php');
        break;
    case 'edit_employee':
        $employee_id = filter_input(INPUT_POST, 'em_id');
        $departments = get_departments();
        $employee = get_employee($employee_id);
        $fname = $employee['EM_Firstname'];
        $mname = $employee['EM_Middlename'];
        $lname = $employee['EM_Lastname'];
        $email = $employee['EM_Email'];
        $phone = $employee['EM_Phone'];
        $status =$employee['EM_Status'];
        $dept_id =$employee['EM_Department_ID'];
        
        if ($status=='Active'){
            $status_check = 'Y';
        }
         
        $this_action_message = "Edit Existing Employee";
        include('view/manage_directory/employee_add.php');
        break;
    case 'filter_emp_by_dept':
        $dept_id = filter_input(INPUT_POST, 'dept_id');
        $employees = get_employees_by_dept_id($dept_id);
        $departments = get_departments();
        $man_emp_message = "";
        include('view/manage_directory/employees.php');
        break;
    case 'add_employee':
        $employee_id = get_next_EM_ID();
        $departments = get_departments();
                $fname = "";
        $mname = "";
        $lname = "";
        $email = "";
        $phone = "";
        $status_check = "N";
        $dept_id = "";
        $this_action_message = "Add New Employee";
        include('view/manage_directory/employee_add.php');
        break;
    case 'add_or_edit_employee':
        $employee_id = filter_input(INPUT_POST, 'em_id');
        $fname = filter_input(INPUT_POST, 'fname');
        $mname = filter_input(INPUT_POST, 'mname');
        $lname = filter_input(INPUT_POST, 'lname');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        $check_status = filter_input(INPUT_POST, 'status');
        $dept_id = filter_input(INPUT_POST, 'dept_id');
        $status = 'Inactive';
        if (isset($check_status)){
            $status = 'Active';
        }     
        if (is_existing_employee($employee_id)){
            edit_employee($employee_id, $fname, $mname, $lname, $email, $phone, $status, $dept_id);
            $man_emp_message = "Modified employee ID ".$employee_id;
            
        } else{
            add_employee($employee_id, $fname, $mname, $lname, $email, $phone, $status, $dept_id);
            $man_emp_message = "Added new employee ID ".$employee_id;
        }
        $employees = get_employees();
        $departments = get_departments();
        include('view/manage_directory/employees.php');
        break;
   
    
   
    case 'new_user':
        $employees = get_employees_without_logins();
        $privileges = get_employee_privileges();
        $username = filter_input(INPUT_POST, 'username');
        $password1 = filter_input(INPUT_POST, 'password1');
        $password2 = filter_input(INPUT_POST, 'password2');
        if ($password1 != $password2){
            $new_user_login_message= "Passwords do not match, try again.";
            break;
        }
        $privilege = filter_input(INPUT_POST, 'user_privilege');
        $emp_id = filter_input(INPUT_POST, 'em_id');
        if(is_unique_username($username)){
            add_user($username, $password, $privilege, $emp_id);
        } else {
            $new_user_login_message="Username is taken. Please try another login name.";
            include('view/profiles/manage_user_profiles.php');
            break;
        }
        $new_user_login_message= 'New user successfully added.';
        include('view/manage_directory/user_profiles.php');
        break;       
    case 'login':
        $username = filter_input(INPUT_POST, 'username');
        
        $password = filter_input(INPUT_POST, 'password');
        
        if (is_valid_user_login($username, $password)) {
            $_SESSION['is_valid_user'] = true;
            $_SESSION['username'] = $username;
            set_last_login('username');
            //include('view/home_view.php');
            //only check for admin status if the user is valid
            if (is_valid_admin($username)) {
                $_SESSION['is_valid_admin'] = true;  
            }

       
            $userName = $_SESSION['username'];
            $userFirstName = get_user_first_name($userName);
            $userLastName = get_user_last_name($userName);
            $userGroups = get_user_groups($userName);
            $userRoles = get_user_roles($userName);
            $userLastLogin = get_last_login_time($userName);
            $userReceivedMessages = get_received_messages($userName);
            $userPendingMessages = get_pending_messages($userName);
            $popularUsers = get_24_hr_popular($userName);
            $words_24hrs = findwords_24();
            $words_5hrs = findwords_5();
             include('view/home_view.php');
    
        } else {
            $login_message = 'You must login to continue';
            include ('view/login.php');
        }
        
        break;
        
        
    case 'send_group_view':
        include('view/messages/sendGroup_messages_view.php');
           break;
        
         case 'viewmessages':
             $user=$_SESSION['username'];
             $userid=  getemid($user);
        $option = filter_input(INPUT_POST, 'option');
        if($option=='inbox'){
             $messages=get_inmessages($userid);
            $man_msg_message = "";
        include('view/messages/inbox_messages_view.php');
        }
        else if ($option=='outbox'){
            $messages=get_outmessages($userid);
            $man_msg_message = "";
        include('view/messages/outbox_messages_view.php');}
        break;
        
    case 'logout':
        $_SESSION = array();
        session_destroy();
        include('view/logout.php');
        break;
    case 'searchEmployee':
        include('view/directory/members/member_view.php');

        $emid = filter_input(INPUT_POST, 'emid');
        $emfname = filter_input(INPUT_POST, 'emfname');
        $emmname = filter_input(INPUT_POST, 'emmname');
        $emlsname = filter_input(INPUT_POST, 'emlsname');
        $ememail = filter_input(INPUT_POST, 'ememail'); 
        $emphone = filter_input(INPUT_POST, 'emphone');
        $emstatus = filter_input(INPUT_POST, 'emstatus');
        $emstdat = filter_input(INPUT_POST, 'emstdat');
        $grpid = filter_input(INPUT_POST, 'emdep');
        $depid = filter_input(INPUT_POST, 'emdep');
        $fiword = filter_input(INPUT_POST, 'Word');
        $wordstat = filter_input(INPUT_POST, 'wdstat');
        $ar = array($emid, $emfname, $emmname, $emlsname, $ememail, $emphone, $emstatus, $emstdat);
        $count = count($ar);

        if (!empty($emid) || !empty($emfname) || !empty($emmname) || !empty($emlsname) || !empty($ememail) || !empty($emphone) || !empty($emstatus) || !empty($emstdat) || !empty($depid)) {
            while ($count != 1) {
                if (empty($ar[$count - 1])) {
                    $ar[$count - 1] = " ";
                }
                $count--;
            }
            if (!empty($emid)) {

                printbyid($emid, 0);
            } else {


                printem($ar[1], $ar[2], $ar[3], $ar[4], $ar[5], $ar[6], $ar[7]);
            }
        } else
            printAll(1,1);
        break;
        
    case 'search_grp_dpt':
        
        include('view/directory/groups/group_view.php');
        $emid = filter_input(INPUT_POST, 'emid');
        $grpid = filter_input(INPUT_POST, 'grp');
        $grprolename = filter_input(INPUT_POST, 'gprolenm');
        $depid = filter_input(INPUT_POST, 'dep');
        $dptrolename = filter_input(INPUT_POST, 'dptrolenm');
        $ar = array($emid,$grpid,$grprolename, $depid, $dptrolename);
         $count = count($ar);
         $counts = $count;
         $num = 0;
         
        if (!empty($grpid) || !empty($depid) || !empty($grprolename) || !empty($emid) || !empty($dptrolename)) {
            
            while ($count != 1) {
                if (empty($ar[$count - 1])) {
                    $ar[$count - 1] = " ";
                     
                    $num++;
                } 
                $count--;
            }               
            search_gp_dpt($ar[0],$ar[1],$ar[2],$ar[3],$ar[4],$counts-$num);
        } 
        
        else 
        { printAll(2,1);
        printAll(4,1);
        }
        break;
    case 'searchword':
         include('view/directory/groups/group_view.php');
        
        $fiword = filter_input(INPUT_POST, 'word');

        $wordstat = filter_input(INPUT_POST, 'wdstat');
          $arw = array($fiword, $wordstat);
       
        $countw = count($arw);
        //search word
        if (!empty($fiword) || !empty($wordstat)) {
            while ($countw != 1) {
                if (empty($arw[$countw - 1])) {
                    $ar[$countw - 1] = " ";
                }
                $countw--;
            }
            searchw(" ",$arw[0], $arw[1],1);
        }
        else
            printAll (3,1);
        break;
} 
?>

