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
          $items=$SESSION['cart'];
if(count($items)==0)
{
echo "<label style='font-size: 25px;'>No Items in your Cart</label><br>";
}
else
{
echo "<label style='font-size: 25px;'>Events in the cart</label><br>";
echo "<br><hr>";
echo "<table style='margin:auto;fontsize:10px;'><tr><th>Item name</th><th>Price&nbsp;&nbsp;&nbsp;</th><th>Number of tickets</th><tr>";
$items=$SESSION['cart'];
$k=0;
foreach($items as $item)
{
$options="<select class='selectquan' id=".$item['id']." name='".$item['id']."' onchange='updatequan(this);'>";
$i=1;
while($i <= 10)
{
if($item['quantity'] == $i)
{
$options=$options."<option id='".$item['id']."_".$i."' value=".$i." selected>".$i."</option>";
$i++;
}
else
{
$options=$options."<option id='".$item['id']."_".$i."' value=".$i.">".$i."</option>";
$i++;
}
}
$options=$options."</select>";
echo "<tr><td style='text-align: center;padding:1px'>".$item['name']."</td><td style='text-align: center;padding:1px' >".$item['price']."</td><td style='text-align: center;padding:1px' >".$options."</td><td style='text-align: center;padding:1px' ><input type='button' class='del' value='delete' id='del_".$item['id']."' /></td></tr>";

$k++;
}
echo "<tr><td style='text-align: center;padding:1px'></td><td style='text-align: center;padding:1px' >Total: </td><td style='text-align: center;padding:1px' ><label id='total'>$".$SESSION['total']."</label></td></tr>";

echo "</table>";
echo "<br>";
echo "<input type='button' style='margin-left: 100px;width: 100px;height: 30px;'  value='Delete Cart' id='delall1' /><br><br>";
echo "<a id='checkout' href='checkout' style='margin-left:100px;padding:8px;background-color:rgb(124, 7, 7);text-decoration:none;color:white;'>CHECK OUT</a><br><br>";
}
echo "<hr>";
 echo $sug1;          
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
<br><br><br><br><br><br>
<div id="main">
<?php
$items=$SESSION['cart'];
if(count($items)==0)
{
echo "<label style='margin-left: 200px;font-size: 25px;'>No Items in your Cart</label><br>";
}
else
{
echo "<label style='margin-left: 200px;font-size: 25px;'>Events in the cart</label><br>";
echo "<br><hr>";
echo "<table style='margin:auto;'><tr><th>Item name</th><th>Price&nbsp;&nbsp;&nbsp;</th><th>Number of tickets</th><tr>";
$items=$SESSION['cart'];
$k=0;
foreach($items as $item)
{
$options="<select class='selectquan' id=".$item['id']." name='".$item['id']."' onchange='updatequan(this);'>";
$i=1;
while($i <= 10)
{
if($item['quantity'] == $i)
{
$options=$options."<option id='".$item['id']."_".$i."' value=".$i." selected>".$i."</option>";
$i++;
}
else
{
$options=$options."<option id='".$item['id']."_".$i."' value=".$i.">".$i."</option>";
$i++;
}
}
$options=$options."</select>";
echo "<tr><td style='text-align: center;padding:10px'>".$item['name']."</td><td style='text-align: center;padding:10px' >".$item['price']."</td><td style='text-align: center;padding:10px' >".$options."</td><td style='text-align: center;padding:10px' ><input type='button' class='del' value='delete this item' id='del_".$item['id']."' /></td></tr>";

$k++;
}
echo "<tr><td style='text-align: center;padding:10px'></td><td style='text-align: center;padding:10px' >Total: $</td><td style='text-align: center;padding:10px' ><label id='total'>".$SESSION['total']."</label></td></tr>";

echo "</table>";
echo "<br>";
echo "<input type='button' style='margin-left: 500px;width: 100px;height: 30px;'  value='Delete Cart' id='delall' /><br><br>";
echo "<a id='checkout' href='checkout' style='margin-left:700px;'>CHECK OUT</a><br><br>";
}
?>
<div>
<?php
echo $sug;
?>
</div>
<script>
$(document).ready(function(){
  $(".del").click(function(){
  var val=this.id.split('_');
    $.ajax({
    type: "GET",
    url: "http://cs-server.usc.edu:65432/CodeIgniter/index.php/delitem", 
  data: {q: val[1]},
    success: function(msg) {
	   $("#items").html(msg);
	   location.reload();
    }
    
});
  });
});

$(document).ready(function(){
  $("#delall").click(function(){
    $.ajax({
    type: "GET",
    url: "http://cs-server.usc.edu:65432/CodeIgniter/index.php/delcart", 
  data: {q: "del"},
    success: function(msg) {
	   $("#items").html(msg);
	   location.reload();
    }
    
});
  });
});

$(document).ready(function(){
  $("#delall1").click(function(){
    $.ajax({
    type: "GET",
    url: "http://cs-server.usc.edu:65432/CodeIgniter/index.php/delcart", 
  data: {q: "del"},
    success: function(msg) {
	   $("#items").html(msg);
	   location.reload();
    }
    
});
  });
});



$(document).ready(function(){
  $('.selectquan').on('change',function(){
    $.ajax({
    type: "GET",
    url: "http://cs-server.usc.edu:65432/CodeIgniter/index.php/updatequan", 
  data: {q: $(this).val(),i: this.id},
    success: function(msg) {
	   $("#total").html(msg);
	   location.reload();
    }
    
});
  });
});
</script>
</div>
</body>
</html>
