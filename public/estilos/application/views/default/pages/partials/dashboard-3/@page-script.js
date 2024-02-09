jQuery(function($) {
  window.currentLayout = 2;//used in demo.js

  // some changes to settings box, appropriate for dashboard-3 and 4
  $('#id-auto-match').prop('checked', true)// automatch navbar and sidebar
  $('#auto-match-div').removeClass('d-none')
  $('#navbar-themes-show').removeClass('d-none')
  $('#navbar-themes-show-msg').addClass('d-none')
  $('input[value="not-navbar"]').parent().removeClass('d-none')



  //let's collapse the open submenu at first, for a better view of `.sidebar-light` look and feel
  $('.sidebar .nav .nav-item.open').removeClass('open').find('.submenu.show').removeClass('show');
  $('.sidebar').removeClass('has-open')

  // display the message only two times
  var displayed = parseInt(localStorage.getItem('welcome.classic.ace') || '0');
  if (displayed < 2) {
    localStorage.setItem('welcome.classic.ace', displayed + 1)

    if (window.matchMedia('(min-width: 1200px)').matches) {
      $.aceToaster.add({
        placement: 'tc',
        body: " <div class='position-tl w-100 border-t-3 brc-success-tp1'></div>\
            <div class='py-3 pl-2 pr-4 d-flex '>\
              <span class='d-inline-block text-center py-3 px-1'>\
                <i class='pos-abs fa fa-question fa-2x w-6 text-dark-m3 mt-2px'></i>\
                <i class='pos-rel fa fa-question fa-2x w-6 text-success-m3 mr-1'></i>\
              </span>\
              <div>\
                <p class='mb-1'>This is the old & classic Ace layout and dashboard.</p>\
                <p class='mb-0'>In this layout <span class='text-600'>navbar</span> is on top and <span class='text-600'>sidebar</span> starts from <span class='border-b-2 brc-grey-m2'>below</span> it.</p>\
              </div>\
              <button data-dismiss='toast' class='btn btn-sm btn-brc-tp btn-lighter-grey btn-h-lighter-danger btn-a-lighter-danger radius-round position-tr mt-1 mr-2px'>\
                <i class='fa fa-times px-1px'></i>\
              </button>\
            </div>",

        width: 500,
        delay: 15,
        //sticky: true,

        close: false,
        //belowNav: true,

        className: 'bgc-white-tp1 shadow overflow-hidden border-0 p-0 radius-t-0 radius-b-1',

        bodyClass: 'border-1 border-t-0 brc-grey-l1 text-dark-tp3 text-120 radius-1 p-2',
        headerClass: 'd-none'
      })
    }
  }

  //show tooltips only when not touchscreen
  if (!('ontouchstart' in window)) $('[data-toggle="tooltip"]').tooltip({container: 'body'})


  //change color of badges, etc (you should do this in your HTML not JS)
  $('.sidebar .fa-exclamation-triangle').removeClass('text-yellow-m3').addClass('text-danger-m2')
  $('.sidebar .badge.bgc-success-m1').removeClass('bgc-success-m1 text-dark-d2').addClass('badge-primary')





})
