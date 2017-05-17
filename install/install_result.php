<?php
function install_result($success=array(),$error=array()){?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ReLis | Setup </title>

    <!-- Bootstrap -->
    <link href="../cside/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../cside/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../cside/css/custom.css" rel="stylesheet">
    <link href="../cside/css/install.css" rel="stylesheet">
  </head>

  <body style="background:#F7F7F7;">
    <div class="">
     
      <div id="wrapper">
        <div id="login" class=" form">
          <section class="login_content">
            
              <h1>ReLiS installer</h1><br/>
			  
			
                    
            <div class="row" >
				
			<div class=" col-md-8 col-sm-8 col-xs-8 col-md-offset-2 alert alert-success alert-dismissible fade in" role="alert">
			
			<h3 style="text-align:center">Installation success</h3>
			
			</div>
			
		
			
			</div>
			<br/>
		<br/>
			<h1><a href='../index.php'><button class="btn btn-info btn-lg" type="button">Start ReLiS</button></a></h1>
				
			  
			
		
              <div class="clearfix"></div>
              <div class="separator">

                
                <div class="clearfix"></div>
                
              </div>
            
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
<?php }?>