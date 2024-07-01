<?php
    
    class estudiante_model{
        private $DB;
        private $estudiantes;

        function __construct(){
            $this->DB=Database::connect(); //DB es la variable que va a conectar a la base de datos, Database es una clase
        }

        //Este function sirve para hacer consultas
        function get(){
            $sql= 'SELECT * FROM estudiante ORDER BY id DESC'; //Esto realiza la consulta en la tabla estudiante
            $fila=$this->DB->query($sql); //La variable fila hace la consulta
            $this->estudiantes=$fila; //La variable fila se lo pasa a la variable estudiantes
            return  $this->estudiantes; // De esta ultima variable hace un return 
        }

        //Esto pide los datos para agregar en variables
        function create($data){

            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Este bellako te dice si tienes algun error de excepcion
            $sql="INSERT INTO estudiante(id,cedula,nombre,apellidos,promedio,edad,fecha)VALUES (?,?,?,?,?,?,?)"; //Comando para intsertar datos de la nase de datos //Si el id es AI no debe ir aqui 
                                                                                                //Los signos de pregunta son la cantidad de datos que van a llegar 
            $query = $this->DB->prepare($sql);
            $query->execute(array($data['id'],$data['cedula'],$data['nombre'],$data['apellidos'],$data['promedio'],$data['edad'],$data['fecha'])); //Estos datos representan los nombre de la base de datos, 
            //no tienen que ser igual a los de la BD pero si tienen que ser iguales a los controladores
            Database::disconnect();     

        }
        function get_id($id){ //Consulta mediante un id
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM estudiante where id = ?";
            $q = $this->DB->prepare($sql);
            $q->execute(array($id));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            return $data;
        }

        function update($data,$date){ //Sirve para actualizar 
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE estudiante  set  cedula=?, nombre =?, apellidos=?,promedio=?, edad=?, fecha=? WHERE id = ? ";
            $q = $this->DB->prepare($sql);
            $q->execute(array($data['cedula'],$data['nombre'],$data['apellidos'],$data['promedio'],$data['edad'],$data['fecha'], $date));
            Database::disconnect();

        }

        function delete($date){
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="DELETE FROM estudiante where id=?";
            $q=$this->DB->prepare($sql);
            $q->execute(array($date));
            Database::disconnect();
        }
    }
?>