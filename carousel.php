<?php
// Include the functions.php file to access the functions
include_once('src/functions.php');

// Get the breed ID from the query parameter
if (isset($_GET['breed'])) {
    $breedId = $_GET['breed'];

    // Get the breed info and images for the selected breed
    $breedInfo = getBreedInfo($breedId);
    $catImages = getCatImages($breedId);
} else {
    echo "No breed selected.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Cat Carousel</title>

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
   rel="stylesheet" crossorigin="anonymous"
   integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3">
        <!-- Font Awesome for star icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Link to your custom CSS file -->
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Cat Carousel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container mt-5">
            <h1 class="mb-4"><?php echo $breedInfo['name']; ?> - Breed Info</h1>

            <!-- Display breed details in a consistent layout -->
            <div class="row">
                <!-- Left side: Cat Images -->
                <div class="col-md-5">
                    <div class="carousel-container">
                        <!-- Display images in a carousel -->
                        <div id="catCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                // Loop through the images and display them in the carousel
                                foreach ($catImages as $index => $image):
                                    $activeClass = ($index === 0) ? 'active' : ''; // Set the first image as active
                                ?>
                                    <div class="carousel-item <?php echo $activeClass; ?>">
                                        <img src="<?php echo $image['url']; ?>" class="d-block" alt="Cat Image">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <!-- Add carousel controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#catCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#catCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Right side: Breed Information -->
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h4>Description:</h4>
                            <p><?php echo $breedInfo['description']; ?></p>
                            <h4>Origin:</h4>
                            <p><?php echo $breedInfo['origin']; ?></p>
                            <h4>Life Expectancy:</h4>
                            <p><?php echo $breedInfo['life_span']; ?> years</p>
                            
                            <!-- New section for cat attributes with star ratings -->
                            <h4>Breed Characteristics:</h4>
                            <table class="attribute-table">
                                <tr>
                                    <td class="attribute-name">Temperament:</td>
                                    <td><?php echo $breedInfo['temperament'] ?? 'Friendly, Calm, Playful'; ?></td>
                                </tr>
                                <tr>
                                    <td class="attribute-name">Affection Level:</td>
                                    <td>
                                        <?php renderStars($breedInfo['affection_level'] ?? 3); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="attribute-name">Energy Level:</td>
                                    <td>
                                        <?php renderStars($breedInfo['energy_level'] ?? 3); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="attribute-name">Dog Friendliness:</td>
                                    <td>
                                        <?php renderStars($breedInfo['dog_friendly'] ?? 3); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="attribute-name">Health Issues:</td>
                                    <td>
                                        <?php renderStars($breedInfo['health_issues'] ?? 2); ?>
                                        <small class="text-muted ms-2">(lower is better)</small>
                                    </td>
                                </tr>
                            </table>
                            
                            <!-- Back to selection button -->
                            <div class="mt-4">
                                <a href="index.php" class="btn btn-primary">Back to Breed Selection</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Function to render star ratings -->
        <?php
        function renderStars($rating) {
            $rating = max(1, min(5, (int)$rating)); // Ensure rating is between 1-5
            
            echo '<span class="rating">';
            // Display filled stars
            for ($i = 1; $i <= $rating; $i++) {
                echo '<i class="fa-solid fa-star"></i> ';
            }
            // Display empty stars
            for ($i = $rating + 1; $i <= 5; $i++) {
                echo '<i class="fa-regular fa-star"></i> ';
            }
            echo '</span>';
        }
        ?>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>