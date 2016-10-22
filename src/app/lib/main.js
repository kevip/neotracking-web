 $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();

    $('.carousel.carousel-slider').carousel({full_width: true});


     $('select').material_select();
       $(".button-collapse").sideNav();
  });
