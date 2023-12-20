<?php 
require 'config/config.php';

if(isset($_GET['name'])){
	$name = $_GET['name'];
	header("Content-Disposition: attachment; filename=" .$name);
	header("Content-Type: application/octet-stream;");
	readfile($name);
	$con = null;
}

/*$query = mysqli_query($con, "INSERT INTO posts VALUES('', 'Eliza Lo', 'Test', 'Test', '2021-23-07', 'Contigency', 'Event', 'no', 'no', 'no', 'assets/images/posts/603b6b36ca3c6148181354_480194776705257_765142342107878674_n.jpg', 'blessyrose', 'uploads/6048f5d7dcc40Balanced and Unbalanced Forces.docx', '23234', 'downloadmo.docx')"); */
 ?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="assets/images/icons/logo.ico">

  <!-- Javascript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/bootbox.min.js"></script>
  <script src="assets/js/demo.js"></script>
  <script src="assets/js/jquery.jcrop.js"></script>
  <script src="assets/js/jcrop_bits.js"></script>


  <!-- CSS -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<div class="download-files-div" id="download-files-div">
		<div class="table-section table-admin">
			<table class="table table-hover">
			    <thead style="z-index: 1!important;">
			      <tr>
              <th style="width: 12rem;">Date</th>
			        <th>File Name</th>
			        <th>Size</th>
			        <th style="text-align: center;">Action</th>
			      </tr>
			    </thead>
			    <tbody>
			    <tbody class="posts_area">
		        
		    	</tbody>
			  </table>
	    </div>     
	</div>      
</body>
</html>

<script>

  $(document).ready(function() {

    $('#loading').show();
    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_downloadable.php",
      type: "POST",
      data: "page=1",
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area').html(data);
      }
    });

    jQuery(function($) { 
            $('.table-section').on('scroll', function() { 
                if ($(this).scrollTop() + 
                    $(this).innerHeight() >=  
                    $(this)[0].scrollHeight) { 

      var height = $('.posts_area').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area').find('.nextPage').val();
      var noMorePosts = $('.posts_area').find('.noMorePosts').val();

       
      //if (noMorePosts == 'false') {
        if (noMorePosts == 'false') { 
          $('#loading').show();

          var ajaxReq = $.ajax({
            url: "includes/handlers/ajax_load_downloadable.php",
            type: "POST",
            data: "page=" + page,
            cache:false,

            success: function(response) {
              $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage 
              $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage

              $('#loading').hide();
              $('.posts_area').append(response);
            }
          });
        

      } //End if 

      return false;
        } 
            }); 
        }); 

  });

  </script>

