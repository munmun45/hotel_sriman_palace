<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from miller.bslthemes.com/aquarele-demo/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Nov 2024 06:12:16 GMT -->

<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <?php require("./config/meta.php") ?>





</head>

<body>
    <!-- wrapper -->
    <div class="mil-wrapper">



        <?php require("./config/header.php") ?>
        <?php require("./config/config.php") ?>


        <div class="mil-banner-sm">
            <img src="img/shapes/4.png" class="mil-shape" style="width: 70%; top: 0; right: -35%; transform: rotate(190deg)" alt="shape">
            <img src="img/shapes/4.png" class="mil-shape" style="width: 70%; bottom: -12%; left: -30%; transform: rotate(40deg)" alt="shape">
            <img src="img/shapes/4.png" class="mil-shape" style="width: 110%; top: -5%; left: -30%; opacity: .3" alt="shape">
            <div class="container">
                <div class="mil-banner-img-4">
                    <img src="img/shapes/1.png" alt="object" class="mil-figure mil-1">
                    <img src="img/shapes/2.png" alt="object" class="mil-figure mil-2">
                    <img src="img/shapes/3.png" alt="object" class="mil-figure mil-3">
                </div>
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-8">

                        <div class="mil-banner-content-frame">
                            <div class="mil-banner-content mil-text-center">
                                <h1 class="mil-mb-40">Savor the Flavor at <br>Our Restaurant</h1>
                                <div class="mil-suptitle mil-breadcrumbs">
                                    <ul style="    margin: 0px;">
                                        <li><a href="./index">Home</a></li>
                                        <li><a href="#0">Restaurant</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- banner end -->

        <!-- publication -->
        <div class="mil-pub-frame">
            <div class="mil-pub-cover">
                <img src="img/blog/1.jpg" alt="cover">
            </div>

            <div class="container mil-p-100-100">
                <div class="row justify-content-center">
                    <div class="col-xl-7">
                        <p class="mil-mb-20 mil-fade-up">
                            Hungry Man Restaurant is the perfect place for those who enjoy a satisfying meal in a relaxed, inviting environment. Our menu is crafted to satisfy all appetites, offering a wide variety of hearty and flavorful dishes that range from comforting classics to bold, innovative creations. Whether you're in the mood for a juicy steak, a hearty burger, or a delicious pasta, each dish is made with the freshest ingredients to ensure the highest quality and taste. We take pride in offering generous portions that leave you feeling fully satisfied, making every meal here a fulfilling experience.</p>

                        <p class="mil-mb-20 mil-fade-up">
                            The warm and welcoming atmosphere of Hungry Man Restaurant makes it the ideal spot for family gatherings, casual dining with friends, or even special occasions. With attentive service and a focus on creating memorable dining experiences, we aim to provide more than just a meal — we offer an experience that brings people together over great food. At Hungry Man, every dish is made with care and every guest is treated like family, ensuring that you’ll always leave happy and eager to return.</p>






                    </div>
                </div>
            </div>
        </div>
        <!-- publication end -->


        <div class="mil-about mil-p-100-0" style="z-index: 10;">
            <img src="img/shapes/4.png" class="mil-shape" style="width: 180%; bottom: -100%; left: -20%; opacity: .2" alt="shape">
            <div class="container" style="max-width: 800px;">
                <h2 class="mil-row-title mil-fade-up mil-mb-100">Our Delicious Menu </h2>

                <div id="accordion">
                    <?php
                    // Fetch the food_categories from the database
                    $sql = "SELECT * FROM food_categories";
                    $categoriesResult = mysqli_query($conn, $sql);

                    // Loop through the food_categories and display them
                    $index = 1; // Initialize a unique index for dynamic IDs
                    while ($food_category = mysqli_fetch_assoc($categoriesResult)) {
                        // Generate unique IDs based on the index
                        $headingId = "heading" . $index;
                        $collapseId = "collapse" . $index;

                        // Get the category ID
                        $id_food = intval($food_category['id']);
                    ?>

                        <div class="card" style="background-color: transparent; border-color: #a7d046; margin-bottom: 20px;">
                            <div class="card-header" id="<?= $headingId ?>" style="background-color: #a5cc45; border: none; border-bottom: 1px solid #a7ce45;">
                                <h5 class="mb-0">
                                    <li class="mil-comment mil-mb-40" data-toggle="collapse" data-target="#<?= $collapseId ?>" aria-expanded="true" aria-controls="<?= $collapseId ?>" style="cursor: pointer; margin: 0px;">
                                        <div class="mil-comment-head mil-fade-up" style="margin: 0px;">
                                            <div class="mil-author">
                                                <div class="mil-avatar">
                                                    <img src="./somaspanel/uploads/<?= htmlspecialchars($food_category['image']) ?>" alt="Default image ">
                                                </div>
                                                <div>
                                                    <h5><?= $food_category['name'] ?></h5>
                                                </div>
                                            </div>
                                            <div class="mil-reply">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left">
                                                    <polyline points="9 14 4 9 9 4"></polyline>
                                                    <path d="M20 20v-7a4 4 0 0 0-4-4H4"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </li>
                                </h5>
                            </div>

                            <div id="<?= $collapseId ?>" class="collapse" aria-labelledby="<?= $headingId ?>" data-parent="#accordion">
                                <div class="card-body">

                                    <?php
                                    // Fetch the menus for the current category
                                    $menuSql = "SELECT * FROM menu WHERE category_id = $id_food";
                                    $menuResult = mysqli_query($conn, $menuSql);

                                    $count = 1;

                                    // Check if there are menus for the current category
                                    if (mysqli_num_rows($menuResult) > 0) {
                                        // Loop through the menus and display them
                                        while ($menu = mysqli_fetch_assoc($menuResult)) {



                                            echo "<div style='display: flex; justify-content: space-between; align-items: center;' >";
                                            echo "<p style='    margin: 0px; padding: 20px;' > <b> " . $count . ": " . $menu['dish_name'] . "</b></p> <div class='mil-divider mil-mb-10' style='flex-grow: 1; border: dashed 1px rgb(33 37 41 / 32%); ' ></div> <p style='    margin: 0px; padding: 20px;' ><b>₹ " . htmlspecialchars($menu['price']) . "</b></p>";
                                            echo "</div>";

                                            $count++;
                                        }
                                    } else {
                                        echo "<p>No dishes available for this category.</p>";
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>

                    <?php
                        $index++; // Increment the index for unique IDs
                    }
                    ?>
                </div>
            </div>

            <br>
            <br>
            <br>
            <?php require("./config/footer.php") ?>
        </div>















        <?php require("./config/script.php") ?>




    </div>

</body>


<!-- Mirrored from miller.bslthemes.com/aquarele-demo/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Nov 2024 06:12:16 GMT -->

</html>