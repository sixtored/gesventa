<?php
    class Abonados{
        // MVC - Model<->View(VFP)<->Controller
        // Conexión a la base de datos
        private $conn;

        // Nombre de la tabla
        private $table_name = "abonados";
     /*   

        CREATE TABLE `abonados` (
  `ID` int(20) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador',
  `RAZONSOCIAL` varchar(80) DEFAULT NULL COMMENT 'RAZONSOCIAL',
  `CALLE` varchar(30) DEFAULT NULL COMMENT 'CALLE',
  `NUMERO` varchar(8) DEFAULT NULL COMMENT 'NUMERO',
  `CONTRATO` varchar(10) DEFAULT NULL COMMENT 'CONTRATO',
  `SECTOR` varchar(25) DEFAULT NULL COMMENT 'SECTOR',
  `APELLIDO` varchar(25) DEFAULT NULL COMMENT 'APELLIDO',
  `NOMBRE` varchar(25) DEFAULT NULL COMMENT 'NOMBRE',
  `IDABONADO` int(4) DEFAULT 0 COMMENT 'IDABONADO',
  `DNI` int(4) DEFAULT 0 COMMENT 'DNI',
  `CUIT_CUIL` varchar(13) DEFAULT NULL COMMENT 'CUIT_CUIL',
  `EMAIL` varchar(60) DEFAULT NULL COMMENT 'EMAIL',
  `PISO` varchar(15) DEFAULT NULL COMMENT 'PISO',
  `DEPTO` varchar(10) DEFAULT NULL COMMENT 'DEPTO',
  `LOCALIDAD` varchar(20) DEFAULT NULL COMMENT 'LOCALIDAD',
  `PROVINCIA` varchar(20) DEFAULT NULL COMMENT 'PROVINCIA',
  `CP` varchar(14) DEFAULT NULL COMMENT 'CP',
  `PAIS` varchar(10) DEFAULT NULL COMMENT 'PAIS',
  `PRECINTO` varchar(10) DEFAULT NULL COMMENT 'PRECINTO',
  `FEC_ALTA` date DEFAULT NULL COMMENT 'FEC_ALTA',
  `FECHA_BAJA` date DEFAULT NULL COMMENT 'FECHA_BAJA',
  `BAJA` tinyint(1) DEFAULT 0 COMMENT 'BAJA',
  `IMP_NETO` double(9,2) DEFAULT 0.00 COMMENT 'IMP_NETO',
  `NOTA` longtext DEFAULT NULL COMMENT 'NOTA',
  `IDCOBRADOR` int(4) DEFAULT 0 COMMENT 'IDCOBRADOR',
  `STRCOBRADOR` varchar(30) DEFAULT NULL COMMENT 'STRCOBRADOR',
  `IDRECLA` int(4) DEFAULT 0 COMMENT 'IDRECLA',
  `TELEFONO` varchar(15) DEFAULT NULL COMMENT 'TELEFONO',
  `SERACT` int(4) DEFAULT 0 COMMENT 'SERACT',
  `SERINA` int(4) DEFAULT 0 COMMENT 'SERINA',
  `TIDDOCU` int(7) DEFAULT 0 COMMENT 'TIDDOCU',
  `ZONA` varchar(20) DEFAULT NULL COMMENT 'ZONA',
  `MANZANA` varchar(20) DEFAULT NULL COMMENT 'MANZANA',
  `REFDOM` varchar(60) DEFAULT NULL COMMENT 'REFDOM',
  `IDCORRE` int(4) DEFAULT 0 COMMENT 'IDCORRE',
  `IMPRESU` tinyint(1) DEFAULT 0 COMMENT 'IMPRESU',
  `IDSUSCMP` int(4) DEFAULT 0 COMMENT 'IDSUSCMP',
  `CELULAR` varchar(15) DEFAULT NULL COMMENT 'CELULAR',
  `SCTACTE` double(11,2) DEFAULT 0.00 COMMENT 'SCTACTE',
  `CELULAR2` varchar(15) DEFAULT NULL COMMENT 'CELULAR2',
  `TIPORES` int(2) DEFAULT 0 COMMENT 'TIPORES',
  `CBU` varchar(22) DEFAULT NULL COMMENT 'CBU',
  `IDEMPRE` int(4) DEFAULT 0 COMMENT 'IDEMPRE',
  `IDSUC` int(2) DEFAULT 0 COMMENT 'IDSUC',
  `IDLOC` int(2) DEFAULT 0 COMMENT 'IDLOC'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='ABONADOS';
*/

        // Lista de propiedades
        public $id;
        public $apellido;
        public $nombre;
        public $razonsocial ;
        public $idabonado;
        public $contrato;
        public $precinto;
        public $tipores ;
        public $tdoc;
        public $docu;
        public $sector;
        public $zona ;
        public $manzana ;
        public $calle ;
        public $numero ;
        public $piso;
        public $depto;
        public $localidad;
        public $provincia;
        public $pais ;
        public $celular ;
        public $celular2 ;
        public $email;
        public $cp ;
        public $fecha_alta;
        public $fecha_baja ;
        public $baja ;
        public $refdom ;
        public $sctacte ;
        public $cbu ;
        public $idempre ;
        public $idsuc ;
        public $idloc ;
        public $idcobrador ;
        public $impresu ;
        public $created_at ;
        public $modified_at ;
        public $deleted_at ;
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
                    apellido,
                    nombre,
                    razonsocial,
                    idabonado,
                    contrato,
                    precinto,
                    tipores,
                    tdoc,
                    docu,
                    sector,
                    zona,
                    manzana,
                    calle,
                    numero,
                    piso,
                    depto,
                    localidad,
                    provincia,
                    pais,
                    celular,
                    celular2,
                    email,
                    cp,
                    fecha_alta,
                    fecha_baja,
                    baja,
                    refdom,
                    sctacte,
                    cbu,
                    idempre,        
                    idsuc,
                    idloc,
                    idcobrador,
                    impresu,
                    created_at,
                    modified_at,
                    deleted_at
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
                    apellido,
                    nombre,
                    razonsocial,
                    idabonado,
                    contrato,
                    precinto,
                    tipores,
                    tdoc,
                    docu,
                    sector,
                    zona,
                    manzana,
                    calle,
                    numero,
                    piso,
                    depto,
                    localidad,
                    provincia,
                    pais,
                    celular,
                    celular2,
                    email,
                    cp,
                    fecha_alta,
                    fecha_baja,
                    baja,
                    refdom,
                    sctacte,
                    cbu,
                    idempre,        
                    idsuc,
                    idloc,
                    idcobrador,
                    impresu,
                    created_at,
                    modified_at,
                    deleted_at
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
                    

                $this->apellido       = $row['apellido'];
                $this->nombre         = $row['nombre'];
                $this->razonsocial    = $row['razonsocial'] ;
                $this->idabonado      = $row['idabonado'] ;
                $this->contrato       = $row['contrato'] ;
                $this->precinto       = $row['precinto'] ;
                $this->tipores        = $row['tipores'] ;
                $this->tdoc           = $row['tdoc'] ;
                $this->docu           = $row['docu'] ;
                $this->sector         = $row['sector'] ;
                $this->zona           = $row['zona'] ;
                $this->manzana        = $row['manzana'] ;
                $this->calle          = $row['calle'] ;
                $this->numero         = $row['numero'] ;
                $this->piso           = $row['piso'] ;
                $this->depto          = $row['depto'] ;
                $this->localidad      = $row['localidad'] ;
                $this->provincia      = $row['provincia'] ;
                $this->pais           = $row['pais'] ;
                $this->celular        = $row['celular'] ;
                $this->celular2       = $row['celular2'] ;
                $this->email          = $row['email'] ;
                $this->cp             = $row['cp'] ;
                $this->fecha_alta     = $row['fecha_alta'] ;
                $this->fecha_baja     = $row['fecha_baja'] ;
                $this->baja           = $row['baja'] ;
                $this->refdom         = $row['refdom'] ;
                $this->sctacte        = $row['sctacte'] ;
                $this->cbu            = $row['cbu'] ;
                $this->idempre        = $row['idempre'] ;
                $this->idsuc          = $row['idsuc'] ;
                $this->idloc          = $row['idloc'] ;
                $this->idcobrador     = $row['idcobrador'] ;
                $this->impresu        = $row['impresu'] ;
                $this->created_at     = $row['created_at'] ;
                $this->modified_at    = $row['modified_at'] ;
                $this->deleted_at     = $row['deleted_at'] ;

            }catch(PDOException $e){
                $this->setLastErrorTxt($e->getMessage());                
            }
        }


        // método create
        function create(){
            $sql = "
            INSERT INTO " . $this->table_name . "
            (  
               apellido,
               nombre,
               razonsocial,
               idabonado,
               contrato,
               precinto,
               tipores,
               tdoc,
               docu,
               sector,
               zona,
               manzana,
               calle,
               numero,
               piso,
               depto,
               localidad,
               provincia,
               pais,
               celular,
               celular2,
               email,
               cp,
               fecha_alta,
               fecha_baja,
               baja,
               refdom,
               sctacte,
               cbu,
               idempre,        
               idsuc,
               idloc,
               idcobrador,
               impresu
            ) VALUES
            (
               :apellido,
               :nombre,
               :razonsocial,
               :idabonado,
               :contrato,
               :precinto,
               :tipores,
               :tdoc,
               :docu,
               :sector,
               :zona,
               :manzana,
               :calle,
               :numero,
               :piso,
               :depto,
               :localidad,
               :provincia,
               :pais,
               :celular,
               :celular2,
               :email,
               :cp,
               :fecha_alta,
               :fecha_baja,
               :baja,
               :refdom,
               :sctacte,
               :cbu,
               :idempre,        
               :idsuc,
               :idloc,
               :idcobrador,
               :impresu
            )";
                        
            try{
                // Preparar la consulta
                $stmt = $this->conn->prepare($sql);
                // Enlace de Parámetros            
                // Sanear los campos
                $this->apellido     = htmlspecialchars(strip_tags($this->apellido));
                $this->nombre       = htmlspecialchars(strip_tags($this->nombre));
                $this->razonsocial  = htmlspecialchars(strip_tags($this->razonsocial));
                $this->idabonado    = htmlspecialchars(strip_tags($this->idabonado));
                $this->contrato     = htmlspecialchars(strip_tags($this->contrato));
                $this->precinto     = htmlspecialchars(strip_tags($this->precinto));
                $this->tipores      = htmlspecialchars(strip_tags($this->tipores));
                $this->tdoc         = htmlspecialchars(strip_tags($this->tdoc));
                $this->sector       = htmlspecialchars(strip_tags($this->sector));
                $this->zona         = htmlspecialchars(strip_tags($this->zona));
                $this->manzana      = htmlspecialchars(strip_tags($this->manzana));
                $this->calle        = htmlspecialchars(strip_tags($this->calle));
                $this->numero       = htmlspecialchars(strip_tags($this->numero));
                $this->piso         = htmlspecialchars(strip_tags($this->piso));
                $this->depto        = htmlspecialchars(strip_tags($this->depto));
                $this->localidad    = htmlspecialchars(strip_tags($this->localidad));
                $this->provincia    = htmlspecialchars(strip_tags($this->provincia));
                $this->pais         = htmlspecialchars(strip_tags($this->pais));
                $this->celular      = htmlspecialchars(strip_tags($this->celular));
                $this->celular2     = htmlspecialchars(strip_tags($this->celular2));
                $this->email        = htmlspecialchars(strip_tags($this->email));
                $this->cp           = htmlspecialchars(strip_tags($this->cp));
                $this->fecha_alta   = htmlspecialchars(strip_tags($this->fecha_alta));
                $this->fecha_baja   = htmlspecialchars(strip_tags($this->fecha_baja));
                $this->baja         = htmlspecialchars(strip_tags($this->baja));
                $this->refdom       = htmlspecialchars(strip_tags($this->refdom));
                $this->sctacte      = htmlspecialchars(strip_tags($this->sctacte));
                $this->cbu          = htmlspecialchars(strip_tags($this->cbu));
                $this->idempre      = htmlspecialchars(strip_tags($this->idempre));
                $this->idsuc        = htmlspecialchars(strip_tags($this->idsuc));
                $this->idloc        = htmlspecialchars(strip_tags($this->idloc));
                $this->idcobrador   = htmlspecialchars(strip_tags($this->idcobrador));
                $this->impresu      = htmlspecialchars(strip_tags($this->impresu));
                //$this->created_at = htmlspecialchars(strip_tags($this->created_at));
               // $this->modified_at = htmlspecialchars(strip_tags($this->modified_at));
               // $this->deleted_at = htmlspecialchars(strip_tags($this->deleted_at));
                // Fin Sanear los campos

                $stmt->bindParam(':apellido', $this->apellido);
                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':razonsocial', $this->razonsocial);
                $stmt->bindParam(':idabonado', $this->idabonado);
                $stmt->bindParam(':contrato', $this->contrato);
                $stmt->bindParam(':precinto', $this->precinto);
                $stmt->bindParam(':tipores', $this->tipores);
                $stmt->bindParam(':tdoc', $this->tdoc);
                $stmt->bindParam(':docu', $this->docu);
                $stmt->bindParam(':sector', $this->sector);
                $stmt->bindParam(':zona', $this->zona);
                $stmt->bindParam(':manzana', $this->manzana);
                $stmt->bindParam(':calle', $this->calle);
                $stmt->bindParam(':numero', $this->numero);
                $stmt->bindParam(':piso', $this->piso);
                $stmt->bindParam(':depto', $this->depto);
                $stmt->bindParam(':localidad', $this->localidad);
                $stmt->bindParam(':provincia', $this->provincia);
                $stmt->bindParam(':pais', $this->pais);
                $stmt->bindParam(':celular', $this->celular);
                $stmt->bindParam(':celular2', $this->celular2);
                $stmt->bindParam(':email', $this->email);
                $stmt->bindParam(':cp', $this->cp);
                $stmt->bindParam(':fecha_alta', $this->fecha_alta);
                $stmt->bindParam(':fecha_baja', $this->fecha_baja);
                $stmt->bindParam(':baja', $this->baja);
                $stmt->bindParam(':refdom', $this->refdom);
                $stmt->bindParam(':sctacte', $this->sctacte);
                $stmt->bindParam(':cbu', $this->cbu);
                $stmt->bindParam(':idempre', $this->idempre);
                $stmt->bindParam(':idsuc', $this->idsuc);
                $stmt->bindParam(':idloc', $this->idloc);
                $stmt->bindParam(':idcobrador', $this->idcobrador);
                $stmt->bindParam(':impresu', $this->impresu);

                
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
                apellido = :apellido,
                nombre = :nombre,
                razonsocial = :razonsocial,
                idabonado = :idabonado,
                contrato = :contrato,
                precinto = :precinto,
                tipores = :tipores,
                tdoc = :tdoc,
                sector = :sector,
                zona = :zona,
                manzana = :manzana,
                calle = :calle,
                numero = :numero,
                piso = :piso,
                depto = :depto,
                localidad = :localidad,
                provincia = :provincia,
                pais = :pais,
                celular = :celular,
                celular2 = :celular2,
                email = :email,
                cp = :cp,
                fecha_alta = :fecha_alta,
                fecha_baja = :fecha_baja,
                baja = :baja,
                refdom = :refdom,
                sctacte = :sctacte,
                cbu = :cbu,
                idempre = :idempre,
                idsuc = :idsuc,
                idloc = :idloc,
                idcobrador = :idcobrador,
                impresu = :impresu
            WHERE
                id = :id
            LIMIT 1";            
            try{
                // Sanear los campos
                //$this->descripcion = htmlspecialchars(strip_tags($this->descripcion));            
                $this->apellido     = htmlspecialchars(strip_tags($this->apellido));
                $this->nombre       = htmlspecialchars(strip_tags($this->nombre));
                $this->razonsocial  = htmlspecialchars(strip_tags($this->razonsocial));
                $this->idabonado    = htmlspecialchars(strip_tags($this->idabonado));
                $this->contrato     = htmlspecialchars(strip_tags($this->contrato));
                $this->precinto     = htmlspecialchars(strip_tags($this->precinto));
                $this->tipores      = htmlspecialchars(strip_tags($this->tipores));
                $this->tdoc         = htmlspecialchars(strip_tags($this->tdoc));
                $this->sector       = htmlspecialchars(strip_tags($this->sector));
                $this->zona         = htmlspecialchars(strip_tags($this->zona));
                $this->manzana      = htmlspecialchars(strip_tags($this->manzana));
                $this->calle        = htmlspecialchars(strip_tags($this->calle));
                $this->numero       = htmlspecialchars(strip_tags($this->numero));
                $this->piso         = htmlspecialchars(strip_tags($this->piso));
                $this->depto        = htmlspecialchars(strip_tags($this->depto));
                $this->localidad    = htmlspecialchars(strip_tags($this->localidad));
                $this->provincia    = htmlspecialchars(strip_tags($this->provincia));
                $this->pais         = htmlspecialchars(strip_tags($this->pais));
                $this->celular      = htmlspecialchars(strip_tags($this->celular));
                $this->celular2     = htmlspecialchars(strip_tags($this->celular2));
                $this->email        = htmlspecialchars(strip_tags($this->email));
                $this->cp           = htmlspecialchars(strip_tags($this->cp));
                $this->fecha_alta   = htmlspecialchars(strip_tags($this->fecha_alta));
                $this->fecha_baja   = htmlspecialchars(strip_tags($this->fecha_baja));
                $this->baja         = htmlspecialchars(strip_tags($this->baja));
                $this->refdom       = htmlspecialchars(strip_tags($this->refdom));
                $this->sctacte      = htmlspecialchars(strip_tags($this->sctacte));
                $this->cbu          = htmlspecialchars(strip_tags($this->cbu));
                $this->idempre      = htmlspecialchars(strip_tags($this->idempre));
                $this->idsuc        = htmlspecialchars(strip_tags($this->idsuc));
                $this->idloc        = htmlspecialchars(strip_tags($this->idloc));
                $this->idcobrador   = htmlspecialchars(strip_tags($this->idcobrador));
                $this->impresu      = htmlspecialchars(strip_tags($this->impresu));
                $stmt = $this->conn->prepare($sql);            
                //$stmt->bindParam(':descripcion', $this->descripcion);
                $stmt->bindParam(':id', $this->id);            
                // Ejecutar y devolver el resultado
                $stmt->bindParam(':apellido', $this->apellido);
                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':razonsocial', $this->razonsocial);
                $stmt->bindParam(':idabonado', $this->idabonado);
                $stmt->bindParam(':contrato', $this->contrato);
                $stmt->bindParam(':precinto', $this->precinto);
                $stmt->bindParam(':tipores', $this->tipores);
                $stmt->bindParam(':tdoc', $this->tdoc);
                $stmt->bindParam(':docu', $this->docu);
                $stmt->bindParam(':sector', $this->sector);
                $stmt->bindParam(':zona', $this->zona);
                $stmt->bindParam(':manzana', $this->manzana);
                $stmt->bindParam(':calle', $this->calle);
                $stmt->bindParam(':numero', $this->numero);
                $stmt->bindParam(':piso', $this->piso);
                $stmt->bindParam(':depto', $this->depto);
                $stmt->bindParam(':localidad', $this->localidad);
                $stmt->bindParam(':provincia', $this->provincia);
                $stmt->bindParam(':pais', $this->pais);
                $stmt->bindParam(':celular', $this->celular);
                $stmt->bindParam(':celular2', $this->celular2);
                $stmt->bindParam(':email', $this->email);
                $stmt->bindParam(':cp', $this->cp);
                $stmt->bindParam(':fecha_alta', $this->fecha_alta);
                $stmt->bindParam(':fecha_baja', $this->fecha_baja);
                $stmt->bindParam(':baja', $this->baja);
                $stmt->bindParam(':refdom', $this->refdom);
                $stmt->bindParam(':sctacte', $this->sctacte);
                $stmt->bindParam(':cbu', $this->cbu);
                $stmt->bindParam(':idempre', $this->idempre);
                $stmt->bindParam(':idsuc', $this->idsuc);
                $stmt->bindParam(':idloc', $this->idloc);
                $stmt->bindParam(':idcobrador', $this->idcobrador);
                $stmt->bindParam(':impresu', $this->impresu);
                ////
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
