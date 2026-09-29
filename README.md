# 🎂 Cake Fantasy — Premium Online Bakery & Custom Cake Ordering System

[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![JavaScript](https://img.shields.io/badge/JavaScript-ES6%2B-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)](https://developer.mozilla.org/)
[![CSS3](https://img.shields.io/badge/CSS3-Modern_UI-1572B6?style=for-the-badge&logo=css3&logoColor=white)](https://www.w3.org/Style/CSS/)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

An end-to-end full-stack e-commerce web application designed for bakeries and confectionery shops. **Cake Fantasy** delivers a warm, luxurious shopping experience for customers to browse artisan cakes, build custom celebration cakes, manage shopping carts, and complete secure checkouts with multi-method payment support—coupled with an administrative command center for order fulfillment and inventory management.

---

## 🌟 Key Highlights & Features

### 🛍️ 1. Customer Storefront & Ordering Experience
* **Dynamic Category & Product Catalog**: Explore wedding cakes, bento cakes, cupcakes, celebration cakes, and combo packages with live database retrieval.
* **Instant Keyword Search**: Fast, responsive search bar in the navbar across all pages.
* **Custom Cake Builder**: Interactive custom cake order customizer allowing customers to choose flavors, frostings, tiers, custom messages, and scheduled delivery dates.
* **Smart Shopping Cart**: Session-backed cart with real-time navbar badge counters, live item quantity increments/decrements, subtotal recalculations, and empty-state illustrations.

### 💳 2. Checkout & Multi-Payment Processing
* **Interactive Checkout Flow**: Prefills registered customer credentials; manages direct product checkout or complete cart checkout.
* **Credit / Debit Card Checkout**: Dynamic card billing form with client-side input masking (auto-formatting 16-digit card numbers and `MM/YY` expiry dates as you type).
* **Cash on Delivery (COD)**: Instant order confirmation with status tracking in MySQL.

### 🔐 3. Authentication & Real Google Sign-In
* **Secure Customer Auth**: Password hashing using `password_hash()` and `password_verify()`.
* **Google Sign-In Integration**: Integrated with Google Identity Services (GIS) and real Gmail authentication—automatically provisioning customer accounts in MySQL on first login.
* **Personalized Navbar State**: Live session greeting (e.g. *"Hi, Chanaka"*) with single-click logout.

### 🛡️ 4. Administration Dashboard & System Control
* **Protected System Owner (`ramesha`)**: Multi-layer security guard making the system owner immune to deletion, modification, or password overrides.
* **Inventory & Category Management**: Add, update, and remove cake items and categories with automatic image processing and storage into `/images`.
* **Order Tracking & Metrics**: Real-time sales KPIs, order delivery status updates, and transaction monitoring.

---

## 📂 Project Directory Structure

Organized following professional web standards:

```text
cakefantasy/
├── admin/                     # Administrative control panel
│   ├── partials/              # Admin layout headers, footers & auth checks
│   ├── add-products.php       # Product creation controller
│   ├── manage-products.php    # Inventory management
│   ├── manage-order.php       # Order tracking & processing
│   ├── manage-catagory.php    # Category management
│   ├── manage-admin.php       # Admin access & system owner protection
│   └── login.php              # Modern administrative login
├── config/
│   └── constants.php          # Database credentials, SITEURL, & session buffering
├── css/                       # Stylesheets (modular design)
│   ├── stylepro.css           # Global frontend system theme
│   ├── stylelog.css           # Customer authentication styling & modal popups
│   └── admin.css              # Dashboard layout & management tables
├── js/                        # JavaScript controllers
│   ├── script.js              # Authentication UI toggles
│   └── checkout.js            # Card masking & payment handlers
├── images/                    # Consolidated asset storage (120+ optimized photos)
├── partials-front/            # Frontend header, search navbar & footer components
├── Project.php                # Homepage & featured showcase
├── catagory.php               # Browse all cake categories
├── product.php                # Filtered category items
├── view.php                   # Quick-view product preview
├── customize.php              # Bespoke custom cake configuration
├── cart.php                   # Shopping cart management
├── checkout.php               # Delivery billing & order confirmation
├── payment.php                # Interactive card & COD payment gateway
├── login.php                  # Customer sign-in & Google authentication
├── process.php                # Registration, sign-in & Google auth backend
├── project.sql                # Complete MySQL schema & seed data
├── setup_db.php               # One-click browser database setup wizard
└── README.md                  # Project documentation
```

---

## 🛠️ Technology Stack

| Layer | Technologies Used |
|---|---|
| **Backend** | PHP 8.2+ (Procedural / Prepared Statements), MySQL Database |
| **Frontend** | HTML5, CSS3 (Custom Variables, Flexbox, CSS Grid), Vanilla JavaScript (ES6+) |
| **Authentication** | PHP Session Management, `BCrypt` Hashing, Google Identity Services SDK |
| **Server Environment** | Apache (WampServer / XAMPP / LAMP) |
| **Fonts & Icons** | FontAwesome 6, Google Fonts (*Outfit*, *Raleway*, *Great Vibes*) |

---

## 🗄️ Database Schema Overview

The MySQL database `project` contains 5 core relational tables:

1. **`tbl_users`**: Stores registered customer credentials (`first_name`, `last_name`, `user_name`, `email`, hashed `password`).
2. **`usr_admin`**: Administrator profiles (`ADmin_id`, `A_FullName`, `A_UserName`, `A_Password`, `A_status`).
3. **`tbl_catagory`**: Cake category catalog (`id`, `title`, `image_name`, `featured`, `active`).
4. **`tbl_cakes`**: Individual pastry items linked by `catagory_id` (`id`, `title`, `description`, `price`, `image_name`, `featured`, `active`).
5. **`tbl_order`**: Customer purchase transactions (`id`, `product`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`).

---

## 🚀 Getting Started & Installation

### Prerequisites
* [WampServer](https://www.wampserver.com/) or [XAMPP](https://www.apachefriends.org/) with **PHP 8.0+** and **MySQL 5.7+**.

### Step-by-Step Setup

1. **Clone the Repository**:
   ```bash
   cd C:/wamp64/www/
   git clone https://github.com/your-username/cakefantasy.git
   ```

2. **Start Local Server**:
   * Open WampServer or XAMPP and ensure **Apache** and **MySQL** services are running.

3. **Initialize Database with 1-Click Wizard**:
   * Open your web browser and navigate to:
     ```
     http://localhost/cakefantasy/setup_db.php
     ```
   * The setup script will automatically create the database `project`, import `project.sql`, and seed all categories, products, customer accounts, and administrative users.

4. **Launch the Application**:
   * **Customer Storefront**: `http://localhost/cakefantasy/Project.php`
   * **Admin Dashboard**: `http://localhost/cakefantasy/admin/login.php`

---

## 🔑 Demo Credentials

### 👨‍💼 Administrator Account
* **URL:** `http://localhost/cakefantasy/admin/login.php`
* **Username:** `ramesha` *(System Owner)*
* **Password:** `admin`

### 👤 Sample Customer Accounts
* **URL:** `http://localhost/cakefantasy/login.php`
* **Email:** `sandali07@gmail.com` | **Password:** `password`
* **Email:** `devinu@gmail.com` | **Password:** `password`
* *(Or click **"Continue with Google"** to log in instantly with your real Gmail!)*

---

## 📸 Screenshots Showcase

*(Tip: Add your project screenshots here when uploading to GitHub!)*

| Customer Storefront | Custom Cake Customizer |
|:---:|:---:|
| ![Homepage](images/shop.jpg) | ![Customizer](images/custom.jpg) |

| Shopping Cart & Checkout | Admin Dashboard |
|:---:|:---:|
| ![Cart](images/cheesecake.jpg) | ![Admin Panel](images/logo.jpg) |

---

## 👩‍💻 Author & Acknowledgements

* **Developer & System Designer:** Ramesha Sandali
* **Designed for:** Diploma in Information Technology (DIT) Final Project Showcase

---

## 📝 License

This project is licensed under the **MIT License** — feel free to use and customize it for learning and portfolio purposes!
