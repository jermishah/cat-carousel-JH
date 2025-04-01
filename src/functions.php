<?php
include_once('config/config.php');

// Check if API_KEY is defined
if (!defined('API_KEY')) {
    die("Error: API_KEY is not defined. Check config.php.");
}

// Reusable function to make API requests and return decoded JSON response
function makeApiRequest($url) {
    // Fetch the response using file_get_contents
    $response = file_get_contents($url);

    // Check if the request was successful
    if ($response === false) {
        // You can handle errors here if needed (e.g., log them or show a message)
        return null;
    }

    // Decode and return the response as an associative array
    return json_decode($response, true);
}

// Function to get all available cat breeds
function getAllBreeds() {
    $url = "https://api.thecatapi.com/v1/breeds?api_key=" . API_KEY;
    return makeApiRequest($url);
}

// Function to get breed information
function getBreedInfo($breedId) {
    $url = "https://api.thecatapi.com/v1/breeds/{$breedId}?api_key=" . API_KEY;
    return makeApiRequest($url);
}

// Function to get cat images for a specific breed
function getCatImages($breedId, $limit = 10) {
    $url = "https://api.thecatapi.com/v1/images/search?breed_ids={$breedId}&limit={$limit}&api_key=" . API_KEY;
    return makeApiRequest($url);
}

// Function to count images in the carousel directory
function countImages($imageDir) {
    $files = glob($imageDir . "/*.{jpg,jpeg,png,gif,webp}", GLOB_BRACE);
    return $files ? count($files) : 0;
}
?>
