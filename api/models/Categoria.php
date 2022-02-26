<?php
    class Categoria{
        // MVC - Model<->View(VFP)<->Controller
        // Conexión a la base de datos
        private $conn;

        // Nombre de la tabla
        private $table_name = "categorias";

        // Lista de propiedades
        public $id;
        public $codigo;
        public $descripcion;
        public $created_at;
        public $modified_at;
        public $deleted_at;
        private $lastErrorTxt;

        /*
        // constructor con el objeto de la conexión.
        procedure init
            *-- Constructor goes here.
        endproc
        */
        public function __construct($db){
            $this->conn = $db;
        }

        /*
            VFP's Getters N' Setters

            PROTECTED lastErrorTxt
            
            ** Getter
            FUNCTION lastErrorTxt_Access
                RETURN THIS.lastErrorTxt
            ENDFUNC

            ** Setter
            PROTECTED FUNCTION lastErrorTxt_Assign
                LPARAMETERS vNewVal
                THIS.lastErrorTxt = m.vNewVal
            ENDFUNC
        */

        // getter de lastErrorTxt
        public function getLastErrorTxt(){
            return $this->lastErrorTxt;
        }
        // setter de lastErrorTxt
        protected function setLastErrorTxt($txt){
            $this->lastErrorTxt = $txt;
        }

        // read
        // readOne
        // create
        // update
        // delete
        // devuelve el objeto $stmt con la consulta.
        function read(){
            // escribir la consulta
            $query = "SELECT 
                    id,
                    codigo,
                    descripcion,
                    created_at,
                    modified_at
                FROM 
                    " . $this->table_name . "
                WHERE ISNULL(deleted_at)";
            try{
                // Preparar la consulta
                $stmt = $this->conn->prepare($query);
                // ejecutar la consulta y devolver la variable $stmt
                $stmt->execute();

                return $stmt;                
            }catch(PDOException $e){
                $this->setLastErrorTxt($e->getMessage());
            }
        }
        // Devuelve el registro cargado en las propiedades.
        function readOne(){
            /*
                private id as integer
                m.id = 14
            */
            /*
            $sql = "
                SELECT
                    id,
                    codigo,
                    descripcion,
                    created_at,
                    modified_at
                FROM " . $this->table_name . "
                WHERE 
                    id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $this->id);
            */
            $sql = "
                SELECT
                    id,
                    codigo,
                    descripcion,
                    created_at,
                    modified_at
                FROM " . $this->table_name . "
                WHERE 
                    ISNULL(deleted_at) AND
                    id = :id LIMIT 1";
            
            // Messagebox(cSql)
            // CLEAR EVENTS
            // QUIT            
            //die("consulta SQL: " . $sql);
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $this->id);
                $stmt->execute();    
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Llenar las propiedades con los valores de las columnas.
                // LOCAL aPaises(3)
                // aPaises[1] = 'Argentina'
                // aPaises[2] = 'Bolivia'
                // aPaises[3] = 'Colombia'
                // ?aPaises[2]
                //////////////////////////////////
                $this->codigo       = $row['codigo'];
                $this->descripcion  = $row['descripcion'];
                $this->created_at   = $row['created_at'];
                $this->modified_at  = $row['modified_at'];
            }catch(PDOException $e){
                $this->setLastErrorTxt($e->getMessage());                
            }
        }


        // método create
        function create(){
            $sql = "
            INSERT INTO " . $this->table_name . "
            (
                codigo,
                descripcion
            ) VALUES
            (
                :codigo,
                :descripcion
            )";
                        
            try{
                // Preparar la consulta
                $stmt = $this->conn->prepare($sql);
                // Enlace de Parámetros            
                // Sanear los campos
                $this->codigo = htmlspecialchars(strip_tags($this->codigo));
                $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
                // Fin Sanear los campos

                $stmt->bindParam(':codigo', $this->codigo);
                $stmt->bindParam(':descripcion', $this->descripcion);
                
                if ($stmt->execute()){
                    // Obtener el id
                    $this->id = $this->conn->lastInsertId();
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                $this->setLastErrorTxt($e->getMessage());
            }
        }

        // update
        function update(){
            $sql = "
            UPDATE
                " . $this->table_name . "
            SET
                descripcion = :descripcion
            WHERE
                id = :id
            LIMIT 1";            
            try{
                // Sanear los campos
                $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));            
                $stmt = $this->conn->prepare($sql);            
                $stmt->bindParam(':descripcion', $this->descripcion);
                $stmt->bindParam(':id', $this->id);            
                // Ejecutar y devolver el resultado
                if ($stmt->execute()){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                $this->setLastErrorTxt($e->getMessage());
            }
        }

        // delete
        function delete(){
            $sql = "DELETE FROM ". $this->table_name . " WHERE id=:id LIMIT 1";
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':id', $this->id);
                if ($stmt->execute()){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $e){
                $this->setLastErrorTxt($e->getMessage());
            }
        }
    }
?>
