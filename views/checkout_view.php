<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" media="screen and (max-width: 800px)" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
<link rel="stylesheet" type:"css/text" media="screen and (max-width: 800px)" href="http://cs-server.usc.edu:65432/CodeIgniter/assets/css/home_mob.css">
<link rel="stylesheet" type:"css/text" media="screen and (min-width: 801px)" href="http://cs-server.usc.edu:65432/CodeIgniter/assets/css/home.css">
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://cs-server.usc.edu:65432/CodeIgniter/assets/js/home.js"></script>
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
<div id="pay"  >
<?php echo $message; ?>
<form  action="checkout" method="POST" onsubmit="return formcheckone1()" style="<?php if($flag == 1){echo 'display:none;';} ?>margin-left:40px">
<label style="font-size: 25px;">Billing Informaton</label><br><br>
<hr>
<label style="margin-left: 50px;font-size: 25px;">Card Information</label><br><br>
<label class="payment">Credit or Debit Card number</label><br>
<input type="number" class="payment1" name="number" id="cnumber1" maxlength="16" style="width: 300px;" /><br>
<label id="errnum1" class="error"></label><br>
<label class="payment">Expiry Date</label><br>
<input type="number" class="payment1" style="width: 50px;" name="month" id="month1" maxlength="2" placeholder="mm" />&nbsp;<label>/</label>&nbsp;<input type="number" class="payment1" style="width: 50px;" name="year" id="year1" maxlength="2" placeholder="yy" /><br>
<label id="errexpire1" class="error"></label>
<br>
<label class="payment">CSV</label><br>
<input type="number" class="payment1" style="width: 80px;" name="csv" id="csv1" maxlength="3"/ ><br>
<label id="errcsv1" class="error"></label>
<br>
<hr>
<label style="margin-left: 20px;font-size: 25px;">Shipping information</label><br><br>
<label class="payment">Name</label><br>
<input type="text" class="payment1" name="name" id="name1"  value="<?php echo $name; ?>" /><br>
<label id="errname1" class="error"></label>
<br>

<label class="payment">Complete Shipping Address</label><br>
<textarea id="address1" name="address" rows="6" cols="20" style="font-size:18px;" ><?php echo $address ?></textarea><br>
<label id="erraddr1" class="error"></label>
<br>
<label id="errall1" class="error"></label>

<hr>
<input type="submit" name="submit" value="PAY" id="pay1" style="margin-left:100px; width:150px; font-size:20px;padding:4px;"/><br>
<?php
$this->load->library('form_validation');
echo validation_errors(); 
echo $exerr;
echo $namerr;
echo $adderr;
?>
</form>
<br><br>
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
<br><br><br><br><br>
<div id="main">
<div id="summary" style="text-align:center;font-size: 30px;float:left;"><label>Order Summary</label><br>
<hr>
<?php
echo $content;
?>
</div>
<div id="pay"  >
<?php echo $message; ?>
<form  action="checkout" method="POST" onsubmit="return formcheckone()" style="<?php if($flag == 1){echo 'display:none;';} ?>margin-left:40px">
<label style="margin-left: 250px;font-size: 25px;">Billing Informaton</label><br><br>
<hr>
<label style="margin-left: 50px;font-size: 25px;">Card Information</label><br><br>
<label class="payment">Credit or Debit Card number</label><br>
<input type="text" class="payment1" name="number" id="cnumber" maxlength="16" /><br>
<label id="errnum" class="error"></label><br>
<label class="payment">Expiry Date</label><br>
<input type="text" class="payment1" name="month" id="month" maxlength="2" placeholder="mm" />&nbsp;<label>/</label>&nbsp;<input type="text" class="payment1" name="year" id="year" maxlength="2" placeholder="yy" /><br>
<label id="errexpire" class="error"></label>
<br>
<label class="payment">CSV</label><br>
<input type="text" class="payment1" name="csv" id="csv" maxlength="3"/ ><br>
<label id="errcsv" class="error"></label>
<br>
<hr>
<label style="margin-left: 20px;font-size: 25px;">Shipping information</label><br><br>
<label class="payment">Name</label><br>
<input type="text" class="payment1" name="name" id="name"  value="<?php echo $name; ?>" /><br>
<label id="errname" class="error"></label>
<br>

<label class="payment">Complete Shipping Address</label><br>
<textarea id="address" name="address" rows="6" cols="30" style="font-size:18px;" ><?php echo $address ?></textarea><br>
<label id="erraddr" class="error"></label>
<br>
<label id="errall" class="error"></label>

<hr>
<input type="submit" name="submit" value="PAY" id="pay1" style="margin-left:100px; width:150px; font-size:20px;padding:4px;"/><br>
<?php
$this->load->library('form_validation');
echo validation_errors(); 
echo $exerr;
echo $namerr;
echo $adderr;
?>
</form>
<br><br>
</div>
<br><br>
</div>
<script>
var formcheck=[0,0,0,0,1,1];
function formcheckone()
{


var i=0;
var flag=1;
for(i=0;i<formcheck.length;i++)
{
if(formcheck[i]==0)
{
flag=0;
break;
}
}
if(flag)
{
return true;
}
else
{
$("#errall").html("Please fill all fields");
$("#errall").css('display', 'block');
return false;
}
}
$(document).ready(function(){
$("#cnumber").blur(function()
{
var number =$(this).val().trim();


var str=/[^0-9]+/;

if(number.length < 16 || number.length >16)
{
$("#errnum").html("Invalid card number");
$("#errnum").css('display', 'block');
}
else if(number.match(str))
{
$("#errnum").html("Invalid card number");
$("#errnum").css('display', 'block');

}
else
{
$("#errnum").html("");
$("#errnum").css('display', 'none');
formcheck[0]=1;
}

});
});

$(document).ready(function(){
$("#month").blur(function()
{
var number =$(this).val().trim();

var str=/[^0-9]+/;

if(number.length < 2 || number.length >2)
{
$("#errexpire").html("Invalid month");
$("#errexpire").css('display', 'block');
}
else if(number.match(str))
{
$("#errexpire").html("Invalid month");
$("#errexpire").css('display', 'block');

}
else if(number >12 || number == "00")
{
$("#errexpire").html("Invalid month");
$("#errexpire").css('display', 'block');
}
else
{
$("#errexpire").html("");
$("#errexpire").css('display', 'none');
formcheck[1]=1;
}

});
});

$(document).ready(function(){
$("#year").blur(function()
{
var number =$(this).val().trim();

var str=/[^0-9]+/;

if(number.length < 2 || number.length >2)
{
$("#errexpire").html("Invalid year");
$("#errexpire").css('display', 'block');
}
else if(number.match(str))
{
$("#errexpire").html("Invalid year");
$("#errexpire").css('display', 'block');

}
else if(number < 14)
{
$("#errexpire").html("Invalid year");
$("#errexpire").css('display', 'block');
}
else
{
$("#errexpire").html("");
$("#errexpire").css('display', 'none');
formcheck[2]=1;
}

});
});

$(document).ready(function(){
$("#csv").blur(function()
{
var number =$(this).val().trim();

var str=/[^0-9]+/;

if(number.length < 3 || number.length >3)
{
$("#errcsv").html("Invalid csv");
$("#errcsv").css('display', 'block');
}
else if(number.match(str))
{
$("#errcsv").html("Invalid csv");
$("#errcsv").css('display', 'block');

}
else
{
$("#errcsv").html("");
$("#errcsv").css('display', 'none');
formcheck[3]=1;
}

});
});

$(document).ready(function(){
$("#name").blur(function()
{
var number =$(this).val().trim();
var str=/[^a-zA-Z ]+/;

if(!(number))
{
formcheck[4]=0;
$("#errname").html("Name cannot be empty");
$("#errname").css('display', 'block');
}
else if(number.match(str))
{
$("#errname").html("Invalid charecters in the name");
$("#errname").css('display', 'block');
formcheck[4]=0;
}
else
{
$("#errname").html("");
$("#errname").css('display', 'none');
formcheck[4]=1;
}

});
});

$(document).ready(function(){
$( "#address" ).blur(function()
{
var number =$(this).val().trim();
var err =document.getElementById('erraddr');
var str = /[^a-zA-Z0-9\#\,\-\n ]+/;

if(!(number))
{
$("#erraddr").html("Address cannot be empty");
$("#erraddr").css('display', 'block');
formcheck[5]=1;
}
else if(number.match(str))
{
$("#erraddr").html("Invalid charecters in address field");
$("#erraddr").css('display', 'block');
formcheck[5]=1;

}
else
{
$("#erraddr").html("");
$("#erraddr").css('display', 'none');
formcheck[5]=1;
}
});
});




</script>
</body>
</html>
