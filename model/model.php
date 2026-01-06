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

    

}

?>