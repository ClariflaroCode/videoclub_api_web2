<?php

    require_once './config.php';
    
    class Model {
        protected $db;

        public function __construct() {
            
            $this->db = new PDO(
            "mysql:host=".MYSQL_HOST .
            ";dbname=".MYSQL_DB.";charset=utf8", 
            MYSQL_USER, MYSQL_PASS);
            $this->_deploy();
        }

        private function _deploy() {
            $hash = '$2y$10$dHAHTDMTyoeNTDvTOXTlO.0JxV/pebIg0DcCZ2te33QMhygGJCdwa';
            $query = $this->db->query('SHOW TABLES');
            $tables = $query->fetchAll(PDO::FETCH_COLUMN);

            if(count($tables) == 0) {
                    $sql = <<<SQL
                CREATE TABLE director (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(40) NOT NULL,
                    sexo CHAR(1) NOT NULL,
                    fecha_nacimiento DATE NOT NULL,
                    reputacion INT DEFAULT NULL,
                    pais_origen VARCHAR(30) NOT NULL, 
                    imagen TEXT NOT NULL
                );

                CREATE TABLE pelicula (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    titulo VARCHAR(40) NOT NULL,
                    duracion INT NOT NULL,
                    imagen TEXT NOT NULL,
                    precio FLOAT(6,2) NOT NULL,
                    descripcion TEXT NOT NULL,
                    fecha_lanzamiento DATE NOT NULL,
                    atp TINYINT(1) NOT NULL,
                    director_id INT NOT NULL,
                    genero VARCHAR(30) NOT NULL,
                    distribuidora VARCHAR(40) NOT NULL,
                    FOREIGN KEY (director_id) REFERENCES director(id)
                );

                CREATE TABLE usuario (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nombre VARCHAR(40) NOT NULL,
                    email VARCHAR(40) NOT NULL,
                    password TEXT NOT NULL
                );
                
                CREATE TABLE resenia (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    autor VARCHAR(40) NOT NULL,
                    comentario TEXT NOT NULL,
                    calificacion INT NOT NULL,
                    id_pelicula INT NOT NULL,
                    FOREIGN KEY (id_pelicula) REFERENCES pelicula(id)
                );

                INSERT INTO director (nombre, sexo, fecha_nacimiento, reputacion, pais_origen, imagen) VALUES
                ('shawn levy', 'm', '1968-07-23', 3, 'canada', 'https://upload.wikimedia.org/wikipedia/commons/4/47/Shawn_Levy_in_Moscow%2C_October_2011.jpg'),
                ('andrew adamson', 'm', '1966-12-01', 4, 'nueva zelanda', 'https://m.media-amazon.com/images/M/MV5BNTU1Nzc4NTkyOV5BMl5BanBnXkFtZTcwODc3NjA4OA@@._V1_.jpg'),
                ('james cameron', 'm', '1954-08-16', 5, 'canada', 'https://cdn.britannica.com/84/160284-050-695B1DE3/James-Cameron-2012.jpg'),
                ('steven spielberg', 'm', '1946-12-18', 5, 'estados unidos', 'https://upload.wikimedia.org/wikipedia/commons/6/67/Steven_Spielberg_by_Gage_Skidmore.jpg');

                INSERT INTO pelicula (titulo, duracion, imagen, precio, descripcion, fecha_lanzamiento, atp, director_id, genero, distribuidora) VALUES
                ('tiburon', 120, 'https://www.lascosasquenoshacenfelices.com/wp-content/uploads/2025/06/Tiburon-las-cosas-felices.01-e1749284997448.jpg', 120.00, 'Un gigantesco tiburón blanco amenaza a los habitantes y turistas de un pueblo costero. El alcalde encomienda la caza del escualo al jefe de la policía, un pescador y un científico. El grupo se da cuenta de que es un animal inteligente y violento.', '1975-06-20', 0, 4, 'terror', 'universal pictures'),
                ('jurassic park', 120, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjMRJwsLgcUJX7OuNQ7vlto88pnsTmXUnARU3q8TXu53FtESU47rXbIc_772jRZMJT9409K1NvZyQF9WiO9LAOmcGGChFrsswYKILgiOxTGw', 200.00, 'Tres expertos y otras personas son invitados a un parque de diversiones, donde se encuentran dinosaurios creados en base al ADN.', '1993-06-11', 1, 4, 'terror', 'universal pictures'),
                ('e.t. el extraterrestre', 120, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4NDtlwmypxwm_JJXozA5f9Eel75rsr2XWu5MWx8SM_8N01hZFdDkvyEfUVfItWSjTQ2hFjQRMYvS5717FeaCX_tpF1i9BN_TO5npPN4JK9w', 180.00, 'Elliott es un niño de nueve años que se encuentra con un extraterrestre y decide esconderlo en su casa para protegerlo. Contará con la ayuda de su pequeña hermana y su hermano mayor para mantener el secreto y juntos vivirán una aventura inolvidable.', '1982-06-11', 1, 4, 'ciencia ficcion', 'universal pictures'),
                ('terminator', 108, 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSsVMuYOj7eYifN6uZjCEkFfqBSOQRqcdvbDjSoBzAMWRQiB6EwYZoDwCJEERPmgNVHuIvBCAv6K0eUQO9tLYt53e8hroLLN3SF5Z3q7tR2', 600.00, 'Un asesino cibernético del futuro es enviado a Los Ángeles para matar a la mujer que procreará a un líder.
                ', '1984-10-26', 1, 3, 'ciencia ficcion', 'orion pictures');

                INSERT INTO usuario (nombre, email, password) VALUES
                ('webadmin', 'webadmin@gmail.com', "$hash");
                 
                INSERT INTO resenia (autor, comentario, calificacion, id_pelicula) VALUES
                ('Juli', 'Me encantan los dinosaurios y aguante el clamidosaurio', 5 , 2);

                INSERT INTO resenia(autor, comentario, calificacion, id_pelicula) VALUES
                ('PEPE TOÑO MACÍAS', 'aguante terminatorrrrrrrrrrr', 5, 4);
                
                SQL;

                $this->db->exec($sql);
            }
        }
    }
?>