<?php
    class PeliculaModel extends model {
        function __construct() {
            parent::__construct();
        }

        public function getMovie($id) {
            $query = $this->db->prepare(
                'SELECT * FROM pelicula WHERE id=?'
            );
            $query->execute([$id]);
            $movie = $query->fetch(PDO::FETCH_OBJ);
            return $movie;
        }
        public function getMovies($queryParams) {



            /**PREGUNTAR SI ESTO IRÍA ACÁ, SI SE PUEDE PONER COMO PARÁMETROS FALTANTES, SI PUEDE HABER PARÁMETROS FALTANTES 
             * ENTRE MEDIO DE UNOS QUE NO O SI ESTOS VAN EN EL CONTROLADOR*/
            
            
            
            $limit = $queryParams['limit'] ?? 10; // si existe el query param limit se asigna ese a limit, si no, se asigna 10. 
            $page = $queryParams['page'] ?? 0;
            $sort = $queryParams['sort'] ?? "id";
            $order = $queryParams['order'] ?? "ASC";

            //verifico que el sort sea una columna válida
             $validColumns = ["id", "titulo", "precio", "fecha_lanzamiento", "duracion", "genero", "distribuidora", "director_id"];
                if (!in_array($sort, $validColumns)) {
                    $sort = "id";
                }

                //valido el order
                if ($order != "ASC" && $order != "DESC") {
                    $order = "ASC";
                }

            $offset = $page * $limit;

            $query = $this->db->prepare(
                "SELECT * FROM pelicula ORDER BY $sort $order LIMIT ?, ?"
            ); //NOTA: en mysql no existe el offset, es el primer parámetro del limit. 
            $query->execute([$offset, $limit]);

            $movies = $query->fetchAll(PDO::FETCH_OBJ);
            return $movies;

        }

        public function addMovie($titulo, $duracion, $imagen, $precio, $descripcion, $fecha_lanzamiento, $atp, $director_id, $genero, $distribuidora) {   
            $query = $this->db->prepare(
                'INSERT INTO pelicula(titulo, duracion, imagen, precio, descripcion, fecha_lanzamiento, atp, director_id, genero, distribuidora) 
                VALUES (?,?,?,?,?,?,?,?,?,?)';
            );
            $query->execute([$titulo, $duracion, $imagen, $precio, $descripcion, $fecha_lanzamiento, $atp, $director_id, $genero, $distribuidora]);
            
            return $this->db->lastInsertId();
        }
        public function fetchColumnsMovies() {
            $query = $this->db->prepare('SHOW COLUMNS FROM pelicula'); //https://youtu.be/iGlKzWjs_i8?si=EZalmWrG5UBq-E2G (es una funcion exclusiva de mysql pero no devuelve solo el nombre, devuelve informacion de las columnas tamb)
            $query->execute();
            

            $columns = $query->fetchAll(PDO::FETCH_OBJ); //me devuelve un array de objetos, cada objeto es una columna de la tabla peliculas, el primer atributo es field que es el nombre de la columna el resto son el tipo que admite, si puede ser null o no, etc
            $fields = []; //tendra los nombres de las columnas
            foreach ($columns as $col) {
                array_push($fields, $col->Field); //creo un arreglo que tenga solo los nombres de las columnas
            }

            return $fields;
        }

        public function editMovie($id, $titulo, $duracion, $imagen, $precio, $descripcion, $fecha_lanzamiento, $atp, $director_id, $genero, $distribuidora) {
            $query = $this->db->prepare('
                UPDATE pelicula 
                SET titulo = ?, duracion = ?, imagen = ?, precio = ?, descripcion = ?, fecha_lanzamiento = ?, atp = ?, director_id = ?, genero = ?, distribuidora = ?
                WHERE id = ?
            ');
            $query->execute([$titulo, $duracion, $imagen, $precio, $descripcion, $fecha_lanzamiento, $atp, $director_id, $genero, $distribuidora, $id]);
            
            if ($query->rowCount() > 0) {
                return $id; // se modificó correctamente devuelvo el mismo ID
            } else {
                return false; // no se modificó nada
            }
        }

        public function deleteMovie($id) {
            $query = $this->db->prepare('DELETE FROM pelicula WHERE id = ?');
            $query->execute([$id]);

             if ($query->rowCount() > 0) {
                return $id; // devuelve el id de la película eliminada
            } else {
                return false; // no se encontró ninguna película con ese id
            }
        }


        public function filtrarMovies($consulta) {
            $query = $this->db->prepare(
                "SELECT * FROM pelicula WHERE = ?"
            );
            $query->execute([$consulta]);
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