<?php 

// koneksi ke database 
require 'functions.php';

// ambil data menu
$menu = query("SELECT * FROM menu");

// ambil data produk
$products = query("SELECT * FROM products");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Bites</title>

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.png" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
        rel="stylesheet">

    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Style -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Midtrans -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="SB-Mid-client-sY-TkgALWukXP-Ul"></script>

    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- App -->
    <script src="src/app.js" async></script>

</head>


<body>

    <!--! Navbar Start -->
    <nav class="navbar" x-data>
        <a href="#" class="navbar-logo">Golden <span>Bites</span>.</a>

        <div class="navbar-nav">
            <a href="#hero">Home</a>
            <a href="#about">About Us</a>
            <a href="#menu">Menu</a>
            <a href="#products">Products</a>
            <a href="#contact">Contact</a>
        </div>

        <div class="navbar-extra">
            <a href="#" id="search-button"><i data-feather="search"></i></a>
            <a href="#" id="shopping-cart-button">
                <i data-feather="shopping-cart"></i>
                <span class="quantity-badge" x-show="$store.cart.quantity" x-text="$store.cart.quantity"></span>
            </a>
            <a href="#" id="hamburger-menu"><i data-feather="menu"></i></a>
        </div>

        <!-- Search Form Start -->
        <div class="search-form">
            <input type="search" id="search-box" placeholder="search here...">
            <label for="search-box"><i data-feather="search"></i></label>
        </div>
        <!-- Search Form End -->

        <!-- Shopping Cart Start -->
        <div class="shopping-cart">
            <template x-for="(item, index) in $store.cart.items" x-key="index">
                <div class="cart-item">
                    <img :src="`img/products/${item.img}`" :alt="item.name">
                    <div class="item-details">
                        <h3 x-text="item.name"></h3>
                        <div class="item-price">
                            <span x-text="rupiah(item.price)"></span> &times;
                            <button id="remove" @click="$store.cart.remove(item.id)">&minus;</button>
                            <span x-text=" item.quantity"></span>
                            <button id="add" @click="$store.cart.add(item)">&plus;</button> &equals;
                            <span x-text="rupiah(item.total)"></span>
                        </div>
                    </div>
                </div>
            </template>
            <h4 x-show="!$store.cart.items.length" style="margin-top: 2rem;">Cart is Empty</h4>
            <h4 x-show="$store.cart.items.length">Total : <span x-text="rupiah($store.cart.total)"></span></h4>

            <div class="form-container" x-show="$store.cart.items.length">
                <form action="" id="checkoutForm">
                    <input type="hidden" name="items" x-model="JSON.stringify($store.cart.items)">
                    <!-- <input type="hidden" name="items" x-model="$store.cart.items"> -->
                    <h5>Customer Details</h5>
                    <label for="name">
                        <span>Name</span>
                        <input type="text" id="name" name="name">
                    </label>

                    <label for="email">
                        <span>Email</span>
                        <input type="email" id="email" name="email">
                    </label>

                    <label for="phone">
                        <span>Phone</span>
                        <input type="number" id="phone" name="phone" autocomplete="off">
                    </label>

                    <label for="address">
                        <span> Address</span>
                        <input type="text" id="address" name="address">
                    </label>

                    <button class="checkout-button disabled" type="submit" id="checkout-button"
                        value="checkout">Checkout</button>
                </form>
            </div>
        </div>
        <!-- Shopping Cart End -->

    </nav>
    <!--? Navbar End -->

    <!--! Hero Section Start -->
    <section class="hero" id="hero">
        <div class="mask-container">
            <main class="content">
                <h1>Where Every <span>Cookie </span>is a <span>Golden Delight</span></h1>
                <p>Crafted with care, baked to perfection.</p>
            </main>
        </div>
    </section>
    <!--? Hero Section End -->

    <!--! About Section Start -->
    <section id="about" class="about">
        <h2><span>About</span> Us</h2>

        <div class="row">
            <div class="about-img">
                <img src="img/about.jpg" alt="Tentang Kami">
            </div>
            <div class="content">
                <h3>Who We Are?</h3>
                <p>Golden Bites is a team of passionate bakers and cookie enthusiasts dedicated to creating memorable
                    experiences for those who love sweet treats. Starting from family recipes and experiments in a small
                    kitchen, Golden Bites has grown into a beloved bakery known for its unique flavors and quality.</p>
                <p>Each team member brings a unique skill set and an unwavering commitment to crafting high-quality
                    cookies. From our bakers to our marketing team, we work together to deliver treats that not only
                    satisfy your taste buds but also bring a little happiness into your day. We believe that every bite
                    can create lasting memories, and that’s what we aim to offer through each of our cookies.</p>
                <p>As a community of cookie lovers, we’re always eager to grow and innovate. We deeply value the
                    feedback and support of our cherished customers. Let’s make Golden Bites a place where each cookie
                    brings joy and warmth.</p>
            </div>
        </div>

    </section>
    <!--? About Section End -->

    <!--//! INI VERSI HTML TANPA DATABASE -->
    <!--! Menu Section Start -->
    <!-- <section id="menu" class="menu">
        <h2><span>Our</span> Menu</h2>
        <p>Explore Our Exquisite Cookie Collection.</p>
        <p>Can only be ordered directly in store</p>

        <div class="row">
            <div class="menu-card">
                <img src="img/menu/1.jpg" alt="Rainbow Chip Cookies" class="menu-card-img">
                <h3 class="menu-card-title">Rainbow Chip Cookies</h3>
                <p class="menu-card-price">IDR 25.000</p>
            </div>
            <div class="menu-card">
                <img src="img/menu/2.jpg" alt="Chocolate Cookies" class="menu-card-img">
                <h3 class="menu-card-title">Chocolate Cookies</h3>
                <p class="menu-card-price">IDR 25.000</p>
            </div>
            <div class="menu-card">
                <img src="img/menu/3.jpg" alt="Macarons" class="menu-card-img">
                <h3 class="menu-card-title">Macarons</h3>
                <p class="menu-card-price">IDR 30.000</p>
            </div>
            <div class="menu-card">
                <img src="img/menu/4.jpg" alt="British Cookies" class="menu-card-img">
                <h3 class="menu-card-title">British Cookies</h3>
                <p class="menu-card-price">IDR 25.000</p>
            </div>
            <div class="menu-card">
                <img src="img/menu/5.jpg" alt="Ginger Cookies" class="menu-card-img">
                <h3 class="menu-card-title">Ginger Cookies</h3>
                <p class="menu-card-price">IDR 25.000</p>
            </div>
            <div class="menu-card">
                <img src="img/menu/6.jpg" alt="Christmas Cookies" class="menu-card-img">
                <h3 class="menu-card-title">Christmas Cookies</h3>
                <p class="menu-card-price">IDR 25.000</p>
            </div>
            <div class="menu-card">
                <img src="img/menu/7.jpg" alt="Almond Cookies" class="menu-card-img">
                <h3 class="menu-card-title">Almond Cookies</h3>
                <p class="menu-card-price">IDR 25.000</p>
            </div>
        </div>

    </section> -->
    <!--? Menu Section End -->

    <!--//TODO INI VERSI PHP DENGAN DATABASE -->
    <!-- Menu Section Start -->
        <section id="menu" class="menu">
            <h2><span>Our</span> Menu</h2>
            <p>Explore Our Exquisite Cookie Collection.</p>
            <p>Can only be ordered directly in store</p>

            <div class="row">
                <?php foreach($menu as $row) : ?>
                <div class="menu-card">
                    <img src="img/menu/<?= $row['img']; ?>" alt="<?= $row['name']; ?>" class="menu-card-img">
                    <h3 class="menu-card-title"><?= $row['name']; ?></h3>
                    <p class="menu-card-price">IDR <?= number_format($row['price'], 0, ',', '.'); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    <!-- Menu Section End -->

    <!--//! INI VERSI HTML TANPA DATABASE -->
    <!--! Products Section Start -->
    <!-- <section class="products" id="products" x-data="products()">
        <h2><span>Our</span> Products</h2>
        <p>Delight in Every Bite, Crafted to Perfection</p>

        <div class="row">
            <template x-for="(item, index) in items" x-key="index">
                <div class="product-card">
                    <div class="product-icons">
                        <a href="#" @click.prevent="$store.cart.add(item)">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <use href="img/feather-sprite.svg#shopping-cart" />
                            </svg>
                        </a>
                        <a href="#" class="item-detail-button">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <use href="img/feather-sprite.svg#eye" />
                            </svg>
                        </a>
                    </div>
                    <div class="product-image">
                        <img :src="`img/products/${item.img}`" :alt="item.name">
                    </div>
                    <div class="product-content">
                        <h3 x-text="item.name"></h3>
                        <div class="product-stars">
                            <svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <use href="img/feather-sprite.svg#star" />
                            </svg>
                            <svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <use href="img/feather-sprite.svg#star" />
                            </svg>
                            <svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <use href="img/feather-sprite.svg#star" />
                            </svg>
                            <svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <use href="img/feather-sprite.svg#star" />
                            </svg>
                            <svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <use href="img/feather-sprite.svg#star" />
                            </svg>
                        </div>
                        <div class="product-price">
                            <span x-text="rupiah(item.price)"></span>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </section> -->
    <!--? Products Section End -->

    <!--//TODO INI VERSI PHP DENGAN DATABASE -->
    <!-- Products Section Start -->
    <section class="products" id="products" x-data="cart">
        <h2><span>Our</span> Products</h2>
        <p>Delight in Every Bite, Crafted to Perfection</p>

        <div class="row">
            <?php foreach ($products as $product) : ?>
                <div class="product-card">
                    <div class="product-icons">
                        <a href="#" @click.prevent="$store.cart.add({
                                id: <?php echo $product['id']; ?>,
                                name: '<?php echo $product['name']; ?>',
                                price: <?php echo $product['price']; ?>,
                                img: '<?php echo $product['img']; ?>'
                            })">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <use href="img/feather-sprite.svg#shopping-cart" />
                            </svg>
                        </a>
                        <a href="#" class="item-detail-button">
                            <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <use href="img/feather-sprite.svg#eye" />
                            </svg>
                        </a>
                    </div>
                    <div class="product-image">
                        <img src="img/products/<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                    <div class="product-content">
                        <h3><?php echo $product['name']; ?></h3>
                        <div class="product-price">
                            <span>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <!-- Products Section End -->





    <!--! Contact Section Start -->
    <section id="contact" class="contact">
        <h2><span>Contact</span> Us</h2>
        <p>We’re Here to Bring Sweet Moments Closer to You</p>

        <div class="row">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d37548.949023766705!2d107.57682013612059!3d-6.865682945221965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6bfeb9936ef%3A0x909438ca7baeb460!2sThe%20Harnadi&#39;s%20Home%20Stay!5e1!3m2!1sid!2sid!4v1730928588785!5m2!1sid!2sid"
                style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                class="map"></iframe>

            <form action="">
                <div class="input-group">
                    <i data-feather="user"></i>
                    <input type="text" placeholder="name">
                </div>
                <div class="input-group">
                    <i data-feather="mail"></i>
                    <input type="text" placeholder="email">
                </div>
                <div class="input-group">
                    <i data-feather="phone"></i>
                    <input type="text" placeholder="phone number">
                </div>
                <button type="submit" class="btn">Send message</button>
            </form>
        </div>
    </section>
    <!--? Contact Section End -->

    <!--! Footer Start -->
    <footer>
        <div class="socials">
            <a href="https://www.instagram.com/klvinjulian" target="_blank">
            <i data-feather="instagram"></i>
            </a>
            <a href="https://twitter.com/sobertod" target="_blank">
            <i data-feather="twitter"></i>
            </a>
            <a href="https://www.facebook.com/share/1AojCbTc4k/" target="_blank">
            <i data-feather="facebook"></i>
            </a>
        </div>
        <div class="links">
            <a href="#hero">Home</a>
            <a href="#about">About Us</a>
            <a href="#menu">Menu</a>
            <a href="#products">Products</a>
            <a href="#contact">Contact</a>
        </div>
        <div class="credit">
            <p>Created by <a href="admin.php">Kelvin Julian</a>. | &copy; 2024.</p>
        </div>
    </footer>
    <!--? Footer End -->

    <!-- Modal Box Item Detail Start -->
    <div class="modal" id="item-detail-modal">
        <div class="modal-container">
            <a href="#" class="close-icon"><i data-feather="x"></i></a>
            <div class="modal-content">
                <img src="img/products/1.jpg" alt="Golden Choco Delight">
                <div class="product-content">
                    <h3>Golden Choco Delight</h3>
                    <p>A package filled with rich, handcrafted chocolate cookies. Perfect for chocolate lovers, this
                        selection offers a delightful, indulgent treat in every bite.</p>
                    <div class="product-stars">
                        <i data-feather="star" class="star-full"></i>
                        <i data-feather="star" class="star-full"></i>
                        <i data-feather="star" class="star-full"></i>
                        <i data-feather="star" class="star-full"></i>
                        <i data-feather="star" class="star-full"></i>
                    </div>
                    <div class="product-price">
                        IDR 175.000 <span>IDR 200.000</span>
                    </div>
                    <a href="#"><i data-feather="shopping-cart"></i><span>Add to cart</span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Box Item Detail End -->

    <!-- Feather Icons -->
    <script>
        feather.replace();
    </script>

    <!-- My Javascript -->
    <script src="js/script.js"></script>
</body>

</html>