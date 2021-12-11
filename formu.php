<?php
    $nombre = $_POST['nombre'];
    $password = $_POST['password'];
    $genero = $_POST['genero'];
    $email = $_POST['email'];
    $materia = $_POST['materia'];
    $telefono = $_POST['telefono'];

    if(!empty($nombre) || !empty($password) || !empty($genero) ||
    !empty($email) || !empty($materia)|| !empty($telefono)){
        $host="localhost";
        $dbusername="root";
        $dbpassword= "";
        $dbname = "registro";
        
        $conn = new mysqli($host,$dbusername,$dbpassword,$dbname);
        if(mysqli_connect_error()){
            die('connect error('.mysqli_conect_errno().')'.mysqli_connect_error());
        }else{
            $SELECT =  "SELECT telefono from Usuario where telefono= ? limit 1";
            $INSERT = "INSERT INTO Usuario (nombre, password, genero,email,materia, telefono)values(?,?,?,?,?,?)";
            $stnt = $conn->prepare($SELECT);
            $stnt ->bind_param("i",$telefono);
            $stnt->execute();
            $stnt->bind_result($telefono);
            $stnt->store_result();
            $rnum = $stnt->num_rows;
            if($rnum==0){
                $stnt->close();
                $stnt = $conn->prepare($INSERT);
                $stnt ->bind_param("sssssi",$nombre,$password,$genero,$email,$materia,$telefono);
                $stnt->execute();
                echo "REGISTRO COMPLETADO.";
            }else{
                echo "Alguien ya ha registrado este número";
            }$stnt->close();
            $conn->close();
        }

    }else{
        echo "Todos los datos son obligatorios";
        die();
    }


?>
