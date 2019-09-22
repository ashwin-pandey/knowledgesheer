// Tooltip
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
});

// CKEditor 4
// CKEDITOR.replace('editor');

// Data Tables
$(document).ready(function() {
	$('#view_all_posts').DataTable({});
});


// Blog Image Preview
$(document).ready(function(){
	$('#file-input').on('change', function(){ //on file input change
		if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
		{
			$('#thumb-output').html(''); //clear html of output element
			var data = $(this)[0].files; //this file data
			
			$.each(data, function(index, file){ //loop though each file
				if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
					var fRead = new FileReader(); //new filereader
					fRead.onload = (function(file){ //trigger function on successful read
						return function(e) {
						var img = $('<img/>').addClass('thumb img-fluid').attr('src', e.target.result); //create image element 
						$('#thumb-output').append(img); //append image to output element
					};
				})(file);
					fRead.readAsDataURL(file); //URL representing the file's data.
				}
			});
			
		}else{
			alert("Your browser doesn't support File API!"); //if File API is absent
		}
	});
});

// Slug
function convertToSlug(title, page) {
	var slug = title.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
	if (page == "blog_post") {
		document.getElementById('slug').value = slug;
	} else if (page == "category") {
		document.getElementById('cat-slug').value = slug;
	} else if (page == "sub-category") {
		document.getElementById('sub-cat-slug').value = slug;
	}
}