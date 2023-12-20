


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


function openNav() {
  document.getElementById("mySidenav").style.width = "200px";
  document.getElementById("main").style.marginLeft = "200px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}


function openCity(evt, cityName) {
  var i, tabcontent, tablinks, tabdropdown;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  tabdropdown = document.getElementsByClassName("tablinks-dropdown");
  for (i = 0; i < tabdropdown.length; i++) {
    tabdropdown[i].className = tabdropdown[i].className.replace(" active-dropdown", "");
  }  
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

var header = document.getElementById("tab");
var btns = header.getElementsByClassName("tablinks");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
  });
}


function opendropdown(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks-dropdown");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active-dropdown", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active-dropdown";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();

$(document).ready(function() {

  //On click signup, hide login and show registration form
  $("#postoptions").click(function() {
      if($('#tab-dropdown').css('display') == 'none'){
        $("#tab-dropdown").slideDown("fast");
      }
      else {
        $("#tab-dropdown").slideUp("fast");
      }
  });
  $(".no-dropdown").click(function() {
    $("#tab-dropdown").slideUp("fast");
  });

  $("#postoptions").click(function() {
      if($('#tab-dropdown2').css('display') == 'block'){
        $("#tab-dropdown2").slideUp("fast");
      }
      else {
        $("#tab-dropdown2").slideDown("fast");
      }
  });

});

$('.closebtn').on('click',function () {
     $('.errormessage').css('display', 'none');
});