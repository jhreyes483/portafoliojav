$.sidebarMenu = function(menu) {
  var animationSpeed = 300,
    subMenuSelector = '.sidebar-submenu';

  $(menu).on('click', 'li a', function(e) {
    var $this = $(this);
    var checkElement = $this.next();

    if (checkElement.is(subMenuSelector) && checkElement.is(':visible')) {
      checkElement.slideUp(animationSpeed, function() {
        checkElement.removeClass('menu-open');
      });
      checkElement.parent("li").removeClass("active");
    }

    //If the menu is not visible
    else if ((checkElement.is(subMenuSelector)) && (!checkElement.is(':visible'))) {
      //Get the parent menu
      var parent = $this.parents('ul').first();
      //Close all open menus within the parent
      var ul = parent.find('ul:visible').slideUp(animationSpeed);
      //Remove the menu-open class from the parent
      ul.removeClass('menu-open');
      //Get the parent li
      var parent_li = $this.parent("li");

      //Open the target menu and add the menu-open class
      checkElement.slideDown(animationSpeed, function() {
        //Add the class active to the parent li
        checkElement.addClass('menu-open');
        parent.find('li.active').removeClass('active');
        parent_li.addClass('active');
      });
    }
    //if this isn't a link, prevent the page from being redirected
    if (checkElement.is(subMenuSelector)) {
      e.preventDefault();
    }
  });
}

$('.link-collapse').click(function(){
    $(this).find('i').toggleClass('fa-plus-square fa-minus-square')
});
$('.link-collapse').blur(function(){
    $(this).find('i').toggleClass('fa-plus-square fa-minus-square')
});

$('.pulscollapse').click(function(){
    $(this).find('i').toggleClass('fa-plus-square fa-minus-square')
});
$('.pulscollapse').blur(function(){
    $(this).find('i').toggleClass('fa-plus-square fa-minus-square')
});
//$('#accordion').click(function(){
//    $(this).next('ul').slideToggle('500');
//    $(this).find('i').toggleClass('fa-plus-square fa-minus-square');
//});

//
// $(document).ready(function(){
//           $("#btnicon").click(function(){
//               $(".contenido-grupos").toggle(600);
//           });
//     
     


//$(document).ready(function(){
//	$("#buscar").click(function(){
//		$('#material').show(3000,function() {
//		});
// 	});
//});

function PopupCenter(url, title, w, h) {  
  // Fixes dual-screen position                         Most browsers      Firefox  
  var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;  
  var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;  
        
  width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;  
  height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;  
        
  var left = ((width / 2) - (w / 2)) + dualScreenLeft;  
  var top = ((height / 2) - (h / 2)) + dualScreenTop;  
  var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);  
  
  // Puts focus on the newWindow  
  if (window.focus) {  
  newWindow.focus();  
  }  
  }  


// / <!-- Menu Toggle Script -->
$.sidebarMenu($('.sidebar-menu'))

$("#menu-toggle").click(function(e) {
e.preventDefault();
$("#wrapper").toggleClass("toggled");
});

  $("#logo-toggle").click(function (e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
  });


// <!-- MODAL -->
  $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
  })

// <!-- Menu Toggle Script -->
