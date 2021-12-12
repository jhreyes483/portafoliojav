// side
toggleSb = $('#btn-toggle-sidebar'); 
btnCent  = $('#sidebarToggle');
icoCent  = $('#ico-cent');
toggleSb.click(function(){
    bSdb = false;
    $('#accordionSidebar').toggle(300);
    if( toggleSb.hasClass('fa-arrow-right') ){
      toggleSb.removeClass('fa-arrow-right').addClass('fa-arrow-left');
      toggleSb.removeClass('fs-2')
      $('#sidebarToggle').show(100)
    }else{
      $('#sidebarToggle').hide(100)
      toggleSb.removeClass('fa-arrow-left').addClass('fa-arrow-right').addClass('fs-2');

    }  
})

btnCent.click(function(){
  if(icoCent.hasClass('fa-bars')){
    icoCent.removeClass('fa-bars').addClass('fa-align-center');
  }else{
    icoCent.removeClass('fa-align-center').addClass('fa-bars');
  }
})





function f_eClick(item) {
  if (item) {
     e = new Event('click');
     item.click();
     item.dispatchEvent(e);
  }
}




function PopupCenter(url, title, w, h) {
   // Fixes dual-screen position                         Most browsers      Firefox
   var dualScreenLeft =
     window.screenLeft != undefined ? window.screenLeft : screen.left;
   var dualScreenTop =
     window.screenTop != undefined ? window.screenTop : screen.top;
 
   width = window.innerWidth
     ? window.innerWidth
     : document.documentElement.clientWidth
     ? document.documentElement.clientWidth
     : screen.width;
   height = window.innerHeight
     ? window.innerHeight
     : document.documentElement.clientHeight
     ? document.documentElement.clientHeight
     : screen.height;
 
   var left = width / 2 - w / 2 + dualScreenLeft;
   var top = height / 2 - h / 2 + dualScreenTop;
   var newWindow = window.open(
     url,
     title,
     "scrollbars=yes, width=" +
       w +
       ", height=" +
       h +
       ", top=" +
       top +
       ", left=" +
       left
   );
 
   // Puts focus on the newWindow
   if (window.focus) {
     newWindow.focus();
   }
 }









