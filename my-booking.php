<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
?><!DOCTYPE HTML>
<html lang="en">
<head>

<title>Car Rental Portal - My Booking</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<!-- SWITCHER -->
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
        
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/logo.png">
<!-- Google-Font-->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->  
</head>
<style>
  .p{
    fornt-famify:"khmer os new";
  }
</style>
<body>

<!-- Start Switcher -->
<?php include('includes/colorswitcher.php');?>
<!-- /Switcher -->  
        
<!--Header-->
<?php include('includes/header.php');?>
<!--Page Header-->
<!-- /Header --> 

<!--Page Header-->
<section class="page-header profile_page p">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>ទិន្ន័យ ជួលរថយន្ត របស់ខ្ញុំ</h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="http://localhost/ren_car/index.php">ទំព័រដើម</a></li>
        <li><?php echo htmlentities($result->FullName);?></li>

      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>
<!-- /Page Header--> 

<?php 
$useremail=$_SESSION['login'];
$sql = "SELECT * from tblusers where EmailId=:useremail ";
$query = $dbh -> prepare($sql);
$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<section class="user_profile inner_pages p">
  <div class="container">
    <div class="user_profile_info gray-bg padding_4x4_40">
      <div class="upload_user_logo"> <img src="assets/images/dealer-logo.jpg" alt="image">
      </div>

      <div class="dealer_info">

        <h5>ឈ្មោះ : <?php echo htmlentities($result->FullName);?></h5>
        <p>ទីកន្លែង : <?php echo htmlentities($result->Address);?><br>
        <p>អុីម៉ែល : <?php echo htmlentities($result->EmailId) ;}}?></p>     
       </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-sm-3">
       <?php include('includes/sidebar.php');?>
   
      <div class="col-md-8 col-sm-8">
        <div class="profile_wrap">
          <h5 class="uppercase underline">ការជួលរថយន្ត របស់ខ្ញុំ</h5>
          <div class="my_vehicles_list">
            <ul class="vehicle_listing">
<?php 
$useremail=$_SESSION['login'];
 $sql = "SELECT tblvehicles.Vimage1 as Vimage1,tblvehicles.VehiclesTitle,tblvehicles.id as vid,tblbrands.BrandName,tblbooking.FromDate,tblbooking.ToDate,tblbooking.message,tblbooking.Status,tblvehicles.PricePerDay,DATEDIFF(tblbooking.ToDate,tblbooking.FromDate) as totaldays,tblbooking.BookingNumber  from tblbooking join tblvehicles on tblbooking.VehicleId=tblvehicles.id join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblbooking.userEmail=:useremail order by tblbooking.id desc";
$query = $dbh -> prepare($sql);
$query-> bindParam(':useremail', $useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>

<li>
    <p style="color:red">លេខកូដជួល<?php echo htmlentities($result->BookingNumber);?></p>
                <div class="vehicle_img"> <a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>"><img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></a> </div>
                <div class="vehicle_title">

                  <h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>"> <?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></a></h6>
                  <p><b>ចាប់ពី​ ថ្ងៃ</b> <?php echo htmlentities($result->FromDate);?> <b>រហូតដល់</b> <?php echo htmlentities($result->ToDate);?></p>
                  <div style="float: left"><p><b>មតិរបស់ អតិថជន:</b> <?php echo htmlentities($result->message);?> </p><a href="#">មើលបន្ថែម...</a></div>
                </div>
                <?php if($result->Status==1)
                { ?>
                <div><a href="#" class="btn outline btn-xs active-btn">បានយលព្រម</a>
                           <div class="clearfix"></div>
        </div>
        <div>
              <?php } else if($result->Status==2) { ?>
                <div>
                  <a href="#" class="btn outline btn-xs "style="color:red">មិនយល់ព្រម</a>
                   <div class="clearfix"></div>
                </div>
             


            <?php } else { ?>
               <p class="btn outline btn-xs" style="color:blue">កំពុងស្នើសុំជួល...</p>
               <a href="vehical-details.php?vhid=<?php echo htmlentities($result->vid);?>"  class="btn  btn-xs "style="color:white">ជួលរថយន្តទៀត</a>
            <div class="clearfix"></div>
        </div>
                <?php } ?>
       
              </li>
              <?php }  if($result->Status==2) { ?>
<h5 style="color:blue">Invoice</h5>
<table>
  <tr>
    <th>ឈ្មោះរថយន្ត</th>
    <th>ចាប់ពី ថ្ងៃ</th>
    <th>ទៅដល់ ថ្ងៃ</th> 
    <th>ចំនួនថ្ងៃ សរុប</th>
    <th>តម្លៃជួល / ថ្ងៃ</th>
  </tr>
  <tr>
    <td><?php echo htmlentities($result->VehiclesTitle);?>, <?php echo htmlentities($result->BrandName);?></td>
     <td><?php echo htmlentities($result->FromDate);?></td>
      <td> <?php echo htmlentities($result->ToDate);?></td>
       <td><?php echo htmlentities($tds=$result->totaldays);?></td>
        <td> <?php echo htmlentities($ppd=$result->PricePerDay);?> រៀល</td>
  </tr>
  <tr>
    <th colspan="4" style="text-align:center;">ទឺកប្រាក់សរុប</th>
    <th><?php echo htmlentities($tds*$ppd);?> រៀល</th>
  </tr>
  
</table>
<hr />
              <?php }}  else { ?>
                <h5 align="center" style="color:red">មិនទានមានការជួល</h5>
              <?php } ?>
             
         
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/my-vehicles--> 
<?php include('includes/footer.php');?>

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>
<?php } ?>

