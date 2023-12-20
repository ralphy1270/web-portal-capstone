<!--- Script Source Files -->
<script src="assets/js/register.js"></script>
<script src="js/custom.js"></script>
<!--- End of Script Source Files -->


</div>
</body>
</html>
<script>

  $(document).ready(function() {

    $('#loading').show();
    var useropen = '<?php echo $userLoggedIn; ?>';
    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_table.php",
      type: "POST",
      data: "page=1" + "&useropen=" + useropen,
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
            url: "includes/handlers/ajax_load_table.php",
            type: "POST",
            data: "page=" + page + "&useropen=" + useropen,
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

  <script>

  $(document).ready(function() {

    $('#loading').show();
    var useropen = '<?php echo $userLoggedIn; ?>';
    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_table_1.php",
      type: "POST",
      data: "page=1" + "&useropen=" + useropen,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area_1').html(data);
      }
    });

    jQuery(function($) { 
            $('.table-section').on('scroll', function() { 
                if ($(this).scrollTop() + 
                    $(this).innerHeight() >=  
                    $(this)[0].scrollHeight) { 

      var height = $('.posts_area_1').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area_1').find('.nextPage').val();
      var noMorePosts = $('.posts_area_1').find('.noMorePosts').val();

       
      //if (noMorePosts == 'false') {
        if (noMorePosts == 'false') { 
          $('#loading').show();

          var ajaxReq = $.ajax({
            url: "includes/handlers/ajax_load_table_1.php",
            type: "POST",
            data: "page=" + page + "&useropen=" + useropen,
            cache:false,

            success: function(response) {
              $('.posts_area_1').find('.nextPage').remove(); //Removes current .nextpage 
              $('.posts_area_1').find('.noMorePosts').remove(); //Removes current .nextpage

              $('#loading').hide();
              $('.posts_area_1').append(response);
            }
          });
        

      } //End if 

      return false;
        } 
            }); 
        }); 

  });

  </script>

  <script>

  $(document).ready(function() {

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_table_2.php",
      type: "POST",
      data: "page=1",
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area_2').html(data);
      }
    });

    jQuery(function($) { 
            $('.table-section').on('scroll', function() { 
                if ($(this).scrollTop() + 
                    $(this).innerHeight() >=  
                    $(this)[0].scrollHeight) { 

      var height = $('.posts_area_2').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area_2').find('.nextPage').val();
      var noMorePosts = $('.posts_area_2').find('.noMorePosts').val();

       
      //if (noMorePosts == 'false') {
        if (noMorePosts == 'false') { 
          $('#loading').show();

          var ajaxReq = $.ajax({
            url: "includes/handlers/ajax_load_table_2.php",
            type: "POST",
            data: "page=" + page,
            cache:false,

            success: function(response) {
              $('.posts_area_2').find('.nextPage').remove(); //Removes current .nextpage 
              $('.posts_area_2').find('.noMorePosts').remove(); //Removes current .nextpage

              $('#loading').hide();
              $('.posts_area_2').append(response);
            }
          });
        

      } //End if 

      return false;
        } 
            }); 
        }); 

  });

  </script>

  <script>

  $(document).ready(function() {

    $('#loading').show();

    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_table_3.php",
      type: "POST",
      data: "page=1",
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area_3').html(data);
      }
    });

    jQuery(function($) { 
            $('.table-section').on('scroll', function() { 
                if ($(this).scrollTop() + 
                    $(this).innerHeight() >=  
                    $(this)[0].scrollHeight) { 

      var height = $('.posts_area_3').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area_3').find('.nextPage').val();
      var noMorePosts = $('.posts_area_3').find('.noMorePosts').val();

       
      //if (noMorePosts == 'false') {
        if (noMorePosts == 'false') { 
          $('#loading').show();

          var ajaxReq = $.ajax({
            url: "includes/handlers/ajax_load_table_3.php",
            type: "POST",
            data: "page=" + page,
            cache:false,

            success: function(response) {
              $('.posts_area_3').find('.nextPage').remove(); //Removes current .nextpage 
              $('.posts_area_3').find('.noMorePosts').remove(); //Removes current .nextpage

              $('#loading').hide();
              $('.posts_area_3').append(response);
            }
          });
        

      } //End if 

      return false;
        } 
            }); 
        }); 

  });

  </script>

  <script>

  $(document).ready(function() {

    $('#loading').show();
    var useropen = '<?php echo $userLoggedIn; ?>';
    //Original ajax request for loading first posts 
    $.ajax({
      url: "includes/handlers/ajax_load_table_admin_script.php",
      type: "POST",
      data: "page=1" + "&useropen=" + useropen,
      cache:false,

      success: function(data) {
        $('#loading').hide();
        $('.posts_area_script_admin').html(data);
      }
    });

    jQuery(function($) { 
            $('.table-admin').on('scroll', function() { 
                if ($(this).scrollTop() + 
                    $(this).innerHeight() >=  
                    $(this)[0].scrollHeight) { 

      var height = $('.posts_area_script_admin').height(); //Div containing posts
      var scroll_top = $(this).scrollTop();
      var page = $('.posts_area_script_admin').find('.nextPage').val();
      var noMorePosts = $('.posts_area_script_admin').find('.noMorePosts').val();

       
      //if (noMorePosts == 'false') {
        if (noMorePosts == 'false') { 
          $('#loading').show();

          var ajaxReq = $.ajax({
            url: "includes/handlers/ajax_load_table_admin_script.php",
            type: "POST",
            data: "page=" + page + "&useropen=" + useropen,
            cache:false,

            success: function(response) {
              $('.posts_area_script_admin').find('.nextPage').remove(); //Removes current .nextpage 
              $('.posts_area_script_admin').find('.noMorePosts').remove(); //Removes current .nextpage

              $('#loading').hide();
              $('.posts_area_script_admin').append(response);
            }
          });
        

      } //End if 

      return false;
        } 
            }); 
        }); 

  });

  </script>