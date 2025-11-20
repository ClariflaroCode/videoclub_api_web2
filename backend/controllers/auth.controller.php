<?php
    require_once './models/user.model.php';

    require_once './libs/jwt/jwt.php';


    class AuthApiController {

        private $userModel;

        function __construct() {
            $this->userModel = new UserModel();
        }
        public function login($req, $res){
            $auth = $req->authorization;

            $algoritmo = explode(' ', $auth);
            if (count($algoritmo) != 2 || $algoritmo[0] != 'Basic') {
                header("WWW-Authenticate: Basic realm='Get a token'");
                return $res->json("Autenticación no valida 1", 401);
            }
           

            $usuario_contrasenia = base64_decode($algoritmo[1]);
            $partes = explode(':', $usuario_contrasenia);
            if (count($partes) != 2) {
                return $res->json("Autenticación no valida 2", 401);
            }
            $user = $partes[0];
            $contrasenia = $partes[1];

            $usuarioDB = $this->userModel->getByUser($user);

            if(!$usuarioDB || !password_verify($contrasenia, $usuarioDB->password)) {
                return $res->json("Usuario o contraseña incorrecta", 401);
            }

            $payload = [
                'sub' => $usuarioDB->id,
                'usuario' => $usuarioDB->nombre,
                'exp' => time() + 3600 // Expira en 1 hora
            ];

            return $res->json(createJWT($payload));

        }
    }

?>

