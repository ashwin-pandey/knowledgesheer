/*=======================================*/
/* SCROLL TO TOP */

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

/*=======================================*/
/* OWL CAROUSEL */

$(document).ready(function(){
  // OWL Carousel
  $("#quote-carousel").owlCarousel({
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
			}
		}
	});

	// News Carousel
	$("#news-carousel").owlCarousel({
		items:5,
		margin:10,
		dots:true,
    responsiveClass:true,
    responsive:{
        0:{
					items:1,
					nav:true,
        },
        600:{
					items:3,
					nav:false
        },
        1000:{
					items:3,
					nav:false,
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
/* BLOG LIKES / DISLIKES */

$(document).ready(function(){
	$('.like').on('click', function(){
		var post_id = $(this).data('id');
		var user_id = $(this).data('user-id');
		var $post = $(this);
		// console.log("Like - post_id = " + post_id + ", user_id = " + user_id);
		$.ajax({
			url: 'likes.php',
			type: 'post',
			data: {
				liked: 1,
				post_id: post_id,
				user_id: user_id
			},
			success: function(response){
				$post.parent().find('span.likes_count').text(response + " likes");
				$post.addClass('hide');
				$post.siblings().removeClass('hide');
			}
		});
	});

	$('.unlike').on('click', function(){
		var post_id = $(this).data('id');
		var user_id = $(this).data('user-id');
	  var $post = $(this);
	  // console.log("Dislike - post_id = " + post_id + ", user_id = " + user_id);
		$.ajax({
			url: 'likes.php',
			type: 'post',
			data: {
				unliked: 1,
				post_id: post_id,
				user_id: user_id
			},
			success: function(response){
				$post.parent().find('span.likes_count').text(response + " likes");
				$post.addClass('hide');
				$post.siblings().removeClass('hide');
			}
		});
	});
});