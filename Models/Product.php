<?php 
	class Product{
		//for database
		private $connection; 
		private $table_name = 'products';

		//Product attributes 
		public $id; 
		public $category_id;
		public $category_name;
		public $name;
		public $description;
		public $price;
		public $created_date ; 

		//constructor using the database
		public function __construct($db){
			$this->connection = $db;
		}

		//read product 
		function read(){
			//create the query 
			$query = "SELECT c.name AS category_name, p.id, p.name, p.description, p.price, p.created_date 
					  FROM ". $this->table_name . " as p 
					  LEFT JOIN categories c ON p.category_id = c.id 
				      ORDER BY p.created_date DESC";  
			//prepare and execute the statement 
            
			$stmt = $this->connection->prepare($query);

			$stmt->execute();

			//return the statement
			return $stmt;

		}
		//read a single product 
		function readOne(){
			//create the query for selecting 
			$query = "SELECT c.name AS category_name, p.id, p.name, p.description, p.price, p.created_date 
					  FROM " . $this->table_name ." p 
					  LEFT JOIN 
					  categories c ON p.category_id = c.id 
					  WHERE p.id=? LIMIT 0,1"; 
			//prepare statement, bind id of product and execute the statement
			  $stmt = $this->connection->prepare($query);
			  $stmt->bindParam(1, $this->id);
			  $stmt->execute();

			//fetch row
        	  $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //set values to update
              $this->name=$row['name'];
              $this->price=$row['price'];
        	  $this->description=$row['description'];
        	  $this->created_date=$row['created_date'];
        	  $this->category_name=$row['category_name'];


		}

		//Function for updating a product
    	function update(){

       		//Create the query for updating
        	$query = "UPDATE
                    " . $this->table_name. "
                    SET
                name = :name,
                price = :price,
                description = :description,
                category_id = :category_id
            WHERE
                id = :id";
        	//prepare the statement
        	$stmt = $this->connection->prepare($query);

        	//sanitize
        	$this->name=htmlspecialchars(strip_tags($this->name));
        	$this->price=htmlspecialchars(strip_tags($this->price));
       		$this->description=htmlspecialchars(strip_tags($this->description));
        	$this->category_id=htmlspecialchars(strip_tags($this->category_id));
        	$this->id=htmlspecialchars(strip_tags($this->id));

        	//bind new values
        	$stmt->bindParam(':name', $this->name);
       	 	$stmt->bindParam(':price', $this->price);
        	$stmt->bindParam(':description', $this->description);
        	$stmt->bindParam(':category_id', $this->category_id);
        	$stmt->bindParam(':id', $this->id);
            
           
        	//execute
        	if($stmt->execute()){

            return true;
        	}

        	return false;
    	}

    	//Function for deleting a product
    	function delete(){

        	//delete query
       		 $query = " DELETE FROM " . $this->table_name . " WHERE id = ?";

        	//prepare
        	$stmt = $this->connection->prepare($query);

        	//sanitize
        	$this->id=htmlspecialchars(strip_tags($this->id));

        	//bind id
        	$stmt->bindParam(1, $this->id);

        	//execute
        	if($stmt->execute()){
            	return true;
        	}

        	return false;
    	}

    	//Function for searching products
    	function search($keywords){

        	//create the query 
        	$query = "SELECT
                    c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created_date
                  FROM " . $this->table_name. " p
                  LEFT JOIN
                    categories c ON p.category_id = c.id
                  WHERE
                    p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?
                  ORDER BY
                    p.created_date DESC";

        	//prepare the statement
        	$stmt =$this->connection->prepare($query);

        	//sanitize
        	$keywords = htmlspecialchars(strip_tags($keywords));
        	$keywords = "%{$keywords}%";

        	//bind
        	$stmt->bindParam(1, $keywords);
        	$stmt->bindParam(2, $keywords);
        	$stmt->bindParam(3, $keywords);

        	//execute
       		$stmt->execute();

        	return $stmt;
    }

    	

// create product
function create(){
  
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, price=:price, description=:description, category_id=:category_id, created_date=:created_date";
  
    // prepare query
    $stmt = $this->connection->prepare($query);
  
    // sanitize
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->price=htmlspecialchars(strip_tags($this->price));
    $this->description=htmlspecialchars(strip_tags($this->description));
    $this->category_id=htmlspecialchars(strip_tags($this->category_id));
    $this->created_date=htmlspecialchars(strip_tags($this->created_date));
  
    // bind values
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":price", $this->price);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":category_id", $this->category_id);
    $stmt->bindParam(":created_date", $this->created_date);
  
    // execute query
    if($stmt->execute()){
        return true;
    }
  
    return false;
      
}
    	


	}