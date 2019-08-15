// Tooltip
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
});

// CKEditor 5
// ClassicEditor.create(document.querySelector('#editor')).catch(error => {
// 	console.error( error );
// });

// CKEditor 4
// CKEDITOR.replace('editor');


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
						var img = $('<img/>').addClass('thumb').attr('src', e.target.result); //create image element 
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


$(document).ready(function(){
	$('#selectAllBoxes').click(function(event){
		if(this.checked) {
			$('.checkBoxes').each(function(){
				this.checked = true;
			});
		} else {
			$('.checkBoxes').each(function(){
				this.checked = false;
			});
		}
	});
});


// ==============================================================================
// FRONT END

// var wrap = $("#search-wrap");

// wrap.on("scroll", function(e) {
// 	if (this.scrollTop > 1) {
// 	wrap.addClass("fix-search");
// 	} else {
// 	wrap.removeClass("fix-search");
// 	}
// });

// ==============================================================================