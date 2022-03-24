<?php
    class Categories {
        // DB info
        private $conn;
        private $table = 'categories';

        // Properties
        public $id;
        public $category;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Categories
        public function read() {
            // create query
            $query = 'SELECT
                c.id,
                c.category
              FROM
                ' . $this->table . ' c
              ORDER BY
                c.id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute Query
            $stmt->execute();

            return $stmt; 
        }

        // Get Single category
      public function read_single() {
        // create query
        $query = 'SELECT
              c.id,
              c.category
            FROM
              ' . $this->table . ' c
            WHERE
              c.id = ?
            LIMIT 0,1';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);

             // Execute Query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->id = $row['id'];
            $this->category = $row['category'];

      }

      // Create Post
      public function create() {
        // Create query
        $query = 'INSERT INTO ' .
            $this->table . '
          SET
            category = :category';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->category = htmlspecialchars(strip_tags($this->category));

        // Bind data
        $stmt->bindParam(':category', $this->category);

         // Execute query
         if($stmt->execute()) {
          return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);
      
          return false;
      }
    }
?>