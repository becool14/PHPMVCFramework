<?php


    class m0001_initial{
        public function up(){ //Applying migration

            $db = app\core\Application::$app->db;
            $SQL ="CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                status TINYINT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                ) ENGINE = INNODB;";
            $db->pdo->exec($SQL);
        }

        public function down(){ //Down migration
            $db = app\core\Application::$app->db;
            $SQL ="DROP TABLE users ";
            $db->pdo->exec($SQL);
        }
    }



?>