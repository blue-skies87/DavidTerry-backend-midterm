<?php
    class Authors {
        // DB info
        private $conn;
        private $table = 'authors';

        // Properties
        public $id;
        public $author;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Quotes
        public function read() {
            // create query
            $query = 'SELECT
                a.id,
                a.author
              FROM
                ' . $this->table . ' a
              ORDER BY
                a.id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute Query
            $stmt->execute();

            return $stmt; 
        }

        // Get Single author
      public function read_single() {
        // create query
        $query = 'SELECT
              a.id,
              a.author
            FROM
              ' . $this->table . ' a
            WHERE
              a.id = ?
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
            $this->author = $row['author'];
      }

      // Create Post
      public function create() {
          // Create query
          $query = 'INSERT INTO ' .
              $this->table . '
            SET
              author = :author';
          // Prepare statement
          $stmt = $this->conn->prepare($query);
          
          // Clean data
          $this->author = htmlspecialchars(strip_tags($this->author));

          // Bind data
          $stmt->bindParam(':author', $this->author);

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