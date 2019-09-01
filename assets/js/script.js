// Scroll To Top
const scrollToTopButton = document.getElementById('js-top');
const scrollFunc = () => {
  let y = window.scrollY;
  if (y > 0) {
    scrollToTopButton.className = "top-link show";
  } else {
    scrollToTopButton.className = "top-link hide";
  }
};
window.addEventListener("scroll", scrollFunc);
const scrollToTop = () => {
  const c = document.documentElement.scrollTop || document.body.scrollTop;
  if (c > 0) {
    window.requestAnimationFrame(scrollToTop);
    window.scrollTo(0, c - c / 10);
  }
};
scrollToTopButton.onclick = function(e) {
  e.preventDefault();
  scrollToTop();
}

$(document).ready(function(){
  // OWL Carousel
  $(".owl-carousel").owlCarousel({
    loop:true,
    margin:10,
    dots:true,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:3,
            nav:false,
            loop:true
        }
    }
  });
});

// Lazy Loading in quote section
$(document).ready(function(){
	$(window).scroll(function(){
		var lastID = $('.load-more').attr('lastID');
		if(($(window).scrollTop() == $(document).height() - $(window).height()) && (lastID != 0)){
			$.ajax({
				type:'POST',
				url:'quoteData.php',
				data:'id='+lastID,
				beforeSend:function(){
					$('.load-more').show();
				},
				success:function(html){
					$('.load-more').remove();
					$('#postList').append(html);
				}
			});
		}
	});
});