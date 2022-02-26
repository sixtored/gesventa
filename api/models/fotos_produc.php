<?php
    class Fotos_produc{
        // MVC - Model<->View(VFP)<->Controller
        // Conexión a la base de datos
        /*
        CREATE TABLE fotos_productos ( id int(8) NOT NULL AUTO_INCREMENT, idprod int(8) NOT NULL, codigo varchar(15) NOT NULL, foto MEDIUMBLOB, tipo varchar(10) NOT NULL, created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, deleted_at timestamp NULL DEFAULT NULL, PRIMARY KEY (id), KEY (idprod), KEY (codigo) ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1


          */
        private $conn;

        // Nombre de la tabla
        private $table_name = "fotos_productos";

        // Lista de propiedades
        public $id;
        public $idprod;
        public $codigo ;
        public $foto;
        public $tipo ;
        public $created;
        public $modified;
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
                    idprod,
                    codigo,
                    foto,
                    tipo,
                    created,
                    modified
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
                    idprod,
                    codigo,
                    foto,
                    tipo,
                    created,
                    modified
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
                $this->idprod       = $row['idprod'] ;
                $this->codigo       = $row['codigo'];
                $this->foto         = $row['foto'];
                $this->tipo         = $row['tipo'] ;
                $this->created      = $row['created'];
                $this->modified     = $row['modified'];

            }catch(PDOException $e){
                $this->setLastErrorTxt($e->getMessage());                
            }
        }

 // Devuelve el registro cargado en las propiedades. por el codigo
        function readOnecode(){
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
                    idprod,
                    codigo,
                    foto,
                    tipo,
                    created,
                    modified
                FROM " . $this->table_name . "
                WHERE 
                    ISNULL(deleted_at) AND
                    codigo = :codigo LIMIT 1";
            
            // Messagebox(cSql)
            // CLEAR EVENTS
            // QUIT            
            //die("consulta SQL: " . $sql);
            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':codigo', $this->codigo);
                $stmt->execute();    
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // Llenar las propiedades con los valores de las columnas.
                // LOCAL aPaises(3)
                // aPaises[1] = 'Argentina'
                // aPaises[2] = 'Bolivia'
                // aPaises[3] = 'Colombia'
                // ?aPaises[2]
                //////////////////////////////////
                $this->id           = $row['id'] ;
                $this->idprod       = $row['idprod'] ;
                $this->codigo       = $row['codigo'];
                $this->foto         = $row['foto'];
                $this->tipo         = $row['tipo'] ;
                $this->created      = $row['created'];
                $this->modified     = $row['modified'];

            }catch(PDOException $e){
                $this->setLastErrorTxt($e->getMessage());                
            }
        }


        // Devuelve el registros cargado en las propiedades. del rubro
        function readCodigo(){
          
            $sql = "
                SELECT
                    id,
                    idprod,
                    codigo,
                    foto,
                    tipo,
                    created,
                    modified
                FROM " . $this->table_name . "
                WHERE 
                    ISNULL(deleted_at) AND
                    rubro = :codigo";
            
            // Messagebox(cSql)
            // CLEAR EVENTS
            // QUIT            
            //die("consulta SQL: " . $sql);
            try{
                $stmt = $this->conn->prepare($sql);
                // ejecutar la consulta y devolver la variable $stmt
                $stmt->bindParam(':codigo', $this->codigo);
                $stmt->execute(); 
                return $stmt;                

                }catch(PDOException $e){
                    $this->setLastErrorTxt($e->getMessage());
                }

               
        }

        // método create
        function create(){
            $sql = "
            INSERT INTO " . $this->table_name . "
            (
                idprod,            
                codigo,
                foto,
                tipo
            ) VALUES
            (   
                :idprod,
                :codigo,
                :foto,
                :tipo
            )";
                        
            try{
                // Preparar la consulta
                $stmt = $this->conn->prepare($sql);
                // Enlace de Parámetros            
                // Sanear los campos
                $this->idprod = (int)$this->idprod ;
                $this->codigo = htmlspecialchars(strip_tags($this->codigo));
                $this->foto = htmlspecialchars(strip_tags($this->foto));
                $this->tipo = htmlspecialchars(strip_tags($this->tipo));
               
                //$this->imagen  = base64_decode($this->$imagen) ;
                //$this->imagentipo = htmlspecialchars(strip_tags($this->imagentipo)) ;
                // Fin Sanear los campos
                $stmt->bindParam(':idprod',$this->idprod) ;
                $stmt->bindParam(':codigo', $this->codigo);
                $stmt->bindParam(':foto', $this->foto);
                $stmt->bindParam(':tipo', $this->tipo);
               
                
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
                idprod      = :idprod,
                foto        = :foto,
                tipo        = :tipo
            WHERE
                codigo = :codigo
            LIMIT 1";            
            try{
                // Sanear los campos
                $this->codigo   = htmlspecialchars(strip_tags($this->codigo));
                $this->foto     = htmlspecialchars(strip_tags($this->foto)); 
                $this->tipo     = htmlspecialchars(strip_tags($this->tipo));
                $this->idprod   = $this->idprod ;
        
                $stmt = $this->conn->prepare($sql);      
               // $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':idprod', $this->idprod);
                $stmt->bindParam(':codigo', $this->codigo) ;
                $stmt->bindParam(':foto', $this->foto) ;      
                $stmt->bindParam(':tipo', $this->tipo);  
              
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
            //$sql = "DELETE FROM ". $this->table_name . " WHERE id=:id LIMIT 1";
            $date = date('Y-m-d') ;
            $sql = "
            UPDATE
                " . $this->table_name . "
            SET
                deleted_at =". strtotime($date)."
            WHERE
                idprod = :idprod
            LIMIT 1";            

            try{
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':idprod', $this->id);
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
