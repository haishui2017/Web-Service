<!--Author: Haishui Zhu 
Course: CPRG210 
Created: Nov 5,2017
-->
<?php
    session_start();
    if (isset($_SESSION["message"]))
    {
        $message = $_SESSION["message"];
        unset($_SESSION["message"]);
    }

    $CustUserName="";
    $CustFirstName="";

    if(isset($_REQUEST["province"]))
    {
    //modified on Nov 14

        $p=(string)$_REQUEST["province"];  
        if (!empty($_SESSION['CustUserName']))
        {$CustUserName=$_SESSION['CustUserName'] ;
        unset($_SESSION['CustUserName']);}

        if (!empty($_SESSION['CustFirstName']))
        {$CustFirstName=$_SESSION['CustFirstName'] ;
        unset($_SESSION['CustFirstName']);}

        if (!empty($_SESSION['CustLastName']))
        {$CustLastName=$_SESSION['CustLastName'] ;
        unset($_SESSION['CustLastName']);}

        if (!empty($_SESSION['CustEmail']))
        {$CustEmail=$_SESSION['CustEmail'] ;
        unset($_SESSION['CustEmail']);}

        if(!empty($_SESSION['CustHomePhone']))
        {$CustHomePhone=$_SESSION['CustHomePhone'] ;
        unset($_SESSION['CustHomePhone']);}
        else
        {$CustHomePhone="";}	

        if(!empty($_SESSION['CustBusPhone']))
        {$CustBusPhone=$_SESSION['CustBusPhone'] ;
        unset($_SESSION['CustBusPhone']);}

        if(!empty($_SESSION['Password']))
        {$Password=$_SESSION['Password'] ;
        unset($_SESSION['Password']);}

        if(!empty($_SESSION['psw-repeat']))
        {$psw_repeat=$_SESSION['psw-repeat'] ;
        unset($_SESSION['psw-repeat']);}

        if(!empty($_SESSION['CustAddress']))
        {$CustAddress=$_SESSION['CustAddress'] ;
        unset($_SESSION['CustAddress']);}

        if(!empty($_SESSION['CustPostal']))
        {$CustPostal=$_SESSION['CustPostal'] ;
        unset($_SESSION['CustPostal']);}

        if(!empty($_SESSION['CustCountry']))
        {$CustCountry=$_SESSION['CustCountry'] ;
        unset($_SESSION['CustCountry']);}
    } 
    else
    {
        $p="";
    }  

?>
<!DOCTYPE html>
<!-- All of pictures images and css ,js ,Jquery file  are placed IN register folder-->
<html>
    <head>
        <title>Travel Experts</title>
        <meta charset="utf-8"/>
        <link rel="icon" type="image/gif/png" href="media/icons/plane.png">
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href='https://fonts.googleapis.com/css?family=Duru Sans' rel='stylesheet'>
        <link rel="stylesheet" href="css/nav_styles.css">
        <link rel="stylesheet" href="css/main_styles.css" />
        <link rel="stylesheet" href="css/register_styles.css" type="text/css">
        <script type="text/javascript" src="scripts/scripts.js"></script>
        <script src="scripts/jquery.min.js"></script>
        <script src="scripts/bootstrap.min.js"></script>

        <script>
            $(document).ready(function(){ 
                $('#psw-repeat').keyup(function(){ // which is for comparing password and confirmation 
                var pass    =   $('#psw').val();
                var cpass   =   $('#psw-repeat').val();
                var re=new RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/);
                if(pass==cpass && re.test(cpass)&&re.test(pass))
                {
                    $('#psw-repeat').css('background-image','url(media/icons/valid.png)');//when two passwords do match,green thumb will show
                }
                else
                {
                    $('#psw-repeat').css('background-image','url(media/icons/invalid.png)');//when two passwords does not match,red thumb will show
                }
                });
                $('#psw').keyup(function(){ // which is for comparing password and confirmation 
                var pass    =   $('#psw').val();
                var cpass   =   $('#psw-repeat').val();
                var re=new RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/);
                if(pass==cpass && re.test(cpass)&&re.test(pass))
                {
                    $('#psw-repeat').css('background-image','url(media/icons/valid.png)');//when two passwords do match,green thumb will show
                }
                else
                {
                    $('#psw-repeat').css('background-image','url(media/icons/invalid.png)');//when two passwords does not match,red thumb will show
                }
                });
                $("#uname").keyup(function(){
                    var VAL = this.value;
                    var username = new RegExp('^.{6,}$');

                    if (username.test(VAL)) 
                    {
                        $('#uname').css('background-image','url(media/icons/valid.png)');
                        var name= $("#uname").val();
                        $.post("server/reguserexist.php", {lname:name} ,function(data){//connect to MySql by t1.php file to test whether there is a same user name in it.
                        if(data>0)
                        { $('#uname').css('background-image','url(media/icons/invalid.png)');
                        $('#wronguser').css({color: "red"})
                        $('#wronguser').text("User name already exists");
                        }
                        else 
                        { $('#uname').css('background-image','url(media/icons/valid.png)');
                        $('#wronguser').text("");
                        }
                        });
                    }
                    else
                    {
                        $('#uname').css('background-image','url(media/icons/invalid.png)');	
                    }
                });
            });  
        </script>
    </head>
    <body>
        <div class="body-container">
            <div class="body-border">

            <!--navigation section-->
            <?php
            include("navigation.php"); 
            if (isset($_SESSION["loggedin"]))
            {
            $user_status = "Logout";
            $go_to = "logout.php";
            }	
            else
            {
            $user_status = "Login";
            $go_to = "login.php";
            }
            ?>

            <div class="reg-main">  
            <div class="reg-container" >        
                <h2>Create your Travel Experts Account</h2>
                <h2><?php (isset($message)) ? print($message) : print("") ; ?></h2><br/>
                    <form name="mainform" method="post" action="php/regsavecustomer.php"  id="registerform">
                    <div class="reg-group">
                        <span id="wronguser"></span>
                        <div class="reg-col"> 
                            <input class="form-control " type="text" id="uname" placeholder="Enter Username" name="CustUserName" required="required"  title="Username must have minimum of 6 characters" pattern="^.{6,24}$" onfocus="inputformat(this)"  onblur="uninputformat(this)" value="<?php (isset($CustUserName)) ? print($CustUserName) : print("") ?>">
                        </div>
                    </div>		
                    <div id="uname-hint"><label>Username must have minimum of 6 characters</label></div>
                    <div class="reg-group">
                        <div class="reg-col">
                            <input type="text" class="form-control" placeholder="Enter First Name" name="CustFirstName" id="fname" required="required" title="FirstName is required." onfocus="inputformat(this)"  onblur="uninputformat(this)" value="<?php (isset($CustFirstName)) ? print($CustFirstName) : print("") ; ?>">
                        </div>
                        <div class="reg-col">
                            <input type="text" class="form-control" placeholder="Enter Last Name" name="CustLastName" id="lname" required="required"  title="LastName is required." onfocus="inputformat(this)"  onblur="uninputformat(this)" value="<?php (isset($CustLastName)) ? print($CustLastName) : print("") ;?>">
                        </div>
                    </div>		
                    <div class="reg-group">
                        <div class="reg-col">
                            <input class="form-control" type="text" id="email" placeholder="Enter Email Address" name="CustEmail" title="ex: myname@example.com" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required="required" onfocus="inputformat(this)"  onblur="uninputformat(this)" value="<?php (isset($CustEmail)) ? print($CustEmail) : print("") ; ?>">
                        </div>
                    </div>
                    <div id="email-hint"><label>Ex: myname@example.com</label></div>
                    <div class="reg-group">
                        <div class="reg-col" style="float: left; width: 50%;">
                            <input class="form-control" type="text" id="homephone" placeholder="Enter Home Phone(optional)"  name="CustHomePhone" title="Homephone is optional." pattern="^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$" onfocus="inputformat(this)"  onblur="uninputformat(this)" value="<?php (isset($CustHomePhone)) ? print($CustHomePhone) : print("") ; ?>" >
                        </div>
                        <div class="reg-col" style="float: left; width: 50%;">
                            <input class="form-control" type="text" id="cellphone" placeholder="Enter Work Phone" name="CustBusPhone" required="required" pattern="^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$" title="Business Phone is required." onfocus="inputformat(this)"  onblur="uninputformat(this)" value="<?php (isset($CustBusPhone)) ? print($CustBusPhone) : print("") ; ?>">
                        </div>
                    </div>
                    <div class="reg-group">
                        <div class="reg-col" style="float: left; width: 50%;">
                            <input type="password" class="form-control" placeholder="Enter Password" name="Password" id="psw" required="required" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" title="Minimun 8 characters, including a capital and a number" onfocus="inputformat(this)"  onblur="uninputformat(this)" value="<?php (isset($Password)) ? print($Password) : print("") ; ?>">
                        </div>
                        <div class="reg-col" style="float: left; width: 50%;">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="psw-repeat" id="psw-repeat" required="required" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$" title="Keep confirmation password same." onfocus="inputformat(this)"  onblur="uninputformat(this)" value="<?php (isset($psw_repeat)) ? print($psw_repeat) : print("") ; ?>" >
                        </div>
                    </div>
                    <div id="pwd-hint"><label>Minimun 8 characters, including a lowercase, a capital and a number</label></div>
                    <div class="reg-group">  
                        <div class="reg-col" style="float: left; width: 50%;" >
                            <input class="form-control" type="text" id="home" placeholder="Enter Mailing Address" name="CustAddress" title="Address is required." required="required"  onfocus="inputformat(this)"  onblur="uninputformat(this)" value="<?php (isset($CustAddress)) ? print($CustAddress) : print("") ; ?>" >
                        </div>
                        <div class="reg-col" style="float: left; width: 50%;">
                            <input class="form-control" type="text" id="postal" placeholder="Enter Postal Code/Zip" name="CustPostal" required="required" title="Postal Code: A1A1A1 or Zip: 12345" pattern="^[a-zA-Z]\d[a-zA-Z]\s?\d[a-zA-Z]\d$|^\d{5}$" onfocus="inputformat(this)"  onblur="uninputformat(this)" value="<?php (isset($CustPostal)) ? print($CustPostal) : print("") ; ?>">
                        </div>
                    </div>
                    <div id="code-hint"><label>Postal Code: A1A1A1 or Zip: 12345</label></div>
                    <div class="reg-group">
                        <div class="reg-col"  style="float: left; width: 33%;">
                            <select name="CustProv" id="province" class="form-control" required="required" onchange="myselection(this)" title="Please select your province(required).">
                            <option value="">Choose Your Province </option>
                            <?php
                            include("server/conn.php");
                            $dbh = mysqli_connect($host, $user, $password, $dbname);
                            if (!$dbh)
                            {
                            print(mysqli_connect_error() . "<br />");
                            // print("failed connected");
                            exit();
                            }
                            if ($result = mysqli_query($dbh, "SELECT distinct(province) FROM cities order by province"))
                            {
                            while ($row = mysqli_fetch_row($result))//only one record
                            { ?> 
                            <option value="<?php echo $row[0] ;?>" <?php if (isset($p)&&($row[0]==$p)) { echo 'selected' ;}  ?>><?php echo $row[0];?></option>;
                            <?php	}
                            }

                            ?>    

                            </select>
                        </div>

                        <div class="reg-col"  style="float: left; width: 33%;">
                            <select id="city" class="form-control" name="CustCity" required="required" title="Please select your city (required)." >
                            <option value="">Choose Your city </option>
                            <?php if ($result = mysqli_query($dbh, "SELECT city FROM cities where province='".$p."'"))
                            {
                            //print("result is ok"); 
                            while ($row = mysqli_fetch_row($result))//only one record
                            { ?> 
                            <option value="<?php echo $row[0] ;?>" ><?php echo $row[0];?></option>
                            <?php 
                            }
                            }                                    
                            mysqli_close($dbh);
                            ?>
                            </select>
                        </div>
                        <div class="reg-col"  style="float: left; width: 33%;">
                            <input class="form-control" type="text" id="country" placeholder="Enter Country" pattern="^\w{2,16}$" name="CustCountry" required="required" onfocus="inputformat(this)"  onblur="uninputformat(this)" title="Country is required." value="<?php (isset($CustCountry)) ? print($CustCountry) : print("") ;?>">
                        </div>
                    </div> 

                    <div class="reg-btn-col">	 
                        <button id="regBtn" class="button" style="background-color: #039be5;" onclick="return validate(this.form)"><span>Submit</span></button>
                        <button type="reset" id="resetBtn" class="button" style="background-color: #1a3749;" onclick="return myclear()">Reset</button>
                    </div>

                </form>
                </div>
            </div>
                
            <?php
                include("footer.php")
            ?>
            </div>
        </div>
    </body>
</html>