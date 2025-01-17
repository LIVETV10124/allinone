<?php
// Ensure this file has permission to run on your server

header('Content-Type: application/json');

// Check if the 'url' parameter is provided
if (isset($_GET['url'])) {
    $url = $_GET['url'];

    // Initialize cURL to resolve the PHP URL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Follow redirects
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-Resolver/1.0');

    // Execute the request
    $response = curl_exec($ch);
    $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); // Get the final URL after redirects

    curl_close($ch);

    if ($finalUrl) {
        echo json_encode(['finalUrl' => $finalUrl]); // Return the resolved URL
    } else {
        echo json_encode(['error' => 'Failed to resolve the URL.']);
    }
} else {
    echo json_encode(['error' => 'No URL provided.']);
}
?>
