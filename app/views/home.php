<?php include "partials/header.php" ?>


<body>
    <div class="home-container">
        <div class="home-title-section">

            <div class="title-section">
                <h1>Your ultimate Cat Encyclopedia!</h1>
                <p> 
                    <h2>Lorem ipsum.</h2>
                    Lorem ipsum odor amet, consectetuer adipiscing elit.
                    Posuere posuere aenean nullam integer habitasse. Nec 
                    fringilla arcu pharetra fermentum placerat tellus.
                </p>
            </div>

            <div class="image">
            </div>

        </div>

        <div class="featured-articles">

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 100%; height: 100%;">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>


                
                <div class="carousel-inner" style="padding-top: 5%;padding-left: 10%; padding-right: 10%; align-items: center; justify-items: center;">
                    <div class="carousel-item active">
                        <?php include "partials/card.php" ?>
                    </div>
                    <div class="carousel-item">
                        <?php include "partials/card.php" ?>
                    </div>
                    <div class="carousel-item">
                        <?php include "partials/card.php" ?>
                    </div>
                </div>



                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

        </div>
    </div>
</body>
<?php include "partials/footer.php" ?>