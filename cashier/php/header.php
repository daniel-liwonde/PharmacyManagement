<?php

  function createHeader($icon, $heading, $sub_heading) {
	  require "db_connection.php";
$user=$_SESSION['USER_ID'];
//$menu=0;
$currentUser=mysqli_query($con,"SELECT * FROM admin_credentials WHERE USER_ID='$user'")or die(mysqli_error($con));
$detail=mysqli_fetch_array($currentUser);
$fname=$detail['FNAME'];
$lname=$detail['LNAME'];
    echo '
    <section class="row content-header" style="background-color:#17A589; font-family:verdana;border-bottom: 3px solid orange;color:#ffffff;border-top-right-radius:9px">
      <div class="header-title col-md-11">
        <p class="h4 pt-2"><i class="fa fa-'.$icon.'"></i>&emsp;'.$heading.'</p>
        <p style="margin-left:5%"><i class="fa fa-circle-user fa-2x"></i> &nbsp;<b>'.$fname.' '.$lname.'</b>
        &emsp;&emsp;&emsp;<small class="font-weight-bold h6"  style="margin-left:27%">'.$sub_heading.'</small>
        
        
              
            
             </p>
      </span> 
      </div>
      
      <div class="col-md-1 user_options" col-sm-2>
        <button class="col col-md-1 m-3 " onclick="showOptions();" style="background-color:#17A589;position:relative">
          <i class="fa fa-gear fa-sm"></i>
        </button>
        <div id="mark"><i class="fa fa-play fa-rotate-270"></i></div>
        <ul id="options" class="options list-unstyled" style="display: none;">
          <li>
            <a href="my_profile.php?menu=0"><i class="fa fa-user"></i><span>My Profile</span></a>
          </li>
          <li>
            <a href="change_password.php?menu=0"><i class="fa fa-edit"></i><span>Change Password</span></a>
          </li>
          <li>
            <a href="logout.php"><i class="fa fa-key"></i><span>Logout</span></a>
          </li>
        </ul>
      </div>
    </section>
    ';
  }
?>
