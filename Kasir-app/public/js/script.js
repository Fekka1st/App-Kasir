let navbar = document.getElementById('sticky');

  window.addEventListener('scroll', function(){
      let scroll = window.scrollY;
      if(scroll > 100){
          navbar.classList.remove('navbar-dark');
          navbar.classList.add('bg');
      }else{
          navbar.classList.add('navbar-dark');
          navbar.classList.remove('bg');
      }
  })

  $(document).ready(function(){
    var bt = $(".backtop");

    bt.on('click', function(e){
        $('html, body').animate({
            scrollTop: 0
        }, 600);

        e.preventDefault();
    });

    $(window).on('scroll', function(){
        if ($(this).scrollTop()>800){
                bt.show();
        }else{
            bt.hide();
        }
    });
});

  