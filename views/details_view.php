<html>
<head>
<script src="http://cs-server.usc.edu:65432/CodeIgniter/assets/js/home.js"></script>
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

    <?php
    
    echo "<div style='margin-left: 2px;'>";
 if(!(empty($row->image1)))
 {
 echo "<br><br><div id='imagediv1'  style=\"background-image: url('http://cs-server.usc.edu:65432/CodeIgniter/assets/".$row->image1."');width:350px;height:200px;background-size:'cover';\"></div><div id='price'>
 <label style='font-size: 20px;color: green;'>Price: $".$row->price."</label><br><br>";
 if(!(empty($offer)))
 {
 echo "<label style='font-size: 25px;color: red;'>Special Price: $".$row->disprice."</label><br><br>";
 }
 echo "<input type='button' value='Add To Cart' class='cart' id='".$row->eventid."' onclick='updatecart(this)' /><br>";
 echo "</div><br><br>";
 }
 echo "<label id='eventname'>".$row->eventname."</label><br>";
 echo "<label class='eventdetails'>Venue:".$row->venue."</label><br>";
  echo "<label class='eventdetails'>Date:".$date."</label><br>";
  echo "<label class='eventdetails'>Organiser:".$row->organiser."</label><br>";
  echo "<label class='eventdetails'>Total Entries:".$row->entry."</label><br><br>";
  echo "<label class='eventdetails'><b>DETAILS :</b></label><br><br>";
  echo "<label class='eventdetails'>".$row->details."</label><br><br>";
 echo "</div><br><br><label style='font-size:25px;color:red;'>special offer Events relatted to this..</label><br><br>";
 $flag=1;
 foreach($result as $row1)
 {
 if(!($row1['eventid']==$productid))
 {
 echo "<a style='' href='details?q=".$row1['eventid']."'><img style='border:1px solid red;' src='http://cs-server.usc.edu:65432/CodeIgniter/assets/".$row1['image1']."' alt='HTML tutorial' width='350px' height='200px'></a>";
 }
 }
 
?>
            <div>



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
<?php
 echo "<div style='margin-left: 20px;'>";
 if(!(empty($row->image1)))
 {
 echo "<br><br><div id='imagediv' style=\"background-image: url('http://cs-server.usc.edu:65432/CodeIgniter/assets/".$row->image1."');\"></div><div id='price'>
 <label style='font-size: 20px;color: green;'>Price: $".$row->price."</label><br><br>";
 if(!(empty($offer)))
 {
 echo "<label style='font-size: 25px;color: red;'>Special Price: $".$row->disprice."</label><br><br>";
 }
 echo "<input type='button' value='Add To Cart' class='cart' id='".$row->eventid."' onclick='updatecart(this)' /><br>";
 echo "</div><br><br><br><br><br><br><br><br>";
 }
 echo "<label id='eventname'>".$row->eventname."</label><br>";
 echo "<label class='eventdetails'>Venue:".$row->venue."</label><br>";
  echo "<label class='eventdetails'>Date:".$date."</label><br>";
  echo "<label class='eventdetails'>Organiser:".$row->organiser."</label><br>";
  echo "<label class='eventdetails'>Total Entries:".$row->entry."</label><br><br><br>";
  echo "<label class='eventdetails'>".$row->details."</label><br><br>";
 echo "</div><br><br><label style='font-size:25px;color:red;'>special offer Events relatted to this..</label><br><br><br>";
 $flag=1;
 foreach($result as $row1)
 {
 if ($flag)
 {
 echo "<table><tr>";
 $flag=0;
 }
 if(!($row1['eventid']==$productid))
 {
 echo "<td><a style='text-align:left;' href='details?q=".$row1['eventid']."'><img style='border:1px solid red;' src='http://cs-server.usc.edu:65432/CodeIgniter/assets/".$row1['image1']."' alt='HTML tutorial' width='250px' height='200px'></a></td>";
 }
 }
 if($flag==0)
 {
 echo "</tr></table><br><br>";
 }
?>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
</script>
<script>
$(document).ready(function(){
  $(".cart").click(function(){
   $(this).hide();
    $.ajax({
    type: "GET",
    url: "http://cs-server.usc.edu:65432/CodeIgniter/index.php/updatecart/index", 
  data: {q: this.id},
    success: function(msg) {
	   
	   $("#items").html(msg);
	   $("#items1").html(msg);
    }
    
});
  });
});

</script>
</body>
</html>
