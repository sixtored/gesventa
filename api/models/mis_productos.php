<?php
    class Mis_productos{
        // MVC - Model<->View(VFP)<->Controller
        // Conexión a la base de datos
        /*
         $query = "CREATE TABLE mis_productos (
          id int(11) NOT NULL AUTO_INCREMENT,
          codigo varchar(15) NOT NULL,
          name varchar(100) COLLATE utf8_unicode_ci NOT NULL,
          description text COLLATE utf8_unicode_ci NOT NULL,
          price float(10,2) NOT NULL,
          created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          modified timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          deleted_at timestamp NULL DEFAULT NULL,
          status enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
          imagen blob, 
          imagentipo varchar(10), 
          PRIMARY KEY (id)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1" ;
          */
        private $conn;

        // Nombre de la tabla
        private $table_name = "mis_productos";

        // Lista de propiedades
        public $id;
        public $codigo;
        public $name ;
        public $description;
        public $rubro ;
        public $price ;
        public $stock ;
        public $created;
        public $modified;
        public $deleted_at;
        public $status ;
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
                    name,
                    description,
                    rubro,
                    price,
                    stock,
                    created,
                    modified,
                    status
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
                    name,
                    description,
                    rubro,
                    price,
                    stock,
                    created,
                    modified,
                    status
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
                $this->name         = $row['name'] ;
                $this->description  = $row['description'];
                $this->rubro        = $row['rubro'] ;
                //$this->subrubro     = $row['subrubro'] ;
                $this->price        = $row['price'] ;
                $this->stock        = $row['stock'] ;
                $this->created      = $row['created'];
                $this->modified     = $row['modified'];
                $this->status       = $row['status'] ;

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
                    codigo,
                    name,
                    description,
                    rubro,
                    price,
                    stock,
                    created,
                    modified,
                    status
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
                $this->codigo       = $row['codigo'];
                $this->name         = $row['name'] ;
                $this->description  = $row['description'];
                $this->rubro        = $row['rubro'] ;
               // $this->subrubro     = $row['subrubro'] ;
                $this->price        = $row['price'] ;
                $this->stock        = $row['stock'] ;
                $this->created      = $row['created'];
                $this->modified     = $row['modified'];
                $this->status       = $row['status'] ;
                $this->id           = $row['id'] ;

            }catch(PDOException $e){
                $this->setLastErrorTxt($e->getMessage());                
            }
        }


        // Devuelve el registros cargado en las propiedades. del rubro
        function readRubro(){
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
                    name,
                    description,
                    rubro,
                    price,
                    stock,
                    created,
                    modified,
                    status
                FROM " . $this->table_name . "
                WHERE 
                    ISNULL(deleted_at) AND
                    rubro = :rubro";
            
            // Messagebox(cSql)
            // CLEAR EVENTS
            // QUIT            
            //die("consulta SQL: " . $sql);
            try{
                $stmt = $this->conn->prepare($sql);
                // ejecutar la consulta y devolver la variable $stmt
                $stmt->bindParam(':rubro', $this->rubro);
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
                codigo,
                name,
                description,
                rubro,
                price,
                stock,
                status
            ) VALUES
            (
                :codigo,
                :name,
                :description,
                :rubro,
                :price,
                :stock,
                :status
            )";
                        
            try{
                // Preparar la consulta
                $stmt = $this->conn->prepare($sql);
                // Enlace de Parámetros            
                // Sanear los campos
                $this->codigo = htmlspecialchars(strip_tags($this->codigo));
                $this->name = htmlspecialchars(strip_tags($this->name)) ;
                $this->description = htmlspecialchars(strip_tags($this->description));
                $this->rubro    = htmlspecialchars(strip_tags($this->rubro)) ;
               // $this->subrubro    = htmlspecialchars(strip_tags($this->subrubro)) ;
                $this->price    = (float)$this->price ;
                $this->stock    = (float)$this->stock ;
                $this->status   = $this->status ;
                //$this->imagen  = base64_decode($this->$imagen) ;
                //$this->imagentipo = htmlspecialchars(strip_tags($this->imagentipo)) ;
                // Fin Sanear los campos

                $stmt->bindParam(':codigo', $this->codigo);
                $stmt->bindParam(':name', $this->name);
                $stmt->bindParam(':description', $this->description);
                $stmt->bindParam(':rubro', $this->rubro);
               // $stmt->bindParam(':subrubro', $this->subrubro);
                $stmt->bindParam(':price',$this->price) ;
                $stmt->bindParam(':stock',$this->stock) ;
                $stmt->bindParam(':status',$this->status);
              //  $stmt->bindParam(':imagen',$this->imagen) ;
               // $stmt->bindParam(':imagentipo',$this->imagentipo) ;
                
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
                codigo      = :codigo,
                name        = :name,
                description = :description,
                rubro       = :rubro,
                price       = :price,
                stock       = :stock,
                status      = :status
            WHERE
                id = :id
            LIMIT 1";            
            try{
                // Sanear los campos
                $this->codigo      = htmlspecialchars(strip_tags($this->codigo));
                $this->description = htmlspecialchars(strip_tags($this->description)); 
                $this->name        = htmlspecialchars(strip_tags($this->name));
                $this->rubro    = htmlspecialchars(strip_tags($this->rubro)) ;
              //  $this->subrubro    = htmlspecialchars(strip_tags($this->subrubro)) ;
                $this->price       = $this->price ;
                 $this->stock      = $this->stock ;
                $this->status      = $this->status ;
             //   $this->imagen      = addslashes($this->$imagen) ;
              //  $this->imagentipo  = htmlspecialchars(strip_tags($this->imagentipo));
                $stmt = $this->conn->prepare($sql);      
                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':codigo', $this->codigo) ;
                $stmt->bindParam(':name', $this->name) ;      
                $stmt->bindParam(':description', $this->description);  
                $stmt->bindParam(':rubro', $this->rubro);
              //  $stmt->bindParam(':subrubro', $this->subrubro);    
                $stmt->bindParam(':price',$this->price) ;
                $stmt->bindParam(':stock',$this->stock) ;
                $stmt->bindParam(':status',$this->status) ;
             //   $stmt->bindParam(':imagen',$this->imagen);
              //  $stmt->bindParam(':imagentipo',$this->imagentipo) ;      
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
            //$sql = "DELETE FROM ". $this->table_name . " WHERE id=:id LIMIT 1";
            $date = date('Y-m-d') ;
            $sql = "
            UPDATE
                " . $this->table_name . "
            SET
                deleted_at =". strtotime($date)."
            WHERE
                id = :id
            LIMIT 1";            

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
