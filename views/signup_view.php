<html>
<head>
<script src="http://cs-server.usc.edu:65432/CodeIgniter/assets/js/signup.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" media="screen and (max-width: 800px)" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
<link rel="stylesheet" type:"css/text" media="screen and (max-width: 800px)" href="http://cs-server.usc.edu:65432/CodeIgniter/assets/css/home_mob.css">
<link rel="stylesheet" type:"css/text" media="screen and (min-width: 801px)" href="http://cs-server.usc.edu:65432/CodeIgniter/assets/css/home.css">
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script> 
$(document).ready(function(){
  $("#more").click(function(){
    $("#show").slideToggle("slow");
  });
});
</script>
</head>
<body style="margin:0px;">
<div id="one">
<div data-role="page" id="pageone">
  <div data-role="header" id="header">
  <br>
   <form action="search" method="post" onsubmit="return check();">
<select class="texts" id="desig" name="designation" >
<option value=""  selected>All</option>
<?php

foreach($result3 as $val)
{
echo "<option value=".$val['id'].">".$val['type']."</option>";
}
?>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="search" id="search" placeholder="search for Events"  s />&nbsp;&nbsp;
<input type="submit" name="submit" value="Search" id="search_butt"   />
</form></div>
    <div data-role="navbar" id="navbar" >
    <br>
       <a   id="home" href="home">Home</a>
        <a id="items1" href="cart" ><?php echo count($SESSION['cart']); ?></a>
        <a id="more"  >MORE</a><br><br>
      
    </div>
  </div>
  <div id="show" >
  <?php
if(isset($SESSION['name']))
{
echo "<a class='links2'  href='vieworders' style='text-decoration:none;color:white;'>View Orders</a><a class='links2' href='profile' style='text-decoration:none;color:white;'>Update Profile</a><a class='links2' style='text-decoration:none;color: white;' href='logout'>Log Out</a>";
}
else
{
echo "<a class='links2' style='text-decoration:none;color: white;' href='signup'>Sign Up</a><a class='links2' style='text-decoration:none;color: white;' href='login'>Login</a>"; 
}
 ?>
</div>
  <div data-role="main" class="ui-content" style="padding-left:4px;padding-right:4px;">
<div id="signup">
<br>
<?php echo $message; ?>
<br>
<form id ="sign" <?php if($set==1){echo "style='display:none;'";} ?> action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return formcheck1()" style="color:white" >
<label class="texts" style="padding-right: 70%;">Full Name</label><br>
<input type="text" name="name" class="vals" id="name1" onblur="verifytext1(this);" style="width: 300px;
height: 35px;"/><br>
<label class="error" id="namelb1" style="padding-right: 30%;"><?php echo $nameerr; ?></label><br><br>
<label class="texts" style="padding-right: 70%;">Email Id</label><br>
<input type="text" name="email" class="vals" id="email1" style="width: 300px;
height: 35px;" onblur="verifyemail1(this);"/><br>
<label class="error" id="elb1" style="padding-right: 30%;"><?php echo $emailerr; ?></label><br><br>
<label class="texts" style="padding-right: 70%;">Password</label><br>
<input type="password" name="password" style="width: 300px;
height: 35px;" class="vals" id="pass" onblur="verifypass1(this)"/><br>
<label class="error" id="plb1" style="color:red;">should contain only numbers and alphabets</label><br><br>
<label class="texts" style="padding-right: 60%;">Phone Number</label><br>
<input type="text" name="phone" style="width: 300px;
height: 35px;" class="vals" id="phone" onblur="verifynumber1(this);" />
<label class="error" id="nlb1"></label><br><br>
<label class="texts" style="padding-right: 66%;">Address</label><br>
<textarea rows="4" id="addr1" name="address" cols="20" style="padding-right: 70px;" onblur="verifyaddr1(this);"></textarea>
<label class="error" id="alb1" style="padding-right: 30%;"><?php echo $adderr; ?></label><br><br>
<input type="submit" id="submit" name="name1" value="Sign Up"  />
<?php
$this->load->library('form_validation');
echo validation_errors(); 
?>
<br><br>
</form>
</div>
</div> 
</div>
</div>
<div id="two" style="width:100%;height:100%;">
<div id="top">
<div id="in_top">
<a id="home" href="home">Home</a>
<div style="float:left;margin-left: 50px;">
<form action="search" method="post" onsubmit="return check();">
<select class="texts" id="desig" name="designation">
<option value=""  selected>All</option>
<?php

foreach($result3 as $val)
{
echo "<option value=".$val['id'].">".$val['type']."</option>";
}
?>
</select>
<input type="text" name="search" id="search" placeholder="search for Events" />
<input type="submit" name="submit" value="Search" id="search_butt"/>
</form>
</div>
<div id="ddd" style="color:black;height:60px;">
<div style="float:left;margin-top: 25px;">
<?php if(isset($SESSION['name'])){echo "<label style='margin-top: 30px;text-decoration:none;display:inline;color: white;'>Welcome ".$SESSION['name']."</label><br>";}else{echo "<a class='links2' style='margin-top: 30px;text-decoration:none;display:inline;color: white;' href='signup'>Sign Up</a>&nbsp;&nbsp;&nbsp;"; }?>
<?php if(!(isset($SESSION['name']))){echo "<a class='links2' style='margin-top: 30px;text-decoration:none;display:inline;color: white;' href='login'>Login</a>"; }?>
</div>
</div>
</div>
<div id="cart" style="color:white;"><br><a id="items" href="cart" style="background-image:url('http://cs-server.usc.edu:65432/CodeIgniter/assets/upload/cart.png');width:100px;height:60px;background-size:cover;padding: 30px;padding-top: 27px;padding-right: 45px;color: yellow;font-size: 20px;border-bottom: 2px solid yellow;"><?php echo count($SESSION['cart']); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($SESSION['name'])){echo "<a class='links2'  href='vieworders' style='color:white;'>View Orders</a>&nbsp;&nbsp;&nbsp;<a class='links2' href='profile' style='color:white;'>Update Profile</a>&nbsp;&nbsp;<a class='links2' style='margin-top: 30px;text-decoration:underline;display:inline;color: white;font-size: 20px; margin-left: 10;' href='logout'>Log Out</a>";}?></div>
</div>
<br><br><br><br><br><br><br>
<div id="signup">
<br>
<?php echo $message; ?>
<br>
<form id ="sign" <?php if($set==1){echo "style='display:none;'";} ?> action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" onsubmit="return formcheck()" style="margin-left:30px;color:white" >
<label style="font-size:25px;margin-left:80px;">Sign up</label><br><br>
<label class="texts">Full Name</label><br>
<input type="text" name="name" class="vals" id="name" onblur="verifytext(this);"/><br>
<label class="error" id="namelb"><?php echo $nameerr; ?></label><br><br>
<label class="texts">Email Id</label><br>
<input type="text" name="email" class="vals" id="email" onblur="verifyemail(this);"/><br>
<label class="error" id="elb"><?php echo $emailerr; ?></label><br><br>
<label class="texts">Password</label><br>
<input type="password" name="password" class="vals" id="pass" onblur="verifypass(this)"/><br>
<label class="error" id="plb">should contain only numbers and alphabets</label><br><br>
<label class="texts">Phone Number</label><br>
<input type="text" name="phone" class="vals" id="phone" onblur="verifynumber(this);" />
<label class="error" id="nlb"></label><br><br>
<label class="texts">Address</label><br>
<textarea rows="4" id="addr" name="address" cols="20" onblur="verifyaddr(this);"></textarea>
<label class="error" id="alb"><?php echo $adderr; ?></label><br><br>
<input type="submit" id="submit" name="name1" value="Sign Up"  />
<?php
$this->load->library('form_validation');
echo validation_errors(); 
?>
<br><br>
</form>
<div>

<script>
function hidesign()
{
$(document).ready(function(){
  $('#sign').css('display', 'none');
});
}

function checkuser1(x)
{ 
  var str=x;
  var text;
 if (str=="") {
  return;
  } 
  
  else
   { 
   $(document).ready(function(){
    $.ajax({
    type: "GET",
    url: "http://cs-server.usc.edu:65432/CodeIgniter/index.php/checkemail/index", 
  data: {q: str},
    success: function(msg) {
       if(msg==1)
       {
	   $("#elb1").html("email id already exists");
	   $("#elb1").css('display', 'block');
	   $("#elb1").css('visibility', 'visible');
	    form_check[1]=0;
	    return;
	   }
	   else
       {
       $("#elb1").html("");
       return;
       }
    }
    
});
});
   
 
}
}

function verifytext1(x)
{
var i=0,flb;
var fname= x.value.trim();
//flb=$("#namelb").html();
if(fname)
{
var name = fname.split(" ");
var str=/[^a-zA-Z]+/;
for(i=0;i<name.length;i++)
{
 if(name[i].match(str))
 {
$("#namelb1").html("Enter valid Name");
$("#namelb1").css('display','block');
$("#namelb1").css('margin-left','30px');
$("#namelb1").css('visibility','visible');

form_check[0]=0;
 }
 else
 {
 $("#namelb1").css('display','none');
$("#namelb1").css('visibility','hidden');
form_check[0]=1;

 }
}
}
else
{
form_check[0]=0;
$("#namelb1").html("name cannot be blank");
$("#namelb1").css('display','block');
$("#namelb1").css('margin-left','30px');
$("#namelb1").css('visibility','visible');

}
}

function verifyemail1(x)
{
var femail= x.value.trim();
//elb=document.getElementById("elb");

if(femail)
{
var str=/^\w+@[a-zA-z]+\.[a-zA-Z]{2,3}$/;
 if(femail.match(str))
 {
 form_check[1]=1;
$("#elb1").css('display','none');
$("#elb1").css('visibility','hidden');
checkuser1(femail);

 }
 else
 {
form_check[1]=0;
$("#elb1").html("invalid email id");
$("#elb1").css('display','block');
$("#elb1").css('margin-left','30px');
$("#elb1").css('visibility','visible');
 }
}
else
{
form_check[1]=0;

$("#elb1").html("email id cannot be blank");
$("#elb1").css('display','block');
$("#elb1").css('margin-left','30px');
$("#elb1").css('visibility','visible');
}
}


function verifynumber1(x)
{
var pnumber=x.value.trim();
var length=pnumber.length;
var str=/[^0-9]+/;
if(pnumber.match(str))
{
 form_check[3]=0;
 $("#nlb1").html("Enter valid phone number");
$("#nlb1").css('display','block');
$("#nlb1").css('margin-left','30px');
$("#nlb1").css('visibility','visible');
}
else
{
 
 if(length==10)
 {
 form_check[3]=1;
$("#nlb1").css('display','none');
$("#nlb1").css('visibility','hidden');
 }
 else
 {
 form_check[3]=0;
$("#nlb1").html("Enter 10 digits phone number");
$("#nlb1").css('display','block');
$("#nlb1").css('margin-left','30px');
$("#nlb1").css('visibility','visible');
 
 }
}
}

function verifypass1(x)
{

var pass=x.value.trim();
var str1=/[^a-zA-Z0-9]+/;
var length=pass.length;
if(pass=="")
{
form_check[2]=0;
 $("#plb1").html("Password connot be empty");
$("#plb1").css('display','block');
$("#plb1").css('margin-left','30px');
$("#plb1").css('visibility','visible');

}
else if(length <4 || length >12)
 {
 form_check[2]=0;
$("#plb1").html("Password should be between 4 to 12 charecters");
$("#plb1").css('display','block');

$("#plb1").css('visibility','visible');
 }
 else if(pass.match(str1))
 {
  form_check[2]=0;
$("#plb1").html("Password cannot have special charecters");
$("#plb1").css('display','block');

$("#plb1").css('visibility','visible');
 }
else
 {
  form_check[2]=1;
 $("#plb1").css('display','none');
$("#plb1").css('visibility','hidden');
 }
}

function verifyaddr1(x)
{
var pass=x.value.trim();
var str1=/[^a-zA-Z0-9\#\,\-\n ]+/;

if(!(pass))
{
$("#alb1").html("Address cannot be empty");
$("#alb1").css('display','block');

$("#alb1").css('visibility','visible');
	form_check[4]=0;
	

}
else
{
if(pass.match(str1))
 {
 $("#alb1").html("Enter valid address");
$("#alb1").css('display','block');

$("#alb1").css('visibility','visible');
  
	form_check[4]=0;
 }
 else
  {
  form_check[4]=1;
 
 $("#alb1").css('display','none');
$("#alb1").css('visibility','hidden');
  }
}
}



function formcheck1()
{
var i=0;
var flag=0;
for(i=0;i<form_check.length;i++)
   {
    if(form_check[i]==0)
     {
      flag=1;
      
      }
   }
   if(flag)
   {
   return false;
    }
    else
    {
    return true;
    }
}


</script>  
</body>
</html>
