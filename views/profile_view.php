<html>
<head>
<script src="http://cs-server.usc.edu:65432/CodeIgniter/assets/js/signup1.js"></script>
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
 <h1>Update profile</h1>
<?php echo $message; ?>
<form id ="sign1" <?php if($set==1){ echo "style='display:none;'";} ?> action="profile" method="post" onsubmit="return formcheck1()" style="margin-left:30px;" >
<label style="font-size:25px;margin-left:80px;"></label><br><br>
<label class="texts">Full Name</label><br>
<input type="text" name="name" class="vals" style="width:250px;height:40px;font-size:25px;" id="name1" value="<?php echo $name ?>" onblur="verifytext1(this);"/><br>
<label class="error" id="namelb1"><?php echo $nameerr; ?></label><br><br>
<label class="texts">Password</label><br>
<input type="password" name="password" class="vals" style="width:250px;height:40px;font-size:25px;" id="pass1" onblur="verifypass1(this)"/><br>
<label class="error" id="plb1">should contain only numbers and alphabets</label><br><br>
<label class="texts">Phone Number</label><br>
<input type="text" name="phone" class="vals" style="width:250px;height:40px;font-size:25px;" id="phone1" value="<?php echo $phone ?>" onblur="verifynumber1(this);" />
<label class="error" id="nlb1"></label><br><br>
<label class="texts">Address</label><br>
<textarea rows="4" id="addr1" name="address" cols="21" style="border:2px solid grey;font-size:23px;" onblur="verifyaddr1(this);"><?php echo $address ?></textarea>
<label class="error" id="alb1"> <?php echo $adderr; ?></label><br><br>
<input type="submit" id="submit" name="name1" value="UPDATE"  />
<?php
$this->load->library('form_validation');
echo validation_errors(); 
?>
<br><br>
</form>
  
  </div>

  <div data-role="footer" style="padding-left:4px;padding-right:4px;">
   
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
<div id="signup" >
<br>
<?php echo $message; ?>
<br>
<form id ="sign" <?php if($set==1){ echo "style='display:none;'";} ?> action="profile" method="post" onsubmit="return formcheck()" style="margin-left:30px;color:white" >
<label style="font-size:25px;margin-left:80px;">Update Profile</label><br><br>
<label class="texts">Full Name</label><br>
<input type="text" name="name" class="vals" id="name" value="<?php echo $name ?>" onblur="verifytext(this);"/><br>
<label class="error" id="namelb"><?php echo $nameerr; ?></label><br><br>
<label class="texts">Password</label><br>
<input type="password" name="password" class="vals" id="pass" onblur="verifypass(this)"/><br>
<label class="error" id="plb">should contain only numbers and alphabets</label><br><br>
<label class="texts">Phone Number</label><br>
<input type="text" name="phone" class="vals" id="phone" value="<?php echo $phone ?>" onblur="verifynumber(this);" />
<label class="error" id="nlb"></label><br><br>
<label class="texts">Address</label><br>
<textarea rows="4" id="addr" name="address" cols="20"  onblur="verifyaddr(this);"><?php echo $address ?></textarea>
<label class="error" id="alb"> <?php echo $adderr; ?></label><br><br>
<input type="submit" id="submit" name="name1" value="UPDATE"  />
<?php
$this->load->library('form_validation');
echo validation_errors(); 
?>
<br><br>
</form>
<div>

<script>
var errflag=1;
var form_check=[1,1,1,1];
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



function verifynumber1(x)
{
var pnumber=x.value.trim();
var length=pnumber.length;
var str=/[^0-9]+/;
if(pnumber.match(str))
{
 form_check[2]=0;
 $("#nlb1").html("Enter valid phone number");
$("#nlb1").css('display','block');
$("#nlb1").css('margin-left','30px');
$("#nlb1").css('visibility','visible');
}
else
{
 
 if(length==10)
 {
 form_check[2]=1;
$("#nlb1").css('display','none');
$("#nlb1").css('visibility','hidden');
 }
 else
 {
 form_check[2]=0;
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
form_check[1]=1;
$("#plb1").css('display','none');
$("#plb1").css('visibility','hidden');

}
else if(length < 4 || length >12)
 {
 form_check[1]=0;
$("#plb1").html("Password should be between 4 to 12 charecters");
$("#plb1").css('display','block');

$("#plb1").css('visibility','visible');
 }
 else if(pass.match(str1))
 {
  form_check[1]=0;
$("#plb1").html("Password cannot have special charecters");
$("#plb1").css('display','block');

$("#plb1").css('visibility','visible');
 }
else
 {
  form_check[1]=1;
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
	form_check[3]=0;
	

}
else
{
if(pass.match(str1))
 {
 $("#alb1").html("Enter valid address");
$("#alb1").css('display','block');

$("#alb1").css('visibility','visible');
  
	form_check[3]=0;
 }
 else
  {
  form_check[3]=1;
 
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



function hidesign()
{
alert(1);
$(document).ready(function(){
  $('#sign').css('display', 'none');
});
}

</script>  
</body>
</html>
