//Author: Kennard, Nour, Farshad and David

function makeResponsive() //this section makes the page responsive
{
    var x = document.getElementById("top");
    if (x.className === "top_navbar") 
    {
        x.className += " responsive";
    } 
    else 
    {
        x.className = "top_navbar";
    }
}
function clearForm()
{
    return confirm("This action will erase the data you have entered. Do you want to continue?");
}
function confirmBooking()
{
    return confirm("Do you want to continue booking this package?");
}
function checkForm(myForm)//this functions checks the booking details page for any empty fields
{
    var message = "";
    if (myForm.TripTypeId.value == "")
    {
        message += "Select trip type. \n";
    }
    if (myForm.DepartureCity.value == "")
    {
        message += "Select your departure city\n";
    }

    if (myForm.CCName.value == "")
    {
        message += "Select your payment card type\n";
    } 
    if (myForm.CCNumber.value == "")
    {
        message += "Enter your card number\n";
    } 
    if (myForm.CCExpiry.value == "")
    {
        message += "Enter card expiry date\n";
    } 

    if (message != "")
    {
        alert(message);
        return false;
    }
    var currrentdate = new DateTime();
    
    if (currrentdate < myForm.CCExpiry.value)
    {
        alert("Card expiry date cannot be less than current date!");
        return false;
    }
    var amRegExp = /^3[0-9]{13}$/;
    var vRegExp = /^4[0-9]{16}$/;
    var dRegExp = /^3[0-9]{11}$/;
    var dcRegExp = /^6[0-9]{14}$/;
    var mcRegExp = /^5[0-9]{16}$/;

    switch (myForm.CCName.value)
    {
        case "AMEX":
            if (!amRegExp.test(myForm.CCNumber.value))
            {
                alert("Card number is not valid!");
                return false;						
            }
            break;
        case "Diners":
            f (!dRegExp.test(myForm.CCNumber.value))
            {
                alert("Card number is not valid!");
                return false;						
            }
            break;
        case "Discover":
            f (!dcRegExp.test(myForm.CCNumber.value))
            {
                alert("Card number is not valid!");
                return false;						
            }
            break;
        case "Mastercard":
            f (!mcRegExp.test(myForm.CCNumber.value))
            {
                alert("Card number is not valid!");
                return false;						
            }
            break;
        case "Visa":
            f (!vRegExp.test(myForm.CCNumber.value))
            {
                alert("Card number is not valid!");
                return false;						
            }
            break;
        default:
            break;
    }

    return true;
}

function styleCardType(elmnt, index) // this function styles the credit card buttons on the booking details page
{
    switch (index)
    {
        case 0:
            elmnt.style.border = "1px solid #039be5";
            document.getElementById("CCName").value = "AMEX";
            document.getElementById("dc").style.border = "none";
            document.getElementById("discover").style.border = "none";
            document.getElementById("mc").style.border = "none";
            document.getElementById("visa").style.border = "none";
            break;
        case 1:
            elmnt.style.border = "1px solid #039be5";
            document.getElementById("CCName").value = "Diners";
            document.getElementById("amex").style.border = "none";
            document.getElementById("discover").style.border = "none";
            document.getElementById("mc").style.border = "none";
            document.getElementById("visa").style.border = "none";
            break;
        case 2:
            elmnt.style.border = "1px solid #039be5";
            document.getElementById("CCName").value = "Discover";
            document.getElementById("dc").style.border = "none";
            document.getElementById("amex").style.border = "none";
            document.getElementById("mc").style.border = "none";
            document.getElementById("visa").style.border = "none";
            break;
        case 3:
            elmnt.style.border = "1px solid #039be5";
            document.getElementById("CCName").value = "Mastercard";
            document.getElementById("dc").style.border = "none";
            document.getElementById("discover").style.border = "none";
            document.getElementById("amex").style.border = "none";
            document.getElementById("visa").style.border = "none";
            break;
        case 4:
            elmnt.style.border = "1px solid #039be5";
            document.getElementById("CCName").value = "Visa";
            document.getElementById("dc").style.border = "none";
            document.getElementById("discover").style.border = "none";
            document.getElementById("mc").style.border = "none";
            document.getElementById("amex").style.border = "none";
            break;
        default:
            break;
    }
}

//this sections is for the register page
//initialize input palceholder
var textid=new Array();
var textdescription=new Array();
var textplaceholder=new Array();
textplaceholder[0]="Enter Username";
textplaceholder[1]="Enter First Name";
textplaceholder[2]="Enter Last Name";
textplaceholder[3]="Enter Email Address";
textplaceholder[4]="Enter Home Phone (Optinal)";
textplaceholder[5]="Enter Work Phone";
textplaceholder[6]="Enter Password";
textplaceholder[7]="Confirm Password";
textplaceholder[8]="Enter Mailing Address";
textplaceholder[9]="Enter Postal Code/Zip";

textplaceholder[10]="Select Province";
textplaceholder[11]="Select City";
textplaceholder[12]="Enter Country";
textid[0]="uname";
textid[1]="fname";
textid[2]="lname";
textid[3]="email";
textid[4]="homephone";
textid[5]="cellphone";
textid[6]="psw";
textid[7]="psw-repeat";
textid[8]="home";
textid[9]="postal";

textid[10]="province";
textid[11]="city";
textid[12]="country";
textdescription[0]="Must be minumum 6 Characters";
textdescription[1]="Please input your first name";
textdescription[2]="Please input your last name";
textdescription[3]="Please input email format,like abs@gamil.com";
textdescription[4]="Enter homephone ex: 403-555-6677";
textdescription[5]="Enter workphone ex: 403-555-6677";
textdescription[6]="Minimun 8 characters, including a capital and a number";
textdescription[7]="Confirm password ";
textdescription[8]="Enter home address";
textdescription[9]="input postal code like T5Y 4X1";
textdescription[10]="select province";
textdescription[11]="Select city" ;
textdescription[12]="input country" ;

function validate(myform) //this function will check if fields are empty and that the passwords match on the registration page
{
   var psw1=document.getElementById("psw").value;
   var psw2=document.getElementById("psw-repeat").value;
   var span1=document.getElementById("wronguser").textContent;
   var province=document.getElementById("province").value;
   var city=document.getElementById("city").value;
    if(myform.CustUserName.value == "")
      {
        alert("Username is required");
        myform.CustUserName.focus();
        return false;
      }
        if (!(span1==""))
        {
            alert("Username already exists!");
            myform.CustUserName.focus();
            return false;
        }

  if(myform.CustFirstName.value == "")
  {
    alert("First Name is required");
    myform.CustFirstName.focus();
    return false;
  }
  if(myform.CustLastName.value == "")
  {
    alert("Last Name is required");
    myform.CustLastName.focus();
    return false;
  }
  if(myform.CustEmail.value == "")
  {
    alert("Email is required");
    myform.CustEmail.focus();
    return false;
  }
  if(myform.CustBusPhone.value == "")
  {
    alert("Work phone is required");
    myform.CustBusPhone.focus();
    return false;
  }
  if(myform.Password.value == "")
  {
    alert("Password is required");
    myform.Password.focus();
    return false;
  }

    if (!(psw1==psw2)) //double check two passwords before submiting
       {
         alert("Passwords do not match!");
         myform.Password.focus();
        return false;
        }

  if(myform.CustAddress.value == "")
  {
    alert("Address is required");
    myform.CustAddress.focus();
    return false;
  }
  if(myform.CustPostal.value == "")
  {
    alert("Postal is required");
    myform.CustPostal.focus();
    return false;
  }
  if(myform.CustProv.value == "")
  {
    alert("Province is required");
    myform.CustProv.focus();
    return false;
  }
  if(myform.CustCity.value == "")
  {
    alert("City is required");
    myform.CustCity.focus();
    return false;
  }
  if(myform.CustCountry.value == "")
  {
    alert("Country is required");
    myform.CustCountry.focus();
    return false;
  }

  return confirm("Do you want to submit your information?");
}

function myclear() //reset elements values in form
{
    var clearanswer=confirm("This action will erase the data you have entered. Do you want to continue?");
    if (clearanswer==true)
    {
     document.getElementById("registerform").reset();
    window.location.href="register.php";
     return false;
    }
    else
    {
      return true;
    }

}
function myhome()
{
     window.location.href="index.php";
     return false;

}
function inputformat(x) // when text is foucused , set background-color is pink
{
for (i=0;i<textid.length;i++)
    {

     if (x.id==textid[i]&&x.value=="") 
         {

           x.style.backgroundColor="lightblue";
           x.title=textdescription[i];
         }
    }

   if (x.id == "psw" || x.id == "psw-repeat")
       {
           document.getElementById("pwd-hint").style.display = 'block';
       }
   if (x.id == "uname")
       {
           document.getElementById("uname-hint").style.display = 'block';
       }
   if (x.id == "email")
       {
           document.getElementById("email-hint").style.display = 'block';
       }
   if (x.id == "postal")
       {
           document.getElementById("code-hint").style.display = 'block';
       }

}
function uninputformat(x)//when text is blured ,then change background -color to normal display
{
for (i=0;i<textid.length;i++)
    {
      if (x.id==textid[i]) 
         {
            x.style.backgroundColor="white";
            x.style.Color="black";
            x.placeholder=textplaceholder[i];
         }
    }
   if (x.id == "psw" || x.id == "psw-repeat")
       {
           document.getElementById("pwd-hint").style.display = 'none';
       }
   if (x.id == "uname")
       {
           document.getElementById("uname-hint").style.display = 'none';
       }
   if (x.id == "email")
       {
           document.getElementById("email-hint").style.display = 'none';
       }
   if (x.id == "postal")
       {
           document.getElementById("code-hint").style.display = 'none';
       }
}	
    
function myselection(select) //this functions gets te data from registration form when a province is selected
{
  var selectedOption=select.options[select.selectedIndex];
  $c=selectedOption.value;
  var $uname=document.getElementById("uname").value;
  var $fname=document.getElementById("fname").value;
  var $lname=document.getElementById("lname").value;
  var $email=document.getElementById("email").value;
  var $homephone=document.getElementById("homephone").value;
  var $cellphone=document.getElementById("cellphone").value;
  var $psw=document.getElementById("psw").value;
  var $psw_repeat=document.getElementById("psw-repeat").value;
  var $home=document.getElementById("home").value;
  var $postal=document.getElementById("postal").value;
  var $country=document.getElementById("country").value;

 window.location.href='php/regpara.php?province='+$c+"&uname="+$uname+"&fname="+$fname+"&lname="+$lname+"&email="+$email+"&homepone="+$homephone+"&cellphone="+$cellphone+"&psw="+$psw+"&psw2="+$psw_repeat+"&home="+$home+"&postal="+$postal+"&country="+$country;	  

}
