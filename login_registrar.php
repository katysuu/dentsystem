<?php
 require_once('conexion_bd.php');


//sing up
if (isset($_POST["btnsingin"]))
{
    $name = mysqli_real_escape_string($conexion,$_POST['name']);
    $lastname = mysqli_real_escape_string($conexion,$_POST['lastname']);
    $user = mysqli_real_escape_string($conexion,$_POST['user']);
    $email = mysqli_real_escape_string($conexion,$_POST['email']);
    $password = mysqli_real_escape_string($conexion,$_POST['password']);
    $cpassword = mysqli_real_escape_string($conexion,$_POST['cpassword']);

    if($password ==$cpassword){
        $checkemail = "SELECT email FROM datos WHERE email='$email'";
        $checkemail_run= mysqli_query($conexion,$checkemail);

        if(mysqli_num_rows($checkemail_run)>0){
            echo "<script> alert('$email existente')";
            header("Location:index.html");
            exit(0);
        }
        else{
            $datos_query="INSERT INTO datos (name,lastname,user,email,password) values ('$name','$lastname','$user','$email','$password')";
            $datos_query_run=mysqli_query($conexion,$datos_query);

            if($datos_query_run){
               echo "<script> alert('Usuario registrado con exito: $email');  window.location='index.html' </script>";
            
            
            } else{
                echo "<script> alert('Intente nuevamente'); window.location='index.html'  </script>";
        
            }
        }

    }
}

//login
//
if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $email = validate($_POST['email']);

    $password = validate($_POST['password']);

    if (empty($email)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($password)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM datos WHERE email='$email' AND password='$password'";

        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['email'] === $email && $row['password'] === $password) {

                echo "<script> alert(' $email ingreso con exito');  window.location='dashboard.html' </script>";


                exit();

            }else{

                echo "<script> alert(' Email o contraseña incorrecta');  window.location='index.html' </script>";

                exit();

            }

        }else{

                echo "<script> alert(' Email o contraseña incorrecta');  window.location='index.html' </script>";
            exit();

        }

    }

}else{

    echo "<script> alert(' acepta');  window.location='dashboard.html' </script>";

                exit();

   

}


//if (isset($_POST["btnlogin"]))
//{
   //$email= mysqli_real_escape_string($conexion,$_POST['email']);
  // $password= mysqli_real_($conexion,$_POST['password']);

  // $datos_query = "SELECT * FROM datos WHERE email='$email AND password='$password' LIMIT 1";
  // $datos_query_run = mysqli_query($conexion,$datos_query);



//}

?>