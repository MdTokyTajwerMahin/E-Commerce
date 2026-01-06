<?php

class Model {
    private $conn;

    public function OpenCon() { 
        $db_server = "localhost";
        $db_user = "root";
        $db_pass = "";
        $db_name = "e_commerce_management_system";
        $db = "";

        try {
            $db = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
        } catch(mysqli_sql_exception $e) {
            echo "<script>alert('MySQL not started in XAMPP');</script>";
        }

        return $db;
    }

    public function __construct() {
        $this->conn = $this->OpenCon();
    }

    
    public function userExist($firstname) {
        $stmt = $this->conn->prepare("SELECT * FROM user_info WHERE user_name=?");
        $stmt->bind_param("s", $firstname);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function userCreate($firstname, $password, $userType, $address, $email, $mobile) {
        $stmt = $this->conn->prepare("INSERT INTO user_info (user_name,password,type,address,email,nid) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $firstname, $password, $userType, $address, $email, $mobile);
        return $stmt->execute();
    }

  
    public function getUserById($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM user_info WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    
    public function updateUser($userId, $name, $password, $address, $email, $mobile) {
        $stmt = $this->conn->prepare("UPDATE user_info SET user_name = ?, password = ?, address = ?, email = ?, nid = ? WHERE user_id = ?");
        $stmt->bind_param("sssssi", $name, $password, $address, $email, $mobile, $userId);
        return $stmt->execute();
    }

    
    public function deleteUser($userId) {
        $stmt = $this->conn->prepare("UPDATE order_info SET d_id=NULL WHERE c_id=?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $stmt = $this->conn->prepare("DELETE FROM customer_order WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $stmt = $this->conn->prepare("DELETE FROM order_info WHERE c_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $stmt = $this->conn->prepare("DELETE FROM user_info WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        return $stmt->execute();
    }

   
    public function getAllProducts() {
        $result = $this->conn->query("SELECT * FROM product");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getProductsByCategory($category) {
        $stmt = $this->conn->prepare("SELECT * FROM product WHERE category = ?");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getCategories() {
        $result = $this->conn->query("SELECT DISTINCT category FROM product");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isProductInCart($userId, $p_id) {
        $stmt = $this->conn->prepare("SELECT * FROM customer_order WHERE user_id=? AND p_id=?");
        $stmt->bind_param("ii", $userId, $p_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC);
        return count($result) > 0;
    }

    
    public function addToCart($userId, $p_id) {
        $stmt = $this->conn->prepare("INSERT INTO customer_order (p_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $p_id, $userId);
        return $stmt->execute();
    }

    
    public function getCartItems($userId) {
        $stmt = $this->conn->prepare("SELECT co.p_id, p.p_name, p.price, p.image_url, p.stock FROM customer_order co INNER JOIN product p ON co.p_id = p.p_id WHERE co.user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function updateProductStock($p_id, $stock) {
        $stmt = $this->conn->prepare("UPDATE product SET stock=? WHERE p_id=?");
        $stmt->bind_param("ii", $stock, $p_id);
        return $stmt->execute();
    }

   
    public function removeFromCart($userId, $p_id) {
        $stmt = $this->conn->prepare("DELETE FROM customer_order WHERE user_id=? AND p_id=?");
        $stmt->bind_param("ii", $userId, $p_id);
        return $stmt->execute();
    }

    
    public function placeOrder($userId, $total, $delivery) {
        $status = "ordered";
        $cartItems = $this->getCartItems($userId);

      
        foreach ($cartItems as $item) {
            $newStock = $item['stock'] - 1;
            $this->updateProductStock($item['p_id'], $newStock);
        }

        
        $stmt = $this->conn->prepare("INSERT INTO order_info (c_id, status, product_cost, delivery_fee) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isdd", $userId, $status, $total, $delivery);
        $stmt->execute();

        
        $stmt = $this->conn->prepare("DELETE FROM customer_order WHERE user_id=?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
    }

   
    public function getUserOrders($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM order_info WHERE c_id = ? ORDER BY order_datetime DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getUserAddress($userId) {
        $stmt = $this->conn->prepare("SELECT address FROM user_info WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['address'];
    }

   
    public function getAllUsers() {
        $result = $this->conn->query("SELECT * FROM user_info WHERE type IN ('Customer','DeliveryMan')");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function addProduct($p_name, $price, $image_url, $stock, $category) {
        $stmt = $this->conn->prepare("INSERT INTO product (p_name, price, image_url, stock, category) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sdsis", $p_name, $price, $image_url, $stock, $category);
        return $stmt->execute();
    }


    public function productExists($p_name) {
        $stmt = $this->conn->prepare("SELECT * FROM product WHERE p_name=?");
        $stmt->bind_param("s", $p_name);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    
    public function getDeliverymanOrders($d_id) {
        $status="delivered";
        $stmt = $this->conn->prepare("SELECT oi.order_id, oi.c_id, oi.status, oi.product_cost, oi.delivery_fee, oi.order_datetime, u.user_name, u.address, u.nid FROM order_info oi INNER JOIN user_info u ON oi.c_id = u.user_id WHERE oi.d_id = ? AND status=? ORDER BY oi.order_datetime DESC");
        $stmt->bind_param("is", $d_id,$status);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getDeliverymanAcceptedOrders($d_id) {
        $status="accepted";
        $stmt = $this->conn->prepare("SELECT oi.order_id, oi.c_id, oi.status, oi.product_cost, oi.delivery_fee, oi.order_datetime, u.user_name, u.address, u.nid FROM order_info oi INNER JOIN user_info u ON oi.c_id = u.user_id WHERE oi.d_id = ? AND status=? ORDER BY oi.order_datetime DESC");
        $stmt->bind_param("is", $d_id,$status);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getPendingOrders() {
        $result = $this->conn->query("SELECT * FROM order_info WHERE d_id IS NULL AND status='ordered'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    public function getPendingOrderDetails() {
        $sql = "SELECT order_info.order_id, order_info.product_cost, order_info.delivery_fee, user_info.user_name, user_info.address, user_info.nid FROM user_info INNER JOIN order_info ON user_info.user_id = order_info.c_id WHERE order_info.d_id IS NULL AND status='ordered'";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function acceptOrder($order_id, $deliveryman_id) {
        $status = "accepted";
        $stmt = $this->conn->prepare("UPDATE order_info SET d_id=?, status=? WHERE order_id=?");
        $stmt->bind_param("isi", $deliveryman_id, $status, $order_id);
        return $stmt->execute();
    }

    public function deleteDeliverymanProfile($user_id) {
        $status = "delivered";
        $statusText = "accepted";
        $stmt = $this->conn->prepare("UPDATE order_info SET d_id=NULL WHERE d_id=? AND status=?");
        $stmt->bind_param("is", $user_id,$status);
        $stmt->execute();

        $stmt = $this->conn->prepare("UPDATE order_info SET d_id=NULL, status='ordered' WHERE d_id=? AND status=?");
        $stmt->bind_param("is", $user_id,$statusText);
        $stmt->execute();

        $stmt = $this->conn->prepare("DELETE FROM user_info WHERE user_id=?");
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }

    
    public function updateOrderStatus($order_id, $status) {
        $stmt = $this->conn->prepare("UPDATE order_info SET status=? WHERE order_id=?");
        $stmt->bind_param("si", $status, $order_id);
        return $stmt->execute();
    }

   
    public function cancelOrder($order_id,$status) {
        $stmt = $this->conn->prepare("UPDATE order_info SET status=?, d_id=NULL WHERE order_id=?");
        $stmt->bind_param("si", $status, $order_id);
        return $stmt->execute();
    }

}

?>