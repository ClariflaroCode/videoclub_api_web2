<?php
    class PeliculaModel {
        function __construct() {
            parent::construct();
        }
        public function getMovie($id) {
            $query = $this->db->prepare(
                'SELECT * FROM pelicula WHERE id=?'
            )
            $query->execute([$id]);
            $movie = $query->fetch(PDO::FETCH_OBJ);
            return $movie;
        }

        public function insertMovie($titulo, $duracion, $imagen, $precio, $descripcion, $fecha_lanzamiento, $atp, $director_id, $genero, $distribuidora) {   
            $query = $this->db->prepare(
                'INSERT INTO pelicula(titulo, duracion, imagen, precio, descripcion, fecha_lanzamiento, atp, director_id, genero, distribuidora) 
                VALUES (?,?,?,?,?,?,?,?,?,?)';
            )
            $query->execute([$titulo, $duracion, $imagen, $precio, $descripcion, $fecha_lanzamiento, $atp, $director_id, $genero, $distribuidora]);
            
            return lastInsertID();
        }
        public function fetchColumnsMovies() {
            $query = $this->db->prepare('SHOW COLUMNS FROM peliculas'); //https://youtu.be/iGlKzWjs_i8?si=EZalmWrG5UBq-E2G (es una funcion exclusiva de mysql pero no devuelve solo el nombre, devuelve informacion de las columnas tamb)
            $query->execute();
            

            $columns = $query->fetchAll(PDO::FETCH_OBJ); //me devuelve un array de objetos, cada objeto es una columna de la tabla peliculas, el primer atributo es field que es el nombre de la columna el resto son el tipo que admite, si puede ser null o no, etc
            $fields = array_map(fn($col) => $col->Field, $columns); //esta funcion crea un diccionario con el nombre de la columna como clave, la funcion recibe un callback y un arreglo, por eso la arrow function, que bonita sería function ($columna) { $columna->field}
            
            return $fields;
        }

        public function filtrarMovies($atributo, $valor) {
            
            $query = $this->db->prepare(
                "SELECT * FROM pelicula WHERE $atributo = ?"
            );
            $query->execute([$atributo, $valor]);
            $movies = $query->fetchAll(PDO::FETCH_OBJ);
            return $movies;
        }
        public function paginado($page, $size) {
            $query = $this->db->prepare(
                'SELECT * FROM pelicula LIMIT =? OFFSET =?'
            );
            //limit y offset es dinamico
            $query->execute([$page, $size]);
            $movies = $query->fetchAll(PDO::FETCH_OBJ);
            return $movies;
        }

        
    }


?>