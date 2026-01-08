<h1 align="center">ALIDADA an E-commerce Management System</h1>

## Description
### 🧩 Overview
The project is a mainly PHP and MYSQL based web application with 3 distinct roles
- **Admin** – manages inventory, categories and product stock.
- **Customer** – browses products, adds items to the cart, places orders and views order history.
- **DeliveryMan** – accepts placed orders for delivery, updates their statuses and views his previus completed delivery.
  
The application uses a **Model-View-Controller (MVC)-style structure**, separating the user interface, control logic and database layer. 
### 💡 What This Application Does
- Provides a complete, role-based shopping and delivery system.
- Allows real-time stock and order management via MySQL.
- Handles authentication, profile management and validation for all user types.
### 🧱 Challenges Faced
- Designing a multi-role login and session management system.
- Handling concurrent updates in stock levels during order placement.
### 🚀 Future Improvements
- Integration of **payment gateways**.
- Addition of **real-time notifications** for order status changes.
- Implementation of **RESTful APIs**.
- Enhanced **UI/UX** using a front-end framework like Bootstrap or React.

## Table of Contents
- [⚙️ How to Install and Run the Project](#️-how-to-install-and-run-the-project)
- [🧭 How to Use the Project](#-how-to-use-the-project)
- [🗂️ Project Structure](#️-project-structure)
- [🌟 Features](#-features)
- [🔑 Demo Credentials](#-demo-credentials)
- [🤝 Credits](#-credits)
- [📜 License](#-license)
- [🏷️ Badges](#️-badges)
- [🤝 How to Contribute to the Project](#️-how-to-contribute-to-the-project)
- [🧭 Tests](#️-tests)
- [🪶 Closing Remarks](#️-closing-remarks) 
## ⚙️ How to Install and Run the Project
The following have to be installed first
- A local server XAMPP
- PHP ≥ 7.4
- MySQL
- Code editor(e.g.Visual Studio Code)

1) Clone the project and extract it into your local server directory:
<pre>
  C:\xampp\htdocs\Project
</pre>
2) Open the XAMPP Control Panel and click start on Apache and MySQL.
3) Open any browser and go to http://localhost/phpmyadmin. Click on Import and choose the **e_commerce_management_system.sql** file.
4) Now to run the project open browser and go to:
<pre>
  http://localhost/E-Commerce
</pre>

## 🧭 How to Use the Project
- Authentication and roles: Users log in via Login.php and are redirected to a personalized dashboard based on their role: Admin, Customer, or Deliveryman. Each role has access to its own profile page where users can edit information, update or delete their accounts with server-side validation.
-	Customer flow: Browse and filter products, manage cart and place orders from the view cart page. View past orders history page with status(received, ordered or accepted) for each order.
-	Admin flow: Manage inventory with options to update the stock and add new products. Monitor stock-out items and Manage existing customers.
-	DeliveryMan flow: View placed orders and accept them for delivery. Update orders as delivered or canceled via the Delivery Status page and track completed deliveries and view total earnings in the Delivery History page 
### 🗂️ Project Structure
<pre>
E-Commerce/
├── index.php
├── controller/
│ └── loginValidation.php
│ └── logout.php
│ └──signupValidation.php
│ └── Admin/
│ │ └── adAddProductController.php
│ │ └── adDashboardController.php
│ │ └── adProfileController.php
│ │ └── userController.php
│ │ └── adUpdateStockController.php
│ └── Customer/
│ │ └── cusDashboardController.php
│ │ └── cusProfileController.php
│ │ └── historyController.php
│ │ └── viewCartController.php
│ │ └── holdCartController.php
│ └── Deliveryman/
│ │ └── deliDashboardController.php
│ │ └── deliDeliveryStatusController.php
│ │ └── deliDeliveryHistoryController.php
│ │ └── deliProfileController.php
├── model/
│ └── model.php
├── view/
│ └── index.php
│ └── Login.php
│ └── about.php
│ └── contact.php
│ └── Admin/
│ │ └── adAddProduct.php
│ │ └── adDashboard.php
│ │ └── adProfile.php
│ │ └── userView.php
│ └── Customer/
│ │ └── cusDashboard.php
│ │ └── cusProfile.php
│ │ └── history.php
│ │ └── viewCart.php
│ └── Deliveryman/
│ │ └── deliDashboard.php
│ │ └── deliDeliveryStatus.php
│ │ └── deliDeliveryHistory.php
│ │ └── deliProfile.php
├── JS/
├── CSS/
├── Image/
</pre>
### 🌟 Features
- Role-based dashboards with login and profile management
- Browse and filter products
- Shopping cart with order placement and stock updates
- View past orders with status tracking
- Add new products in inventory (Admin)
- Update stock levels and monitor stock-out products (Admin)
- Manage customer accounts (Admin)
- Accept placed orders (DeliveryMan)
- Update delivery status (DeliveryMan)
- track completed deliveries and view total earnings (DeliveryMan)
### 🔑 Demo Credentials
To login as Admin
- Username: Alamin
- Password: Alamin@123
  
To login as Customer
- Username: Tuli
- Password: Tuli@123  
To login as DeliveryMan
- Username: Mahin
- Password: Mahin@123
## 🤝 Credits
Developed by: [MD.TOKY TAJWER MAHIN]<br>
Contributors: [SUMAIYA AMIRUN]<br>

References & Acknowledgments:
<ul>
<li>MD AL AMIN</li>
<li>W3Schools</li>
</ul>

- This project was developed as part of our fall Semester Web Technologies course and demonstrates a role-based e-commerce system using PHP and MySQL.
- Ensure your local server (XAMPP) is running before using the application.
- Contributions, bug reports and suggestions are welcome.
