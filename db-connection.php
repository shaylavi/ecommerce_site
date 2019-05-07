<?php

    if ((require_once 'db-config.php') == FALSE) {
        echo '<script>alert("Database error: db-config.php file has not been made")</script>';
    }

    function verifyCustomer($username, $password) {
        return false;
    }

    function openConnection() {
        $connection = new mysqli(dbServer, dbUsername, dbPassword, dbName);
        if ($connection->connect_error) {
            echo "Failed to connect to database";
            die("Connection Failed: ".$connection->connect_error);
        }
        return $connection;
    }
    function registerNewCustomer($firstName, $lastName, $email, $password) {
        $connection = openConnection();
        $query = $connection.prepare("INSERT INTO `Customers` (`FirstName`,`LastName`,`Email`,`Password`) VALUES (?,?,?,?);");
        $query.bind_param("ssss",$firstName, $lastName, $email, $password);
        
        $password = password_hash($password,PASSWORD_DEFAULT);
        
        $query.execute();
        echo "Record added";
        $query->close();

        closeConnection($connection);
    }
    
    function makeQuery($sqlStatement) {
        $connection = openConnection();
        $result = $connection->query($sqlStatement);
        return $result;
        closeConnection($connection);
    }

    function getAllMaterials() {
        $materials = [];
        $sqlStatement = "SELECT m.* FROM Materials m";
        $result = makeQuery($sqlStatement);
        $numberOfResults = $result->num_rows;
        if ($numberOfResults > 0) {
            while ($row = $result->fetch_assoc()) {
                $newMaterial = new Material($row["Title"], $row["DisplayColour"], $row["DisplayTextColour"]);
                $materials += [$row["MaterialID"] => $newMaterial];

            }
        }
        return $materials;
    }

    function getAllProducts() {
        $materials = getAllMaterials();
        $products = [];
        $sqlStatement = "SELECT p.ProductID, p.Title, p.Description, p.Stock, p.Price, p.ImageUrl, p.ImageAlt, c.Title AS Category, m.MaterialID FROM `Products` p, `Materials` m, `Product_Material` pm, `Categorys` c WHERE p.ProductID = pm.ProductID AND pm.MaterialID = m.MaterialID AND p.CategoryID = c.CategoryID ORDER BY p.ProductID";
        $result = makeQuery($sqlStatement);
        $numberOfResults = $result->num_rows;

        if ($numberOfResults > 0) {
            /*
             * There may be some duplicate products due to their materials being differant
             * So we store the previous product and check if it is being repeated, if it is, append 
             * the material to the already made products materials
            */ 
            while ($row = $result->fetch_assoc()) {
            
                if (array_key_exists($row["ProductID"],$products)) {
                   $products[$row["ProductID"]]->addMaterial($materials[$row["MaterialID"]]);
                } 
                else {
                    $newProduct = new Product(
                        $row["Title"],
                        $row["Description"],
                        $materials[$row["MaterialID"]],
                        $row["Stock"],
                        $row["Price"],
                        $row["ImageUrl"],
                        $row["ImageAlt"],
                        $row["Category"]
                    );
                    $products += [$row["ProductID"]=> $newProduct];
                }
            }
        }
        return $products;
    }

    class Material {
        public $title = "MaterialName";
        public $displayColour = "#111111";
        public $textColour = "#FFFFFF";
        public function __construct($title, $displayColour, $textColour) {
            $this->title = $title;
            $this->$displayColour = $displayColour;
            $this->$textColour = $textColour;
            echo $this->title;
        }
    }
    class Product {
        public $title = "title";
        public $description = "description";
        public $material = array();	
        public $stock = "stock";	
        public $price = "price";	
        public $imageUrl = "imageUrl";	
        public $imageAlt = "imageAlt";	
        public $category = "category";
        
        public function __construct($title, $description, $material, $stock, $price, $imageUrl, $imageAlt, $category)
        {
            $this->title =          $title;	
            $this->description =    $description;

            // Array of String	
            array_push($this->material, $material);	
            $this->stock =          $stock;	
            $this->price =          $price;		
            $this->imageUrl =       $imageUrl;	
            $this->imageAlt =       $imageAlt;
            $this->category =       $category;
        }
        public function addMaterial($material) {
            array_push($this->material, $material);
        }
        
    }

?>