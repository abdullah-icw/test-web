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
