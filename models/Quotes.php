<?php
  class Quotes {
      // DB info
      private $conn;
      private $table = 'quotes';

      // Properties
      public $id;
      public $authorName;
      public $quote;
      public $authorId;
      public $categoryId;
      public $categoryName;

      // Constructor with DB
      public function __construct($db) {
        $this->conn = $db;
      }

      // Get Quotes
      public function read() {
          // create query
          $query = 'SELECT
                a.author as authorName,
                q.id,
                q.quote,
                q.authorId,
                q.categoryId,
                c.category as categoryName
              FROM
                ' . $this->table . ' q
              LEFT JOIN
                authors a ON q.authorId = a.id
              LEFT JOIN
                categories c ON q.categoryId = c.id
              ORDER BY
                q.id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Execute Query
          $stmt->execute();

          return $stmt;
      }

      // Get Single Quote
      public function read_single() {
          // create query
          $query = 'SELECT
                a.author as authorName,
                q.id,
                q.quote,
                q.authorId,
                q.categoryId,
                c.category as categoryName
              FROM
                ' . $this->table . ' q
              LEFT JOIN
                authors a ON q.authorId = a.id
              LEFT JOIN
                categories c ON q.categoryId = c.id
              WHERE
                q.id = ?
              LIMIT 0,1';

              // Prepare statement
              $stmt = $this->conn->prepare($query);

              // Bind ID
              $stmt->bindParam(1, $this->id);

               // Execute Query
              $stmt->execute();

              $row = $stmt->fetch(PDO::FETCH_ASSOC);

              // Set properties
              $this->authorName = $row['authorName'];
              $this->quote = $row['quote'];
              $this->authorId = $row['authorId'];
              $this->categoryId = $row['categoryId'];
              $this->categoryName = $row['categoryName'];

      }
  }
?>