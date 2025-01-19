<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Medicine Shoppppppppppppp</title>
    <link rel="stylesheet" href="styles.css">
   <style>
    /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
    color: #333;
}

/* Header Styling */
header {
    background-color: #2C3E50;
    color: #fff;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header .logo h1 {
    margin: 0;
    font-size: 1.8rem;
}

header nav ul {
    list-style: none;
    display: flex;
}

header nav ul li {
    margin-right: 20px;
}

header nav ul li a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
}

header input[type="search"] {
    padding: 5px;
    font-size: 1rem;
}

header .cart-icon {
    font-size: 1.5rem;
    cursor: pointer;
}

/* Hero Section Styling */
.hero {
    background-color: #2980B9;
    color: #fff;
    text-align: center;
    padding: 60px 0;
}

.hero h1 {
    font-size: 3rem;
    margin-bottom: 20px;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 30px;
}

.hero button {
    padding: 10px 20px;
    font-size: 1rem;
    background-color: #E74C3C;
    color: white;
    border: none;
    cursor: pointer;
}

.hero button:hover {
    background-color: #C0392B;
}

/* Featured Categories Section */
.categories {
    display: flex;
    justify-content: space-around;
    padding: 50px 20px;
    background-color: #ECF0F1;
}

.category {
    text-align: center;
    width: 30%;
}

.category img {
    width: 100%;
    max-width: 150px;
    height: 150px;
    object-fit: cover;
}

.category h3 {
    margin-top: 10px;
    font-size: 1.2rem;
}

/* Bestsellers Section */
.bestsellers {
    text-align: center;
    padding: 50px 20px;
}

.bestsellers h2 {
    margin-bottom: 40px;
}

.product {
    display: inline-block;
    width: 30%;
    margin: 10px;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.product img {
    width: 100%;
    max-width: 150px;
    height: 150px;
    object-fit: cover;
}

.product h3 {
    font-size: 1.2rem;
    margin-top: 10px;
}

.product p {
    font-size: 1rem;
    margin: 10px 0;
}

.product button {
    padding: 10px 20px;
    background-color: #2980B9;
    color: white;
    border: none;
    cursor: pointer;
}

.product button:hover {
    background-color: #3498DB;
}

/* Offers Section */
.offers {
    text-align: center;
    background-color: #F39C12;
    color: white;
    padding: 40px 20px;
}

.offers h2 {
    font-size: 2rem;
    margin-bottom: 10px;
}

.offers p {
    font-size: 1.2rem;
}

/* Newsletter Section */
.newsletter {
    text-align: center;
    background-color: #BDC3C7;
    padding: 40px 20px;
}

.newsletter h2 {
    margin-bottom: 10px;
}

.newsletter p {
    font-size: 1.2rem;
    margin-bottom: 20px;
}

.newsletter input[type="email"] {
    padding: 10px;
    width: 250px;
    font-size: 1rem;
    margin-right: 10px;
}

.newsletter button {
    padding: 10px 20px;
    font-size: 1rem;
    background-color: #E74C3C;
    color: white;
    border: none;
    cursor: pointer;
}

.newsletter button:hover {
    background-color: #C0392B;
}

/* Footer Styling */
footer {
    background-color: #2C3E50;
    color: #fff;
    text-align: center;
    padding: 20px;
}

footer .footer-links ul {
    list-style: none;
    display: inline-flex;
}

footer .footer-links ul li {
    margin-right: 20px;
}

footer .footer-links ul li a {
    color: #fff;
    text-decoration: none;
}

footer .social-icons a {
    color: #fff;
    margin-right: 20px;
    text-decoration: none;
}

   </style>
</head>

<body>
    <!-- Header Section -->
    <header>
        <div class="logo">
            <h1>Your Pharmacy</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <input type="search" placeholder="Search for Medicines...">
        <div class="cart-icon">🛒 Cart (0)</div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Your Trusted Online Pharmacy</h1>
            <p>Explore a wide range of medicines and health products at your fingertips.</p>
            <button onclick="window.location.href='#shop'">Shop Now</button>
        </div>
    </section>

    <!-- Featured Categories -->
    <section class="categories">
        <div class="category">
            <img src="https://via.placeholder.com/150" alt="Prescription Medications">
            <h3>Prescription Medications</h3>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/150" alt="OTC Medicines">
            <h3>Over-the-Counter Medicines</h3>
        </div>
        <div class="category">
            <img src="https://via.placeholder.com/150" alt="Health Supplements">
            <h3>Health Supplements</h3>
        </div>
    </section>

    <!-- Bestsellers Section -->
    <section class="bestsellers">
        <h2>Bestselling Products</h2>
        <div class="product">
            <img src="https://via.placeholder.com/150" alt="Product 1">
            <h3>Aspirin Tablets</h3>
            <p>$10</p>
            <button>Buy Now</button>
        </div>
        <div class="product">
            <img src="https://via.placeholder.com/150" alt="Product 2">
            <h3>Vitamin C Supplement</h3>
            <p>$15</p>
            <button>Buy Now</button>
        </div>
        <div class="product">
            <img src="https://via.placeholder.com/150" alt="Product 3">
            <h3>Cough Syrup</h3>
            <p>$8</p>
            <button>Buy Now</button>
        </div>
    </section>

    <!-- Offers Section -->
    <section class="offers">
        <h2>Special Offers</h2>
        <p>Get 20% off on all medicines!</p>
    </section>

    <!-- Newsletter Subscription -->
    <section class="newsletter">
        <h2>Stay Updated!</h2>
        <p>Subscribe to our newsletter for special offers and health tips.</p>
        <input type="email" placeholder="Enter your email" />
        <button>Subscribe</button>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="footer-links">
            <ul>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">Contact Us</a></li>
            </ul>
        </div>
        <div class="social-icons">
            <a href="#">Facebook</a>
            <a href="#">Instagram</a>
            <a href="#">Twitter</a>
        </div>
        <p>&copy; 2025 Your Pharmacy</p>
    </footer>
</body>

</html>
