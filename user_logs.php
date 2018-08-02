<?php
include('auth.php');
$_SESSION['previous-page'] = 'createAccount.php';
  $ln = "";
  $fn = "";
  $mn = "";
  $em = "";
  $em2 = "";
  $contact = "";
  $us = "";
  $pas = "";
  $pas2 = "";
  $usererrormsg = "";
  $emailerror = "";
  $erroremail = "";
  $whitespaceerror = "";
  $errormsg = "";   
?>
  <html>
    <head>
      <title>User History Logs</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="css/bootstrap-material-design.css">
      <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
      <link rel="stylesheet" type="text/css" href="css/sidenav.css">
      <link rel="stylesheet" type="text/css" href="css/jquery.dropdown.css">
      <link rel="stylesheet" type="text/css" href="css/tether.css">
      <link rel="stylesheet" href="custom_js/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="custom_js/dataTables.bootstrap.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="custom_css/user_logs.css">
    </head>
   
    <body>
     <?php
        $id = $_GET['id'];
        include 'sidenavhtml.php';
      ?>
      <div id="main">
        <!-- navigation bar -->
        <nav style="width:103.25%; margin-top:-2%; margin-left:-2%; background-color: #ADD8E6;">
          <div class="container-fluid">
            <ul class="nav navbar-nav">
              <li data-toggle="dropdown-toggle"><a data-toggle='modal'><h4 style="cursor:pointer; color:#00008B; font-family:'Trebuchet MS', Helvetica, sans-serif; padding-top:5px; padding-right:10px; padding-left: -10px" onclick="openNav()"><i class="fa fa-bars"></i> Menu</h4></a>
              </li>
              <li id="useractionlogin" class="dropdown"><a data-toggle="user_actionlogs" href="#" onclick="tableFuntion();"><h4 style ="color:gray; font-family:'Trebuchet MS', Helvetica, sans-serif; padding-top:5px;">User Actions History</h4></a>
              </li>
              <li id = 'userlogin' class="dropdown" ><a data-toggle="user_logins" href="#" ><h4 style ="color:gray; font-family:'Trebuchet MS', Helvetica, sans-serif; padding-top:5px;">User Login History</h4></a>
              </li>
            </ul>
          </div>
        </nav>
        <!-- end navigation bar -->

        <div class="row">
          <div class="col-md-12">
            <hr style="padding-bottom: 1%">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <!-- TABLES FOR EVERY USER LOGIN -->
            <div id = "user_logins" class="table responsive"> 
              <table  class="table table-striped">                     
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Logged in Date</th>
                    <th>User Role</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include('connect.php');
                  $sqltran = "SELECT * FROM tbl_userlogs";
                  $result = $conn->query($sqltran);
                  if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td scope="row">' . $row["username"]. '</td>
                                <td>' . $row["loggedInDate"] .'</td>
                                <td> '.$row["role"] .'</td>
                              </tr>';
                    }
                  } else {
                      echo "0 results";
                  } 
                  ?>
                </tbody>
              </table>
            </div>
            <!-- end table for user login -->

            <!-- TABLE FOR ACTIONS DONE IN THE ADMIN SIDE -->      
            <div id = "user_actionlogs" class="table responsive">
              <table  class="table table-striped">                     
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Actions</th>
                    <th>Updated Fieldname</th>
                    <th>Updated Date</th>
                    <th>New Value</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    include('connect.php');
                    $sqltran = "SELECT * FROM tbl_useractionlogs";
                    $result = $conn->query($sqltran);
                    if ($result->num_rows > 0) {
                        // output data of each row
                      while($row = $result->fetch_assoc()) {
                      echo '<tr>
                              <td scope="row">' . $row["username"]. '</td>
                              <td>' . $row["action"] .'</td>
                              <td>' . $row["updated_fieldname"] .'</td>
                              <td> '.$row["updated_date"] .'</td>
                               <td> '.$row["new_value"] .'</td>
                            </tr>';
                          }
                        } else {
                      echo "0 results";
                        } 
                    ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
  <!-- javascript -->
      <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
      <script type="text/javascript" src="js/jquery.dataTables.js"></script>
      <script type="text/javascript" src="js/bootstrap.js"></script>  
      <script type="text/javascript" src="js/material.js"></script>
      <script type="text/javascript" src="js/jquery.dropdown.js"></script>
      <script type="text/javascript" src="js/dataTables.material.js"></script> 
      <script type="text/javascript" src="js/bootstrap-clockpicker.js"></script>
      <script type="text/javascript" src="js/tether.js"></script>
      <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
      <script type="text/javascript" src="js/bootstrap.js"></script>
      <script type="text/javascript" src="js/material.js"></script>

      <script type="text/javascript">
        var idleTime = 0;
        function anotherfunction(){
          $('#sureroll').modal('show');
          $('#myModal').modal('hide');
        }
        function openNav() {
            document.getElementById("mySidenav").style.width = "300px";
            document.getElementById("main").style.marginLeft = "300px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
        }  
      </script>
      <script type="text/javascript">
        $.material.init();
        $(document).ready(function() {
         //$('select').material_select();
        $('#user_actionlogs').hide();
        $('#user_logins').show();
        });

        $("#userlogin").click(function(){
        $('#user_actionlogs').hide();
        $('#user_logins').show();
        });

        $("#useractionlogin").click(function(){
        $('#user_actionlogs').show();
        $('#user_logins').hide();
        });
        $(function () {

          var defaultselectbox = $('#cusSelectbox');
          var numOfOptions = $('#cusSelectbox').children('option').length;

          // hide select tag
          defaultselectbox.addClass('s-hidden');

          // wrapping default selectbox into custom select block
          defaultselectbox.wrap('<div class="cusSelBlock"></div>');

          // creating custom select div
          defaultselectbox.after('<div class="selectLabel"></div>');

          // getting default select box selected value
          $('.selectLabel').text(defaultselectbox.children('option').eq(0).text());

          // appending options to custom un-ordered list tag
          var cusList = $('<ul/>', { 'class': 'options'} ).insertAfter($('.selectLabel'));

          // generating custom list items
          for(var i=0; i< numOfOptions; i++) {
            $('<li/>', {
            text: defaultselectbox.children('option').eq(i).text(),
            rel: defaultselectbox.children('option').eq(i).val()
            }).appendTo(cusList);
          }

          // open-list and close-list items functions
          function openList() {
            for(var i=0; i< numOfOptions; i++) {
              $('.options').children('li').eq(i).attr('tabindex', i).css(
                'transform', 'translateY('+(i*100+100)+'%)').css(
                'transition-delay', i*30+'ms');
            }
          }

          function closeList() {
            for(var i=0; i< numOfOptions; i++) {
              $('.options').children('li').eq(i).css(
                'transform', 'translateY('+i*0+'px)').css('transition-delay', i*0+'ms');
            }
            $('.options').children('li').eq(1).css('transform', 'translateY('+2+'px)');
            $('.options').children('li').eq(2).css('transform', 'translateY('+4+'px)');
          }

          // click event functions
          $('.selectLabel').click(function () {
            $(this).toggleClass('active');
            if( $(this).hasClass('active') ) {
              openList();
              focusItems();
            }
            else {
              closeList();
            }
          });

          $(".options li").on('keypress click', function(e) {
            e.preventDefault();
            $('.options li').siblings().removeClass();
            closeList();
            $('.selectLabel').removeClass('active');
            $('.selectLabel').text($(this).text());
            defaultselectbox.val($(this).text());
            $('.selected-item p span').text($('.selectLabel').text());
          });
          
        });

          function focusItems() {

            $('.options').on('focus', 'li', function() {
              $this = $(this);
              $this.addClass('active').siblings().removeClass();
            }).on('keydown', 'li', function(e) {
              $this = $(this);
              if (e.keyCode == 40) {
                $this.next().focus();
                return false;
              } else if (e.keyCode == 38) {
                $this.prev().focus();
                return false;
              }
            }).find('li').first().focus();

          }
      </script>

      <script src="js/bootstrap.min.js"></script>
      <script src="js/jquery-1.11.1.min.js"></script>
      <script src="js/bootstrap-table.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>
    </div>
    </body>
</html>