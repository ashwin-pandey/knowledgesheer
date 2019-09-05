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

	// Lazy Loading in quote section
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

/*=======================================*/
/* LIKES / DISLIKES */

$(document).ready(function(){
	// when the user clicks on like
	$('.like').on('click', function(){
		var user_id = $(this).data('user-id');
		var quote_id = $(this).data('id');
		    $post = $(this);

		$.ajax({
			url: 'quote_likes.php',
			type: 'post',
			data: {
				'liked': 1,
				'quote_id': quote_id,
				'user_id': user_id
			},
			success: function(response){
				$post.parent().find('span.likes_count').text(response + " likes");
				$post.addClass('hide');
				$post.siblings().removeClass('hide');
			}
		});
	});

	// when the user clicks on unlike
	$('.unlike').on('click', function(){
		var postid = $(this).data('id');
	    $post = $(this);

		$.ajax({
			url: 'quote_likes.php',
			type: 'post',
			data: {
				'unliked': 1,
				'postid': postid
			},
			success: function(response){
				$post.parent().find('span.likes_count').text(response + " likes");
				$post.addClass('hide');
				$post.siblings().removeClass('hide');
			}
		});
	});
});