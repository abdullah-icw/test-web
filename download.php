<?php

if(isset($_POST['submit'])) {
    
    $url = $_POST['url'];
    $quality = $_POST['quality'];

    // Extract the video ID from the URL
    if (strpos($url, 'youtube.com') !== false) {
        parse_str(parse_url($url, PHP_URL_QUERY), $params);
        $video_id = $params['v'];
    } else if (strpos($url, 'facebook.com') !== false) {
        $path = parse_url($url, PHP_URL_PATH);
        $segments = explode('/', rtrim($path, '/'));
        $video_id = end($segments);
    }
    
    // Get the video file URL
    if (strpos($url, 'youtube.com') !== false) {
        $video_url = "https://www.youtube.com/watch?v=$video_id";
        if ($quality != 'default') {
            $video_url .= "&quality=$quality";
        }
        $video_info = file_get_contents("https://www.youtube.com/get_video_info?video_id=$video_id");
        parse_str($video_info, $video_info_arr);
        $formats = $video_info_arr['url_encoded_fmt_stream_map'];
        parse_str($formats, $formats_arr);
        $video_url = $formats_arr['url'];
    } else if (strpos($url, 'facebook.com') !== false) {
        $video_url = "https://www.facebook.com/video.php?v=$video_id";
    }
    
    // Set the content type and force the browser to download the file
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"" . basename($video_url) . "\""); 
    readfile($video_url);
    
    exit();
}

<?php

if(isset($_POST['submit'])) {
    
    $url = $_POST['url'];
    $quality = $_POST['quality'];
    
    // check if youtube-dl is installed
    if (!shell_exec('which youtube-dl')) {
        echo "<p class='error-message'>Sorry, this feature is not available on the server.</p>";
        exit;
    }
    
    // set the download command
    $command = 'youtube-dl --format ' . $quality . ' -o "videos/%(title)s.%(ext)s" ' . escapeshellarg($url);
    
    // execute the download command
    exec($command, $output, $status);
    
    // check if the download was successful
    if ($status === 0) {
        echo "<p class='success-message'>The video has been downloaded successfully!</p>";
        echo "<a href='videos/" . $output[0] . "'>Download Video</a>";
    } else {
        echo "<p class='error-message'>Sorry, there was an error downloading the video.</p>";
    }
}

?>
