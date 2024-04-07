<?php
session_start();
$user = '';
if (!isset($_SESSION["user"])) {
    $user == "guest";  //default user is guest 
} else {
    $user = $_SESSION["user"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- boxicon -->
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


    <!-- css -->
    <link rel="stylesheet" href="asset/style/navbar.css">
    <link rel="stylesheet" href="asset/style/root.css">
    <link rel="stylesheet" href="asset/style/home.css">
    <!-- <link rel="stylesheet" href="asset/style/ProductCard.css"> -->
    <link rel="stylesheet" href="asset/slider/slider.css">
    <script defer src="asset/slider/script.js"></script>
    <link rel="stylesheet" href="asset/style/item.css">
    <!-- js -->


    <!-- slider -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="asset/slider/style.css">


    <!-- footer -->
    <link rel="stylesheet" href="asset/footer/style.css">

    <script src="asset/json/getProduct.js"></script>



</head>

<body>
    <div class="header-wrapper">

        <header class="navbar ">

            <div class="dropdown" style="display: none;">
                <button onclick="myFunction()" class="dropbtn"> <box-icon class="bx" name='menu'></box-icon></button>
                <div id="myDropdown" class="dropdown-content" style="display: none; margin-left: 10px; transition: all 0.4s ease-in-out;">
                    <a href="" id="current_page">HOME</a>
                    <a href="shop.php">SHOP</a>
                    <a href="orderComplete.php">YOUR ORDER</a>
                    <a href="about.php">ABOUT</a>

                </div>

            </div>

            <!-- nav -->
            <nav>
                <a href="" id="current_page">HOME</a>
                <a href="shop.php">SHOP</a>
                <a href="orderComplete.php">YOUR ORDER</a>
                <a href="about.php">ABOUT</a>

            </nav>

            <!-- Logo -->
            <div class="logo">
                Acubi
            </div>


            <div class="left">


                <!-- Cart -->
                <div class="cart flex-center">

                    <div class="cart-info">
                        $0
                    </div>
                    <svg class="cart-icon" style="cursor: pointer;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="ast-basket-icon-svg" x="0px" y="0px" width="100" height="100" viewBox="826 826 140 140" enable-background="new 826 826 140 140" xml:space="preserve">
                        <path d="M955.418,887.512c2.344,0,4.343,0.829,6.002,2.486c1.657,1.659,2.486,3.659,2.486,6.002c0,2.343-0.829,4.344-2.486,6.001  c-1.659,1.658-3.658,2.487-6.002,2.487h-0.994l-7.627,43.9c-0.354,2.033-1.326,3.713-2.917,5.04  c-1.593,1.326-3.405,1.989-5.438,1.989h-84.883c-2.033,0-3.846-0.663-5.438-1.989c-1.591-1.327-2.564-3.007-2.918-5.04l-7.626-43.9  h-0.995c-2.343,0-4.344-0.829-6.001-2.487c-1.658-1.657-2.487-3.658-2.487-6.001c0-2.343,0.829-4.343,2.487-6.002  c1.658-1.658,3.659-2.486,6.001-2.486H955.418z M860.256,940.563c1.149-0.089,2.111-0.585,2.885-1.491  c0.773-0.907,1.116-1.936,1.028-3.085l-2.122-27.586c-0.088-1.15-0.585-2.111-1.492-2.885c-0.906-0.774-1.934-1.117-3.083-1.028  c-1.149,0.088-2.111,0.586-2.885,1.492s-1.116,1.934-1.028,3.083l2.122,27.587c0.088,1.105,0.542,2.034,1.359,2.785  c0.818,0.752,1.78,1.128,2.885,1.128H860.256z M887.512,936.319v-27.587c0-1.149-0.42-2.144-1.26-2.984  c-0.84-0.84-1.834-1.26-2.984-1.26s-2.144,0.42-2.984,1.26c-0.84,0.841-1.26,1.835-1.26,2.984v27.587c0,1.149,0.42,2.145,1.26,2.984  c0.84,0.84,1.835,1.26,2.984,1.26s2.144-0.42,2.984-1.26C887.092,938.464,887.512,937.469,887.512,936.319z M912.977,936.319  v-27.587c0-1.149-0.42-2.144-1.26-2.984c-0.841-0.84-1.835-1.26-2.984-1.26s-2.145,0.42-2.984,1.26  c-0.84,0.841-1.26,1.835-1.26,2.984v27.587c0,1.149,0.42,2.145,1.26,2.984s1.835,1.26,2.984,1.26s2.144-0.42,2.984-1.26  C912.557,938.464,912.977,937.469,912.977,936.319z M936.319,936.65l2.122-27.587c0.088-1.149-0.254-2.177-1.027-3.083  s-1.735-1.404-2.885-1.492c-1.15-0.089-2.178,0.254-3.084,1.028c-0.906,0.773-1.404,1.734-1.492,2.885l-2.122,27.586  c-0.088,1.149,0.254,2.178,1.027,3.085c0.774,0.906,1.736,1.402,2.885,1.491h0.332c1.105,0,2.066-0.376,2.885-1.128  C935.777,938.685,936.23,937.756,936.319,936.65z M859.66,855.946l-6.167,27.322h-8.753l6.698-29.245  c0.84-3.89,2.807-7.062,5.902-9.516c3.095-2.453,6.632-3.68,10.611-3.68h11.074c0-1.149,0.42-2.144,1.26-2.984  c0.84-0.84,1.835-1.26,2.984-1.26h25.465c1.149,0,2.144,0.42,2.984,1.26c0.84,0.84,1.26,1.834,1.26,2.984h11.074  c3.979,0,7.516,1.227,10.611,3.68c3.094,2.454,5.062,5.626,5.901,9.516l6.697,29.245h-8.753l-6.168-27.322  c-0.486-1.945-1.491-3.537-3.017-4.774c-1.525-1.238-3.282-1.857-5.272-1.857h-11.074c0,1.15-0.42,2.144-1.26,2.984  c-0.841,0.84-1.835,1.26-2.984,1.26h-25.465c-1.149,0-2.144-0.42-2.984-1.26c-0.84-0.84-1.26-1.834-1.26-2.984h-11.074  c-1.99,0-3.747,0.619-5.272,1.857C861.152,852.409,860.146,854,859.66,855.946z">
                        </path>
                    </svg>


                    <div class="items-amount flex-center">
                        0
                    </div>


                    <div class="cart-sock">
                        <div class="cart-title" style="display: flex;">
                            <span> Shopping cart</span>
                            <div id="cart-close"><box-icon name='x'></box-icon></div>
                        </div>


                        <ul class="cart-body">
                            <li>No items in the shopping cart.</li>
                        </ul>

                        <div class="cart-total" style="display: flex;  justify-content: space-between;">
                            <div class="sub-total">
                                Sub Total
                            </div>

                            <div class="sub-money">
                                $ <span class="total-money">0</span>
                            </div>
                        </div>

                        <div class="cart-submit flex-center">
                            <a href="cart.php" class="view-cart-button">View cart</a>
                            <a href="checkout.php" class="checkout-btn">Check out</a>
                        </div>


                    </div>
                </div>



                <!-- Search -->
                <div class="search flex-center">



                    <box-icon class="search-icon" name='search'></box-icon>


                </div>


                <div class="search-wrapper">
                    <input class="search-input" type="search" placeholder="Search for products..." />
                    <button class="search-btn"><box-icon class="search-icon-submit" name='search'></box-icon></button>
                    <div id="search-close"><box-icon name='x'></box-icon></div>
                </div>


                <!-- Login -->
                <?php
                if (isset($_SESSION["user"])) {
                    echo '<a class="login flex-center" href="logout.php">
                    Welcome, ' . $user . '
                </a>';
                } else {
                    echo ' <a class="login flex-center" href="login.php">
                    LOG IN
                    
                </a>
                        ';
                }
                ?>

            </div>

        </header>

        <main class="header-body flex-center">

            <div class="img" style="position: relative;">
                <img src="asset/image/poster.png" alt="" srcset="">
                <a href="#new-collection" class="shop-now-btn">SHOP NOW</a>
            </div>
        </main>


        <section id="new-collection" class="new-collection">
            <h2 style="text-align: center; font-size: 44px;">Summer Collection</h2>
            <div class="swiper-container">

                <section id="tranding">
                    <div class="container">
                        <div class="swiper tranding-slider">
                            <div class="swiper-wrapper">
                                <!-- Slide-start -->
                                <div class="swiper-slide tranding-slide">
                                    <div class="tranding-slide-img">
                                        <img src="asset/slider/images/item1.jpg" alt="Tranding">
                                    </div>
                                    <div class="tranding-slide-content">
                                        <h1 class="item-price">$20</h1>
                                        <div class="tranding-slide-content-bottom">
                                            <h2 class="item-name">
                                                Special Pizza
                                            </h2>

                                        </div>
                                    </div>
                                </div>
                                <!-- Slide-end -->
                                <!-- Slide-start -->
                                <div class="swiper-slide tranding-slide">
                                    <div class="tranding-slide-img">
                                        <img src="asset/slider/images/item2.jpg" alt="Tranding">
                                    </div>
                                    <div class="tranding-slide-content">
                                        <h1 class="item-price">$20</h1>
                                        <div class="tranding-slide-content-bottom">
                                            <h2 class="item-name">
                                                Meat Ball
                                            </h2>

                                        </div>
                                    </div>
                                </div>
                                <!-- Slide-end -->
                                <!-- Slide-start -->
                                <div class="swiper-slide tranding-slide">
                                    <div class="tranding-slide-img">
                                        <img src="asset/slider/images/item3.jpg" alt="Tranding">
                                    </div>
                                    <div class="tranding-slide-content">
                                        <h1 class="item-price">$40</h1>
                                        <div class="tranding-slide-content-bottom">
                                            <h2 class="item-name">
                                                Burger
                                            </h2>

                                        </div>
                                    </div>
                                </div>
                                <!-- Slide-end -->
                                <!-- Slide-start -->
                                <div class="swiper-slide tranding-slide">
                                    <div class="tranding-slide-img">
                                        <img src="asset/slider/images/item4.jpg" alt="Tranding">
                                    </div>
                                    <div class="tranding-slide-content">
                                        <h1 class="item-price">$15</h1>
                                        <div class="tranding-slide-content-bottom">
                                            <h2 class="item-name">
                                                Frish Curry
                                            </h2>

                                        </div>
                                    </div>
                                </div>
                                <!-- Slide-end -->
                                <!-- Slide-start -->
                                <div class="swiper-slide tranding-slide">
                                    <div class="tranding-slide-img">
                                        <img src="asset/slider/images/item5.jpg" alt="Tranding">
                                    </div>
                                    <div class="tranding-slide-content">
                                        <h1 class="item-price">$15</h1>
                                        <div class="tranding-slide-content-bottom">
                                            <h2 class="item-name">
                                                Pane Cake
                                            </h2>

                                        </div>
                                    </div>
                                </div>
                                <!-- Slide-end -->
                                <!-- Slide-start -->
                                <div class="swiper-slide tranding-slide">
                                    <div class="tranding-slide-img">
                                        <img src="asset/slider/images/item3.jpg" alt="Tranding">
                                    </div>
                                    <div class="tranding-slide-content">
                                        <h1 class="item-price">$20</h1>
                                        <div class="tranding-slide-content-bottom">
                                            <h2 class="item-name">
                                                Vanilla cake
                                            </h2>

                                        </div>
                                    </div>
                                </div>
                                <!-- Slide-end -->
                                <!-- Slide-start -->

                                <!-- Slide-end -->
                            </div>

                            <div class="tranding-slider-control">
                                <div class="swiper-button-prev slider-arrow">
                                    <ion-icon name="arrow-back-outline"></ion-icon>
                                </div>
                                <div class="swiper-button-next slider-arrow">
                                    <ion-icon name="arrow-forward-outline"></ion-icon>
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </section>


        <section id="best-seller" class="best-seller" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <h2 style="font-size: 30px;  font-family: var(--emphasized-font); margin-bottom: 1em; display: flex; justify-content: center;">
                Best Selling</h2>

            <div class="shop-field">

            </div>

        </section>

        <div class="products-preview">

            <div class="preview" data-target="1">
                <div class="image">
                    <img src="asset/image/SHOP-IMG/i1.jpg" alt="">
                </div>
                <div class="pro-info">
                    <i class="fas fa-times"></i>
                    <h3>organic strawberries</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, dolorem.</p>
                    <div class="category">Category : top</div>
                    <div class="price">$2.00</div>
                    <div class="buttons">
                        <a href="#" class="cart">add to cart</a>
                    </div>
                </div>

            </div>
            <div class="preview" data-target="2">
                <div class="image">
                    <img src="asset/image/SHOP-IMG/i2.jpg" alt="">
                </div>
                <div class="pro-info">
                    <i class="fas fa-times"></i>
                    <h3>organic strawberries</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, dolorem.</p>
                    <div class="category">Category : top</div>
                    <div class="price">$2.00</div>
                    <div class="buttons">
                        <a href="#" class="cart">add to cart</a>
                    </div>
                </div>

            </div>
            <div class="preview" data-target="3">
                <div class="image">
                    <img src="asset/image/SHOP-IMG/m3.jpg" alt="">
                </div>
                <div class="pro-info">
                    <i class="fas fa-times"></i>
                    <h3>organic strawberries</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, dolorem.</p>
                    <div class="category">Category : top</div>
                    <div class="price">$2.00</div>
                    <div class="buttons">
                        <a href="#" class="cart">add to cart</a>
                    </div>
                </div>

            </div>
            <div class="preview" data-target="4">
                <div class="image">
                    <img src="asset/image/SHOP-IMG/m6.jpg" alt="">
                </div>
                <div class="pro-info">
                    <i class="fas fa-times"></i>
                    <h3>organic strawberries</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, dolorem.</p>
                    <div class="category">Category : top</div>
                    <div class="price">$2.00</div>
                    <div class="buttons">
                        <a href="#" class="cart">add to cart</a>
                    </div>
                </div>

            </div>



        </div>



    </div>




    <!-- ==== FOOOTER ==== -->

    <!-- ==== js ==== -->
    <script src="asset/js/addToCart.js"></script>
    <!-- navbar -->
    <script src="asset/js/navbar.js"></script>

    <!-- slider -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script src="asset/slider/script.js"></script>




</body>

</html>