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
        public function getMovies($queryParams) {



            /**PREGUNTAR SI ESTO IRÍA ACÁ, SI SE PUEDE PONER COMO PARÁMETROS FALTANTES, SI PUEDE HABER PARÁMETROS FALTANTES 
             * ENTRE MEDIO DE UNOS QUE NO O SI ESTOS VAN EN EL CONTROLADOR*/
            
            
            
            $limit = $queryParams->limit ?? 10; // si existe el query param limit se asigna ese a limit, si no, se asigna 10. 
            $page = $queryParams->page ?? 0;
            $sort = $queryParams->sort ?? "id";
            $order = $queryParams->order ?? "ASC";

            $query = $this->db->prepare(
                'SELECT * FROM pelicula ORDER BY =? =? LIMIT =? =?'
            ); //NOTA: en mysql no existe el offset, es el primer parámetro del limit. 
            $query->execute([$sort, $order, $offset, $limit ]);

            $movies = $query->fetchAll(PDO::FETCH_OBJ);
            return $movies;


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
            $fields = []; //tendra los nombres de las columnas
            foreach ($columns as $col) {
                array_push($fields, $col->Field); //creo un arreglo que tenga solo los nombres de las columnas
            }

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
        public function paginar($limit= 10, $page = 0) {
            $query = $this->db->prepare(
                'SELECT * FROM pelicula LIMIT =? OFFSET =?'
            );
            //limit y offset es dinamico
            $query->execute([$limit, $page]);
            $movies = $query->fetchAll(PDO::FETCH_OBJ);
            return $movies;
        }

        
    }


?>