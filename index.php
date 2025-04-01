<?php if (isset($_GET['breed'])): ?>
    <?php 
        // Fetch images for the selected breed
        $breedId = $_GET['breed'];
        $catImages = getCatImages($breedId, 5); // Limit to 5 images for now
        $breedInfo = getBreedInfo($breedId); // Fetch breed info
    ?>
    
    <div class="row mt-5">
        <!-- Carousel section for images -->
        <div class="col-md-6">
            <?php if (!empty($catImages)): ?>
                <div id="catCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($catImages as $index => $image): ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <img src="<?php echo $image['url']; ?>" class="d-block w-100" alt="Cat Image">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#catCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#catCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            <?php else: ?>
                <p>No images available.</p>
            <?php endif; ?>
        </div>
        
        <!-- Breed info section -->
        <div class="col-md-6">
            <h2><?php echo $breedInfo['name']; ?></h2>
            <p><strong>Description:</strong> <?php echo $breedInfo['description']; ?></p>
            <p><strong>Lifespan:</strong> <?php echo $breedInfo['life_span']; ?> years</p>
            <p><strong>Origin:</strong> <?php echo $breedInfo['origin']; ?></p>
        </div>
    </div>
<?php endif; ?>
