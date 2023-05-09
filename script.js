// Disable form submission on enter key press
document.addEventListener("keydown", function(event) {
	if (event.key === "Enter") {
		event.preventDefault();
	}
});

// Validate YouTube video URL
function validateYouTubeUrl(url) {
	if (url != undefined || url != '') {
		var regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
		var match = url.match(regExp);
		if (match && match[2].length == 11) {
			return match[2];
		} else {
			alert("Invalid YouTube URL");
			return false;
		}
	}
}

// On form submission
document.querySelector("form").addEventListener("submit", function(e) {
	e.preventDefault();
	var url = document.getElementById("url").value;
	var quality = document.getElementById("quality").value;
	var videoId = validateYouTubeUrl(url);
	if (videoId) {
		// Redirect to download page with video ID and quality
		window.location.href = "download.php?id=" + videoId + "&quality=" + quality;
	}
});
$(document).ready(function() {
	$('#download-form').on('submit', function(event) {
		event.preventDefault();
		var url = $('#url-input').val();
		if (url.trim() === '') {
			alert('Please enter a valid URL.');
			return;
		}
		$('#download-form').hide();
		$('#loader').show();
		$.ajax({
			url: 'download.php',
			type: 'post',
			data: { url: url },
			success: function(response) {
				$('#loader').hide();
				if (response === 'error') {
					$('#download-form').show();
					$('#alert').html('<div class="alert alert-danger">Sorry, an error occurred. Please try again later.</div>');
				} else {
					$('#alert').html('<div class="alert alert-success">Your video is ready. Please right-click on the link below and choose "Save Link As" to download it.</div><a href="' + response + '">Download Link</a>');
				}
			},
			error: function() {
				$('#loader').hide();
				$('#download-form').show();
				$('#alert').html('<div class="alert alert-danger">Sorry, an error occurred. Please try again later.</div>');
			}
		});
	});
});
function downloadYouTubeVideo() {
	const url = document.getElementById('url-input').value;
	if (url.trim() === '') {
		alert('Please enter a valid URL.');
		return;
	}
	document.getElementById('download-form').style.display = 'none';
	document.getElementById('loader').style.display = 'block';
	fetch(`https://www.youtube.com/oembed?url=${url}&format=json`)
		.then(response => response.json())
		.then(data => {
			const videoTitle = data.title.replace(/[^\w\s]/gi, ''); // Remove special characters from the video title
			const videoID = url.split('v=')[1].split('&')[0]; // Get the video ID from the URL
			const downloadLink = `https://www.y2mate.com/mates/en68/analyze/ajax?id=${videoID}&ajax=1&ftype=mp4&fquality=720p`;
			return fetch(downloadLink);
		})
		.then(response => response.json())
		.then(data => {
			const downloadURL = data.result.url;
			document.getElementById('loader').style.display = 'none';
			if (downloadURL) {
				document.getElementById('alert').innerHTML = `<div class="alert alert-success">Your video is ready. Please right-click on the link below and choose "Save Link As" to download it.</div><a href="${downloadURL}" download="${videoTitle}.mp4">Download Link</a>`;
			} else {
				document.getElementById('download-form').style.display = 'block';
				document.getElementById('alert').innerHTML = '<div class="alert alert-danger">Sorry, an error occurred. Please try again later.</div>';
			}
		})
		.catch(error => {
			document.getElementById('loader').style.display = 'none';
			document.getElementById('download-form').style.display = 'block';
			document.getElementById('alert').innerHTML = '<div class="alert alert-danger">Sorry, an error occurred. Please try again later.</div>';
			console.error(error);
		});
}
