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
 <h1>Featured Events taking place soon</h1>
    <?php
$mons = array('01' => "January", '02' => "February", '03' => "March", '04' => "April", '05' => "May", '06' => "June", '07' => "July", '08' => "August", '09' => "September", '10' => "October", '11' => "November", '12' => "December");
             foreach ($result1 AS $row) {
                   $arr = explode("-", $row['date']);
                    
                   $month=$arr[1];
                   $month_name=$mons[$month];
                   $date=$month_name." ".$arr[2]." ".$arr[0];
                   $timenow=time();
                   $offer="";
                   if(!(empty($row['offerstart'])))
                   {
                   if(strtotime($row['offerstart']) <= $timenow && strtotime($row['offerend']) >= $timenow)
                    {
                    $offer ="<div class='special'></div>";
                    
                    }
                    }
                   echo "<br><br>";
                   echo " <div style='width:100%;text-align:center'>".$offer." <a href='details?q=".$row['eventid']."');\"><img src='http://cs-server.usc.edu:65432/CodeIgniter/assets/".$row['image1']."' alt='Smiley face' height='200px' width='350px'></a><br>";
                   echo "<div style='width:100%;word-wrap: break-word;'>";
                   echo "<br><a class='names' href='details?q=".$row['eventid']."'>".$row['eventname']."</a><br><br>";
                   echo " <label class='labels'>Where:</label>&nbsp;&nbsp;<label class='vals'>".$row['venue']."</label><br><br>";
                   echo "<label class='labels'>When:</label>&nbsp;&nbsp;<label class='vals'>". $date."</label><br><br>";
                   
                   echo "<a class='buy' href='details?q=".$row['eventid']."'>BUY TICKETS</a>&nbsp;&nbsp;&nbsp;&nbsp;";
                    echo "<input type='button' class='cart' value='ADD TO CART' id='".$row['eventid']."' ' /><br><br>";
                    echo "</div></div>";
                    echo "<br>";
                    echo "<hr>";
                      }

            
            ?>
  
  </div>

  <div data-role="footer" style="padding-left:4px;padding-right:4px;">
    <h1>Special Events</h1>
    <?php


 foreach ($result2 AS $row) {
echo "<a href='details?q=".$row['eventid']."');\"><img src='http://cs-server.usc.edu:65432/CodeIgniter/assets/".$row['image1']."' alt='Smiley face' height='200px' width='350px'></a><br>";
}
?>
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
<br><br><br><br>
<div id="main">
<div style="">
<div style="margin-top:10px;float: left;border:1px solid grey;">
<div style="width:100%;height:300px;border-bottom:1px solid grey;background-color: rgb(82, 12, 23);">
<div style="float:left;width:400px;color:white;font-size:25px;margin-top:100px;text-align:center;">If its happening out there You will find it here.</div>
<div style="float:left;width:500px;height:250px;margin-left:450px;margin-top: -150px;background-image:url('http://cs-server.usc.edu:65432/CodeIgniter/assets/upload/image.jpg');border:4px solid white"></div>
</div>
<div style="width:800px;float:left;">
<?php
$mons = array('01' => "January", '02' => "February", '03' => "March", '04' => "April", '05' => "May", '06' => "June", '07' => "July", '08' => "August", '09' => "September", '10' => "October", '11' => "November", '12' => "December");
             foreach ($result1 AS $row) {
                   $arr = explode("-", $row['date']);
                    
                   $month=$arr[1];
                   $month_name=$mons[$month];
                   $date=$month_name." ".$arr[2]." ".$arr[0];
                   $timenow=time();
                   $offer="";
                   if(!(empty($row['offerstart'])))
                   {
                   if(strtotime($row['offerstart']) <= $timenow && strtotime($row['offerend']) >= $timenow)
                    {
                    $offer ="<div class='special'></div>";
                    
                    }
                    }
                   echo "<br><br>";
                   echo " <div style='width:100%;margin-left:20px;'> <a href='details?q=".$row['eventid']."' class='imagediv' style=\"background-image: url('http://cs-server.usc.edu:65432/CodeIgniter/assets/".$row['image1']."');\"></a>";
                   echo "<div style='margin-left:250px;width:400px;word-wrap: break-word;'>";
                   echo $offer."<br><a class='names' href='details?q=".$row['eventid']."'>".$row['eventname']."</a><br><br>";
                   echo " <label class='labels'>Where:</label>&nbsp;&nbsp;<label class='vals'>".$row['venue']."</label><br><br>";
                   echo "<label class='labels'>When:</label>&nbsp;&nbsp;<label class='vals'>". $date."</label><br><br>";
                   echo "<label class='labels'>Details:</label><br><label class='vals'>". $row['details']."</label><br><br>";
                   echo "<a class='Buy' href='details?q=".$row['eventid']."'>BUY TICKETS</a>&nbsp;&nbsp;&nbsp;&nbsp;";
                    echo "<input type='button' class='cart' value='ADD TO CART' id='".$row['eventid']."' onclick='updatecart(this)' /><br><br>";
                    echo "</div></div>";
                    echo "<br>";
                    echo "<hr>";
                      }

            
            ?>
           
          
            
            
           
                       
</div>
<div id="special">
<div style="width:100%;height:40px;background-color: rgb(80, 21, 21);text-align:center;color:white;font-size: 22px;">**Special Offer Events**</div>
<div style="box-shadow: 10px 10px 10px #1F0A03;">
<br>
<?php


 foreach ($result2 AS $row) {
echo "<a class='imagediv1' style=\"background-image: url('http://cs-server.usc.edu:65432/CodeIgniter/assets/".$row['image1']."');\" href='details?q=".$row['eventid']."'><div class='imagelabel'><label class='inside_label'>".$row['eventname']."</label></div><div class='image1div' style=''></div></a>";
}
?>
</div>
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
</div>
</div>
</body>
</html>
