$(document).ready(function () {
  sidebarSm = $('#accordionSidebar');
  sidebarSm.show(1);


  toggleSb  = $('#btn-toggle-sidebar');
  btnCent   = $('#sidebarToggle');
  icoCent   = $('#ico-cent');
  icoSm     = $('#fa-bars');
  sidebarToggleTop =  $('#sidebarToggleTop');

  toggleSb.removeClass('fa-arrow-right').addClass('fa-arrow-left').removeClass('fs-2')


  sidebarToggleTop.click(function () {
    console.log("entro sidebarToggleTop")
    sidebarSm.show(100);
  })

  toggleSb.click(function () {
    console.log("entro toggleSb")
    sidebarSm.toggle(300);
    if (toggleSb.hasClass('fa-arrow-right')) {
      toggleSb.removeClass('fa-arrow-right').addClass('fa-arrow-left');
      toggleSb.removeClass('fs-2')
      btnCent.show(100)
    } else {
      btnCent.hide(100)
      toggleSb.removeClass('fa-arrow-left').addClass('fa-arrow-right').addClass('fs-2');

    }
  })

  btnCent.click(function () {
    if (icoCent.hasClass('fa-bars')) {
      console.log("entro icoSm 2")
      icoCent.removeClass('fa-bars').addClass('fa-align-center');
    } else {
      icoCent.removeClass('fa-align-center').addClass('fa-bars');
    }
  })


});