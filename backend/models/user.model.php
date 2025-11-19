<?php
    require_once './models/model.php';
    class UserModel extends Model {

        function __construct() {
            parent::__construct();
        }

        public function getByUser($user){
            $query = $this->db->prepare("SELECT * FROM usuario WHERE nombre=?");
            $query->execute([$user]);

            $user = $query->fetch(PDO::FETCH_OBJ);
            return $user;
        }

    }

?>