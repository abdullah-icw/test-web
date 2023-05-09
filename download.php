<?php
if(isset($_GET['id']) && isset($_GET['quality'])) {
	$videoId = $_GET['id'];
	$quality = $_GET['quality'];
	$formatCode = '';
	
	switch($quality) {
		case 'highest':
			$formatCode = 'best';
			break;
		case '1080p':
			$formatCode = '137+140';
			break;
		case '
<?php
if(isset($_POST['submit'])) {
    $url = $_POST['url'];

    if (strpos($url, 'youtube.com') || strpos($url, 'youtu.be')) {
        $videoID = getYouTubeVideoID($url);
        $downloadLink = "https://www.youtube.com/watch?v=$videoID";
        header("Location: $downloadLink");
    } else if (strpos($url, 'facebook.com')) {
        $videoID = getFacebookVideoID($url);
        $downloadLink = "https://www.facebook.com/video.php?v=$videoID";
        header("Location: $downloadLink");
    } else {
        echo '<div class="alert alert-danger">Sorry, the URL you entered is not supported. Please enter a valid Facebook or YouTube video URL.</div>';
    }
}

function getYouTubeVideoID($url) {
    $pattern = '#(?:youtube(?:-nocookie)?\.com/(?:[^/\n\s]+/\S+/|(?:v|e(?:mbed)?)/|\S*?[?&]v=)|youtu\.be/)([^\n\s?&]+)#';
    preg_match($pattern, $url, $matches);
    return $matches[1];
}

function getFacebookVideoID($url) {
    $pattern = '/videos\/\d+\//';
    preg_match($pattern, $url, $matches);
    $videoID = str_replace('/', '', $matches[0]);
    return $videoID;
}
?>
<?php
if(isset($_POST['submit'])) {
    $url = $_POST['url'];
    $quality = $_POST['quality'];

    if (strpos($url, 'youtube.com') || strpos($url, 'youtu.be')) {
        $videoID = getYouTubeVideoID($url);
        $downloadLink = "https://www.youtube.com/watch?v=$videoID&quality=$quality";
        header("Location: $downloadLink");
    } else if (strpos($url, 'facebook.com')) {
        $videoID = getFacebookVideoID($url);
        $downloadLink = "https://www.facebook.com/video.php?v=$videoID&quality=$quality";
        header("Location: $downloadLink");
    } else {
        echo '<div class="alert alert-danger">Sorry, the URL you entered is not supported. Please enter a valid Facebook or YouTube video URL.</div>';
    }
}

function getYouTubeVideoID($url) {
    $pattern = '#(?:youtube(?:-nocookie)?\.com/(?:[^/\n\s]+/\S+/|(?:v|e(?:mbed)?)/|\S*?[?&]v=)|youtu\.be/)([^\n\s?&]+)#';
    preg_match($pattern, $url, $matches);
    return $matches[1];
}

function getFacebookVideoID($url) {
    $pattern = '/videos\/\d+\//';
    preg_match($pattern, $url, $matches);
    $videoID = str_replace('/', '', $matches[0]);
    return $videoID;
}
?>
