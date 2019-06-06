<?php 
class User
{
    public $email;
    public $firstName;
    public $lastName;
    private $password;
    public $valid = false;
    public $userLevel = 0;
    public function __construct($email, $firstName, $lastName, $password, $userLevel = 0)
    {
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
        $this->userLevel = $userLevel;
    }
    public function isValidPassword($password) {
        $valid = password_verify($password, $this->password);
        $this->password = "";
        $this->valid = $valid;
        return $valid;
    }
}

class Material
{
    public $title = "MaterialName";
    public $displayColour;
    public $textColour = "#FFFFFF";
    public function __construct($title, $displayColour, $textColour)
    {
        $this->title = $title;
        $this->$displayColour = $displayColour;
        $this->$textColour = $textColour;
    }
}
class Product
{
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
    public function addMaterial($material)
    {
        array_push($this->material, $material);
    }
}
?>