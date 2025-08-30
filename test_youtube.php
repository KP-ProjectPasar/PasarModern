<?php
// Test YouTube URL processing
$testUrls = [
    'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    'https://youtu.be/dQw4w9WgXcQ',
    'https://www.youtube.com/shorts/dQw4w9WgXcQ',
    'https://m.youtube.com/watch?v=dQw4w9WgXcQ'
];

function toEmbed($url) {
    if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:m\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=|embed\/|v\/|shorts\/)?([\w-]{11})(?:\S+)?/', $url, $matches)) {
        $videoId = $matches[1];
        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
        return $embedUrl;
    }
    return $url;
}

echo "<h2>YouTube URL Test</h2>";
foreach ($testUrls as $url) {
    $embed = toEmbed($url);
    echo "<p><strong>Original:</strong> {$url}</p>";
    echo "<p><strong>Embed:</strong> {$embed}</p>";
    echo "<iframe src='{$embed}' width='300' height='200' frameborder='0' allowfullscreen></iframe>";
    echo "<hr>";
}
?>
