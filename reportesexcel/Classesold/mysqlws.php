/*
*	mysqlws.php
*		Forma parte del paquete de acceso a mysql junto con la librería mysqlwslib.js
*		Para utilizar el paquete se deben instalar los dos ficheros en el servidor donde 
*		tengamos instalado mysql.
*		En este fichero, mysqlws.php, hay que configurar las variables:
*				$host, $user, $pw, $db
*		con los valores adecuados a nuestra instalación.
*		En el fichero mysqlwslib.js hay que configurar la ruta correcta para que encuentre 
*		este fichero.
*
*	(c) Santiago Higuera (2010) http://www.ingemoral.es
*	El paquete se ha desarrollado por Santiago Higuera en Diciembre de 2010
*	La distribución se hace bajo una licencia GNU General Public License 
*	de acuerdo con los términos expresados en http://www.viti.es/gnu/licenses/gpl.html
* 	Si encuentras algún bug y quieres comunicarnoslo o quieres ponerte en contacto con 
*	nosotros por otro motivo, lo puedes hacer en:
*		admin@ingemoral.es
*
*/
<?php
header('Content-Type: text/xml');
header("Cache-Control: no-store, no-cache, must-revalidate");

// Los valores $host, $user, $pw, $db se deben de adaptar a cada instalación
$host="localhost";
$user="admin";
$pw="mipassword";
// Indicar el nombre de una base de datos que se abrirá por defecto
$db="basededatospordefecto";


if(isset($_GET['c']) and isset($_GET['p'])) {
	$command=$_GET['c'];
	$params = $_GET['p'];
	if(isset($_GET['db'])) {
		$db = $_GET['db'];
	}
	$resp = processcommand($command, $params);
} else {
	$resp=createResponse(0, "ERROR", "Parametros HTTPGET incorrectos");
}
echo $resp;
return;

function processCommand($command, $params) {
	// processCommand
	// procesa un comando válido recibido en la llamada a la página. 
	// Es llamado desde el flujo principal
	// Distribuye el trabajo a la rutina correspondiente y
	// devuelve una respuesta en formato xml
	
	// Declarar la respuesta
	$respxml=null;
	
	// Derivar a la rutina adecuada
	if(strcmp("updateQuery",$command)== 0) {
		$respxml=updateQuery($params);
	} else if (strcmp("selectQuery",$command)==0) {
		$respxml=selectQuery($params); 
	} else if (strcmp("getColNames",$command)==0) {
		$respxml=getColNames($params); 
	} else {
		$respxml=createResponse(0,"ERROR","El comando no existe");
	}

	return $respxml;
}


function updateQuery($query) {
// Ejecuta un comando tipo UPDATE, INSERT, DELETE,... en la base de datos
// $query = String con el comando	
// devuelve: xmlresponse con el resultado

	GLOBAL $host, $user, $pw, $db;

	// Abrir la conexión con mysql
	$conn = opendb($host, $user, $pw, $db);
	if(!$conn) {
		return createResponse(-2,"ERROR","Error de conexión.-$conn");
	}

	
	// Realizar la consulta a la B.D.
	$result=mysql_query($query, $conn);
	
	$ar = mysql_affected_rows();

	$cod = 0;
	$text ="ERROR";
	$desc ="-1";
	
	if($result == true) {
		$cod = 0;
		$text ="OK";
		$desc =$ar;	
	}
	$response = createResponse($cod,$text,$desc);

	// Cerrar la conexión
	closedb($conn);

	// Devolver el resultado
	return $response;
};

function selectQuery($query) {
// Ejecuta un comando tipo SELECT en la base de datos
// query = String con el comando	
// devuelve: xmlresponse con el resultado
	
	GLOBAL $host, $user, $pw, $db;

	// Abrir la conexión con mysql
	$conn = opendb($host, $user, $pw, $db);
	if(!$conn) {
		return createResponse(-2,"ERROR","Error de conexión.-$conn");
	}

	// Realizar la consulta a la B.D.
	$result=mysql_query($query, $conn);
	
	if ($result) {
		$nc = mysql_num_fields($result);
		
		$cad="";
		while( $row = mysql_fetch_array($result, MYSQL_BOTH)) {
			$cad .="<item>";
			for($i=0; $i<$nc; $i++) {
				$cad .= $row[$i];
				if($i<$nc-1) {
					$cad .= ",";
				}
			}
			$cad .= "</item>";
		}
		
		mysql_free_result($result);
		
		$response = createResponse(1, "OK", $cad);
	} else {
		$response = createResponse(0, "ERROR", "Error en la llamada SQL"); 
	}
	// Cerrar la conexión
	closedb($conn);

	// Devolver el resultado
	return $response;
};

function getColNames($nombreTabla) {
	// Devuelve un array con los nombres de las columnas de la 
	// tabla pasada como argumento
	// Si error devuelve array nulo;	
	
	// Establecer las variables globales
	GLOBAL $host, $user, $pw, $db;
	
	// Abrir la conexión con mysql
	$conn = opendb($host, $user, $pw, $db);
	if(!$conn) {
		return createResponse(-2,"ERROR","Error de conexión.-$conn");
	}
	
	// Realizar la consulta a la B.D.
	$query = "SELECT * FROM $nombreTabla";
	$result=mysql_query($query, $conn);
	if ($result) {
	
		$numcols = mysql_num_fields($result);
	
		$resp = "";
		for($i=0; $i< $numcols; $i++) {
			$resp .= mysql_field_name($result, $i);
			if($i < $numcols-1) {
				$resp .= ",";
			}	
		}
		mysql_free_result($result);
		$response = createResponse(1, "OK", $resp);
		
	} else {
		$response = createResponse(0, "ERROR", "Error en acceso SQL");
		
	}
	
	
	// Cerrar la conexión
	closedb($conn);

	// Devolver el resultado
	return $response;
};

function opendb($host, $user, $pw, $db) {
	// opendb
	// Establece conexión con el servidor $host y hace un USE de la base de datos $db
	// Parametros:
	//    $host
	//    $user
	//    $pw : password
	//    $db : Base de datos sobre la que se hará el USE 
	// Devuelve:
	//    Referencia a la conexión abierta o null si hay errores
	//
	$conn = mysql_connect($host, $user, $pw);
	if(!$conn) {
		return null;
	}
	//echo "connected<br/>";
	$resp = mysql_select_db($db, $conn);
	if($resp != true) {
		return null;
	}
	//echo "used<br/>";
	return $conn;
};

function closedb($conn) {
	// closedb()
	// Cierra la conexión con la base de datos
	// Parámetros:
	//	   $conn Referencia al recurso de la conexión con la B.D.
	// Devuelve
	//	   void
	if(!$conn) {
		return;
	}
	mysql_close($conn);
};

function createArrayFromCadParams($cadParams) {
	// Recibe como entrada la cadena de parametros separados por comas
	// y devuelve un Array con los parametros separados
	$arrayParams=array();
	if (strlen($cadParams)!=0) {
		if(strpos($cadParams, ',')>0) {
			$arrayParams = 	explode(',',$cadParams);
		} else {
			$arrayParams[0]=$cadParams;
		}
	}
	return $arrayParams;
};

function createResponse($code, $text, $content) {
	// createResponse($code, $descrip, $content)
	// 		Genera un documento XML del tipo <regataResponse>.
	// 		(Ver su constitución en la documentación del programa)
	// Parámetros:
	//
	// Devuelve:
	//
	$doc=new DOMDocument('1.0');
	$cadxml="<wsResponse>";
	$cadxml=$cadxml."<statusCode>$code</statusCode>";
	$cadxml=$cadxml."<statusText>$text</statusText>";
	$cadxml=$cadxml."<content>$content</content>";
	$cadxml=$cadxml."</wsResponse>";
	$doc->loadXML($cadxml);
	return $doc->saveXML();
};

function createResponseFromCode($code) {
	// createResponseFromCode($code)
	// 		Genera un documento XML del tipo <wsResponse>.
	// 		OK para códigos >0 y ERROR para codigos <= 0		
	// (Ver su constitución en la documentación del programa)
	// Parámetros:
	//
	// Devuelve:
	//
	$text="ERROR";
	$content = "ERROR";
	if($code>0) {
		$text="OK";
		$content ="OK";
	}
	$doc=new DOMDocument('1.0');
	$cadxml="<wsResponse>";
	$cadxml=$cadxml."<statusCode>$code</statusCode>";
	$cadxml=$cadxml."<statusText>$text</statusText>";
	$cadxml=$cadxml."<content>$content</content>";
	$cadxml=$cadxml."</wsResponse>";
	$doc->loadXML($cadxml);
	return $doc->saveXML();
};
?>