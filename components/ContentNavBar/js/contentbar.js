$(document).on('ready pjax:complete',function () {

  var url = location.pathname;

  var urlAction = url.split('/')[2];

   $('ul.content-nav li').each(function () {

       var liAction = this.innerText.toLowerCase()

       if(liAction == urlAction) {
            $(this).addClass('active');
       }
   });

});

