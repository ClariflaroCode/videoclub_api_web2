<?php
    require_once '../models/pelicula.model.php';
    


    class PeliculaController {
        private $model;
        private $queryParamsOrden;
        private $queryParamsPaginado;

        public function __construct() {
            $this->model = new PeliculaModel();
            $this->queryParamsGenericos = ["sort", "order", "page", "limit"];
        }
        public function  addMovie($req, $res) {            
            if($this->validateMovies($columns, $_POST)) {
                $movies = $this->model->addMovie($titulo, $duracion, $imagen, $precio, $descripcion, $fecha_lanzamiento, $atp, $director_id, $genero, $distribuidora);
                if (is_bool($movies)) {
                    return $res->json("No se pudo insertar la nueva película", 500);
                } 
                return $res->json("La pelicula fue agregada con éxito", 201);
            }
            

        }
        public function editMovie($req, $res) {

        }
        public function deleteMovie($req, $res){

        }
        public function getMovie($req, $res){
            $id = $req->params->id; 
            if (!is_int($id) || $id <= 0) {
                return $res->json("", 400);
            } 
            $movie = $this->model->getMovie($id);
            if (is_bool($movie)) { //devuelve un bool si la consulta fallo
                return $res->json("", 404); 
            } else {
                return $res->json($movie, 200);

            }

        }
        public function getMovies($req, $res){
            
            $queryParams = (array) $req->query; //lo vuelve un arreglo asociativo/diccionario al objeto, asi que sus atributos pasan a ser keys. 

            if (count($queryParams) > 0) {
                $queryKeys = array_keys($queryParams);
                if (count (array_intersect($queryKeys, $this->queryParamsGenericos)) == 0) { //los query params que hay son de filtrado. No se me ocurre como acumularlos. 
                    //FILTRADO
                    $columns = $this->model->fetchColumnsMovies();
                    $params_verificados = array_intersect($queryKeys, $columns);
                    if (count($params_verificados) != count($queryKeys))  {
                        return $res->json("Bad request, revisar los nombres de los parámetros enviados para filtrar", 400);
                    } 
                    //Coinciden los nombres de todos los query keys con las columnas. Verificar que estén seteados.
                    $condition = null;
                    foreach($queryParams as $queryKey => $queryValue) {
                        if (is_null($queryValue) || $queryValue == "") {
                            return $res->json("Falta setear el valor del filtro" . $queryKey, 400);
                        } else {
                            if (is_null($condition)){
                                $condition = $queryKey . "=" . $queryValue;
                            } else {
                                $condition = $condition . " AND " . $queryKey . "=" . $queryValue;
                            }
                        }
                    }
                    
                    $movies = $this->model->filtrar($condition); 
                    return $res->json($movies, 200); 
          
                }
            } 
                    
            $movies = $this->model->getMovies($req->query);
            return $res->json($movies, 200);
            
            


        }
        private function verificarFecha($fecha) {
            $arregloFecha = explode("-", $fecha);
            if (count($arregloFecha) != 3) {
                return $res->json("Error en el formato de la fecha", 400);
            }
            $anio = (int) $arregloFecha[0]; 
            $mes = (int) $arregloFecha[1];
            $dia = (int) $arregloFecha[2];

            if (!checkdate($mes, $dia, $anio)) {
                return $res->json("La fecha es invalida", 400 );
            } 
            return true;
        }

        private function validateEditOrAddMovies($req){
            
            if (empty($req->body->titulo) || !isset($req->body->titulo)) {
                return $res->json("Falta enviar el titulo", 400);
            }
            if (empty($req->body->duracion)|| !isset($req->body->duracion) || ((int)$req->body->duracion <= 0)){
                return $res->json("Falta enviar la duracion", 400);
            }
            if (empty($req->body->imagen)|| !isset($req->body->imagen)) {
                return $res->json("Falta la url de la imagen", 400);
            }
             if (empty($req->body->precio)|| !isset($req->body->precio)) {
                return $res->json("Falta el precio de la película", 400);
            }
             if (empty($req->body->descripcion)|| !isset($req->body->descripcion)) {
                return $res->json("Falta la descripcion de la pelicula", 400);
            }
             if (empty($req->body->fecha_lanzamiento)|| !isset($req->body->fecha_lanzamiento) || !$this->verificarFecha($req->body->fecha_lanzamiento)) {
                return $res->json("Falta la fecha de lanzamiento", 400);
            }
             if (empty($req->body->atp)|| !isset($req->body->atp)) { //AGREGAR CONTROLES. 
                return $res->json("Falta determinar si es apta o no para todo público", 400);
            }
             if (empty($req->body->director_id)|| !isset($req->body->director_id)|| ((int)$req->body->duracion <= 0)) {
                return $res->json("Falta el director", 400);
            }
             if (empty($req->body->genero)|| !isset($req->body->genero)) {
                return $res->json("Falta el genero de la pelicula", 400);
            }
            if (empty($req->body->distribuidor)|| !isset($req->body->distribuidor)) {
                return $res->json("Falta la distribuidora de la pelicula", 400);
            }
            return true;
        }

    }


?>