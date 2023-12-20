/*========== NAVBAR SHOW/HIDE ==========*/
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;
if($(this).scrollTop() > 325) {
	  if (prevScrollpos > currentScrollPos) {
	    document.getElementById("menubar").style.top = "0";
	  } else {
	    document.getElementById("menubar").style.top = "-8rem";
      var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
	  }
}	  
	  prevScrollpos = currentScrollPos;
}

/*========== SMOOTH SCROLLING TO LINKS ==========*/

$(document).ready(function(){ //document is loaded
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {//click on any link;anchor tag;

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") { //for e.g. website.com#home - #home
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;
      //console.log('hash:',hash)

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({ //animate whole html and body elements
        scrollTop: $(hash).offset().top //scroll to the element with that hash
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash; //website.com - website.com#home
        //Optional remove "window.location.hash = hash;" to prevent transparent navbar on load
      });
    } // End if
  });
});


/*========== DATE/TIME WIDGET ==========*/

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
  }
  function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
  }
function timedate(){  
  var d = new Date(); 
  var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

  var ordinal = d.getDate();
  if ((ordinal) <= 10) {
    if ((ordinal % 10) == 1 ){
    Ordinal = "st";
    }
    else if((ordinal % 10) == 2 ){
    Ordinal = "nd";
    }
    else if((ordinal % 10) == 3 ){
    Ordinal = "rd";
    }
    else {
    Ordinal = "th";	
    }
  }
  else {
    Ordinal = "th";
  }
  document.getElementById("year").innerHTML = d.getFullYear();
  document.getElementById("date").innerHTML = d.getDate() + Ordinal;
  document.getElementById("month").innerHTML = months[d.getMonth()] + " ";
  document.getElementById("days").innerHTML = days[d.getDay()] + ",";
}

/*========== SIDE-NAVBAR ==========
$(document).ready(function () {
if ($(window).width() < 992) {
   $(".navbar-button").show(); 
   $(".nav-link").hide();
}
else {
   $(".navbar-button").hide();
   $(".nav-link").show();
}
});

$(window).on('resize', function(){
  var win = $(this); //this = window
  if (win.width() < 992) { 
    $(".navbar-button").show(); 
    $(".nav-link").hide();
  }
  else{
    $(".navbar-button").hide();
    $(".nav-link").show();
  }
}); */

/*========== SHOW/HIDE SIDE-NAV ON CLICK ==========*/

$(document).mouseup(function(e) 
{
    var container = $("menubar-button");
    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
      document.getElementById("mySidenav").style.width = "0";
    }
});

$('.menubar-button').click(function(e){  
    document.getElementById("mySidenav").style.width = "250px";
}); 

$('.sidenav').click(function(e){  
    document.getElementById("mySidenav").style.width = "250px";
});

/*$(document).ready(function () { //when document loads completely.
    $(document).click(function (event) { //click anywhere
        var clickover = $("navbar-button"); //get the target element where you clicked
        var _opened = $(".mySidenav").css("width") == "250px"; //check if element with 'navbar-collapse' class has a class called show. Returns true and false.
        if (_opened === true && clickover.is(e.target)) { // if _opened is true and clickover(element we clicked) doesn't have 'navbar-toggler' class
            document.getElementById("mySidenav").style.width = "0px"; //toggle the navbar; close the navbar menu in mobile.
        }
    }); 
});
*/

/*========== UPDATE SECTION ==========*/
//theCarousel
$(document).ready(function(){ //when document is ready
  $("#updates-slider").owlCarousel({ //owlCarousel settings
        items:1, //by default there are 3 slides display.
        autoplay:false, //the slides will change automatically.
        smartSpeed:700, //speed of changing wil be 700
        dots: false,
        nav: true,
        loop:true, //infinite loop; after the last slide, first slide starts
        autoplayHoverPause:true, //when you put mouse over Carousel, slide changing will stop
        responsive : { //responsiveness as screen size changes
            // min-width: 0px    
            0 : {
                items: 1 //on devices with width 0 to 579px show 1 slide
            },
            // min-width: 579px
            576 : {
                items: 1 //on devices with width 579px to 768px show show 2 slides
            },
            // min-width: 768px
            768 : {
                items: 1 //on devices with width 768px and above show 3 slides 
            }
        }
  }
  );
});

/*========== TAB SECTION ==========*/

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

/*========== LATEST EVENT SECTION ==========*/
//theCarousel
$(document).ready(function(){ //when document is ready
  $("#latest-events-slider").owlCarousel({ //owlCarousel settings
        items:1, //by default there are 3 slides display.
        autoplay:true, //the slides will change automatically.
        autoplayTimeout:4000,
        smartSpeed:700, //speed of changing wil be 700
        loop:true, //infinite loop; after the last slide, first slide starts
        autoplayHoverPause:true, //when you put mouse over Carousel, slide changing will stop
        responsive : { //responsiveness as screen size changes
            // min-width: 0px
            0 : {
                items: 1 //on devices with width 0 to 579px show 1 slide
            },
            // min-width: 579px
            576 : {
                items: 1 //on devices with width 579px to 768px show show 2 slides
            },
            // min-width: 768px
            768 : {
                items: 1 //on devices with width 768px and above show 3 slides 
            }
        }
  }
  );
});


/*========== MEET THE PUBLIC SERVANTS SECTION ==========*/
//theCarousel
$(document).ready(function(){ //when document is ready
  $("#public-servants-section-slider").owlCarousel({ //owlCarousel settings
        items:1, //by default there are 3 slides display.
        autoplay:true, //the slides will change automatically.
        autoplayTimeout:3000,
        smartSpeed:700, //speed of changing wil be 700
        loop:true, //infinite loop; after the last slide, first slide starts
        autoplayHoverPause:true, //when you put mouse over Carousel, slide changing will stop
        responsive : { //responsiveness as screen size changes
            // min-width: 0px
            0 : {
                items: 1 //on devices with width 0 to 579px show 1 slide
            },
            // min-width: 579px
            576 : {
                items: 1 //on devices with width 579px to 768px show show 2 slides
            },
            // min-width: 768px
            768 : {
                items: 1 //on devices with width 768px and above show 3 slides 
            }
        }
  }
  );
});

/*========== TOP SCROLL BUTTON ==========*/

$(document).ready(function() { //when document is ready
  $(window).scroll(function() { //when webpage is scrolled
    if ($(this).scrollTop() > 500) { //if scroll from top is more than 500
      $('.top-scroll').fadeIn(); //display element with class 'top-scroll'; opacity increases
    } else { //if not
      $('.top-scroll').fadeOut(); //hide element with class 'top-scroll'; opacity decreases
    }
  });
});






