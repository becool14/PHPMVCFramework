<?php

    namespace app\core;

   abstract class DbModel extends Model{
        
        abstract public function tableName(): string;

        abstract public function attributes(): array;
        //Підготовлені вирази як метод захисту проти SQL ін'єкцій
        public function save() {
            // Отримання імені таблиці
            $tableName = $this->tableName();
        
            // Отримання списку атрибутів
            $attributes = $this->attributes();
        
            // Створення масиву параметрів для підготовленого виразу
            $params = array_map(fn($attr) => ":$attr", $attributes);
        
            // Підготовка SQL-запиту з підстановкою параметрів
            $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") 
                                        VALUES (".implode(',', $params).")");
        
            // Прив'язка значень до підготовленого запиту
            foreach($attributes as $attribute) {
                $statement->bindValue(":$attribute", $this->{$attribute});
            }
        
            // Виконання запиту
            $statement->execute();
        
            return true;
        }
        
        public static function prepare($sql){
            return Application::$app->db->pdo->prepare($sql);
        }
    }



?>