<?php include "partials/clientheader.php" ?>
<body>



    <div class="home-container">
        <div class="home-title-section">

            <div class="title-section">
                <h1>Your ultimate Cat Encyclopedia!</h1>
                <h2>Lorem ipsum.</h2>
                <p> 
                    Lorem ipsum odor amet, consectetuer adipiscing elit.
                    Posuere posuere aenean nullam integer habitasse. Nec 
                    fringilla arcu pharetra fermentum placerat tellus.
                </p>
            </div>
            <div class="image">
            </div>
        </div>




        <div class="site-info">
            <div class="display-img"></div>
            
            <div class="description">
                <h2>Lorem Ipsum</h2>
                <p>
                    Lorem ipsum odor amet, consectetuer adipiscing elit. Est est tellus faucibus 
                    mauris venenatis velit sit. Pharetra aliquam rhoncus natoque habitasse erat 
                    tempus aptent morbi sem. Dis magnis cubilia vestibulum curabitur maecenas 
                    feugiat. Magna turpis nisi nisl nam risus nam fermentum. Ultrices convallis 
                    mus scelerisque erat pulvinar. Class malesuada eget class neque lobortis 
                    aptent lectus. Mus dapibus lobortis hendrerit cras maximus felis. Ullamcorper 
                    habitant purus ut parturient ad at accumsan molestie.
                    <br>
                    Scelerisque scelerisque torquent ligula erat dictumst; luctus ex. In ultrices 
                    sollicitudin integer integer arcu ex porttitor class neque. Enim ultricies 
                    amet penatibus imperdiet maecenas nulla ante nec. Luctus sit dis vulputate 
                    vel facilisi aptent velit. Aliquam vehicula duis lobortis non porttitor ultrices 
                    bibendum mollis mollis. Dolor molestie enim eget pretium montes sem est. 
                    Porta interdum tincidunt montes euismod euismod netus magnis purus varius. 
                    Conubia rhoncus suspendisse sed, luctus molestie auctor. Massa a cubilia duis 
                    purus in efficitur magnis.
                </p>
            </div>
        </div>





        <div class="featured-articles">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="width: 100%; height: auto;">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>


                
                <div class="carousel-inner" style="padding-top: 5vw; padding-bottom: 10vw; padding-left: 10%; padding-right: 9%; align-items: center; justify-items: center;">
                    <div class="carousel-item active">
                        <?php include "partials/article-card.php" ?>
                    </div>
                    <div class="carousel-item">
                        <?php include "partials/article-card.php" ?>
                    </div>
                    <div class="carousel-item">
                        <?php include "partials/article-card.php" ?>
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
<div>
</body>
<?php include "partials/footer.php" ?>