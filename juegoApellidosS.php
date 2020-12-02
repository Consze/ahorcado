<?php
/******************************************
* NOMBRE Y APELLIDOS - LEGAJOS
CAMILO SALINAS - FAI 3009
******************************************/

/**Calcula el puntaje que otorga una palabra en base a su longitud
 * @param string $palabra
 * @param string $pista
 * @return int
 */
/*function calcularPuntosPalabra($palabra,$pista)
{
    if(strlen($palabra) > 4)
    {
        if(strlen($palabra) >= 8)
        {
            $puntosPalabra = 10;
        }
        $puntosPalabra = 8;
    }
    else
    {
        $puntosPalabra = 5;
    }
    if(str_word_count($pista,0) > 6)
    {
        if(str_word_count($pista,0) > 10)
        {
            $puntosPalabra = $puntosPalabra + 4;
        }
        $puntosPalabra = $puntosPalabra + 2;
    }
    return $puntosPalabra;
}
*/

/**Verifica si el usuario desea seguir jugando
 * @return boolean
 */
function verificarContinuarJugando($opcion)
{
    $opcionValor = 0;
    while($opcionValor != 8 && $opcionValor != 5)
    {
        echo("\n");
        echo("Desea volver al menu ? <SI-NO>\n");
        $continuarJugando = strtolower(trim(fgets(STDIN)));
        if($continuarJugando == "no")
        {
            $opcionValor = 8;
            
        }
        else if ($continuarJugando == "si")
        {
            $opcionValor = 5;
        }
        else
        {
            echo(">Ingrese una opcion valida\n");
        }
    }
    return $opcionValor;
}

/**Genera un arreglo de palabras para jugar
* @return array $coleccionPalabras
*/
function cargarPalabras()
{
  $coleccionPalabras = array();
  $coleccionPalabras[0] = array("palabra"=> "papa" , "pista" => "Tuberculo que se cultiva bajo tierra.", "puntosPalabra"=>8);
  $coleccionPalabras[1] = array("palabra"=> "hepatitis" , "pista" => "Enfermedad que inflama el higado.", "puntosPalabra"=> 10);
  $coleccionPalabras[2] = array("palabra"=> "volkswagen" , "pista" => "Marca de vehiculos alemana.", "puntosPalabra"=> 10);
  $coleccionPalabras[3] = array("palabra"=> "zanahoria" , "pista" => "Vegetal naranja que crece bajo la tierra.", "puntosPalabra"=> 9);
  $coleccionPalabras[4] = array("palabra"=> "porsche" , "pista" => "Marca de vehiculos alemana de alta gama.", "puntosPalabra"=> 10);
  $coleccionPalabras[5] = array("palabra"=> "ford" , "pista" => "Marca de vehiculos norteamericana, asociada con las camionetas 4x4.", "puntosPalabra"=> 7);
  $coleccionPalabras[6] = array("palabra"=> "audi" , "pista" => "Submarca alemana de vehiculos de Volkswagen. Marca de alta gama.", "puntosPalabra"=> 5);
  $coleccionPalabras[7] = array("palabra"=> "chevrolet" , "pista" => "Marca de vehiculos norteamericana. Competencia directa de ford.", "puntosPalabra"=> 10);
  return $coleccionPalabras;
}

/**Genera un arreglo de jugadas precargadas. Indica el puntaje y la palabra utilizada
 * Tambien almacena futuras partidas.
 * @return array $coleccionJuegos
 */
function cargarJuegos()
{
	$coleccionJuegos = array();
	$coleccionJuegos[0] = array("puntos"=> 0, "indicePalabra" => 1);
	$coleccionJuegos[1] = array("puntos"=> 10,"indicePalabra" => 2);
    $coleccionJuegos[2] = array("puntos"=> 0, "indicePalabra" => 1);
    $coleccionJuegos[3] = array("puntos"=> 8, "indicePalabra" => 0);
    $coleccionJuegos[4] = array("puntos"=> 10,"indicePalabra" => 7);
    $coleccionJuegos[5] = array("puntos"=> 5,"indicePalabra" => 6);
    $coleccionJuegos[6] = array("puntos"=> 10,"indicePalabra" => 4);
    $coleccionJuegos[7] = array("puntos"=> 0,"indicePalabra" => 3);
    return $coleccionJuegos;
}

/**A partir de la palabra genera un arreglo para determinar si sus letras fueron o no descubiertas
* @param string $palabra
* @return array
*/
function dividirPalabraEnLetras($palabra)
{
    $coleccionLetras = [];
    for($contador = 0; $contador < strlen($palabra); $contador++)
    {
        $coleccionLetras[$contador] = array("letra"=>substr($palabra,$contador,1),"descubierta"=>false);
    }
    return $coleccionLetras;
}

/**Muestra y obtiene una opcion de menú válida
* @return int
*/
function seleccionarOpcion()
{
    echo "--------------------------------------------------------------\n";
    echo "\n ( 1 ) Jugar con una palabra aleatoria\n"; 
    echo "--------------------------------------------------------------\n";
    echo "\n ( 2 ) Jugar con una palabra elegida\n"; 
    echo "--------------------------------------------------------------\n";
    echo "\n ( 3 ) Agregar una palabra al listado\n"; 
    echo "--------------------------------------------------------------\n";
    echo "\n ( 4 ) Mostrar la informacion completa de un numero de juego\n"; 
    echo "--------------------------------------------------------------\n";
    echo "\n ( 5 ) Mostrar la informacion completa del juego con mas puntaje\n";
    echo "--------------------------------------------------------------\n";
    echo "\n ( 6 ) Mostrar la informacion completa del juego que supere un puntaje indicado por el usuario\n"; 
    echo "--------------------------------------------------------------\n";
    echo "\n ( 7 ) Mostrar la lista de palabras ordenadas alfabeticamente\n"; 
    echo "--------------------------------------------------------------\n";
    echo "\n ( 8 ) Salir\n"; 
    echo "--------------------------------------------------------------\n";
    $opcion = trim(fgets(STDIN));
    while($opcion < 0 && $opcion >8)
    {
        echo(">Opcion invalida! Ingrese nuevamente el digito\n");
    }
    return $opcion;
}

/**Determina si una palabra existe en el arreglo de palabras
* @param array $coleccionPalabras
* @param string $palabra
* @return boolean
*/
function existePalabra($coleccionPalabras,$palabra)
{
    $i=0;
    $cantPal = count($coleccionPalabras);
    $existe = false;
    while($i<$cantPal && !$existe)
    {
        $existe = $coleccionPalabras[$i]["palabra"] == $palabra;
        $i++;
    }
    return $existe;
}


/**Determina si existe la letra ingresada en el arreglo de letras de la palabra con la que se esta jugando.
* @param array $coleccionLetras
* @param string $letra
* @return boolean
*/
function existeLetra($letra,$coleccionLetras)
{
    $contador=0;
    $existeLetra = false;
    while($contador<count($coleccionLetras) && !$existeLetra)
    {
        $existeLetra = $coleccionLetras[$contador]["letra"] == $letra;
        $contador++;
    }
    return $existeLetra;
}

/**
* Solicita los datos correspondientes a un elemento de la coleccion de palabras: palabra, pista y puntaje. 
* Internamente la función también verifica que la palabra ingresada por el usuario no exista en la colección de palabras.
* @param array $coleccionPalabras
* @return array  colección de palabras modificada con la nueva palabra.
*/
/*>>> Completar la interfaz y cuerpo de la función. Debe respetar la documentación <<<*/


/** Obtener indice aleatorio
* @param int $min
* @param int $max
* @return int $i
*/
function indiceAleatorioEntre($min,$max)
{
    $i = rand($min,$max); // Genera un numero entero aleatorio entre los valores $min y $max.
    return $i;
}

/**Solicita un valor entre min y max
* @param int $min
* @param int $max
* @return int
*/
function solicitarIndiceEntre($min,$max)
{ 
    do{
        echo (">Seleccione un valor entre ".$min. " y ".$max."\n");
        $i = trim(fgets(STDIN));
    }while(!($i>=$min && $i<=$max));
    return $i;
}



/**Determinar si la palabra fue descubierta, es decir, todas las letras fueron descubiertas
* @param array $coleccionLetras
* @return boolean
*/
function palabraDescubierta($coleccionLetras)
{
    $cantidadLetrasDescubiertas = 0;
    for($contador = 0; $contador < count($coleccionLetras);$contador++)
    {
        if($coleccionLetras[$contador]["descubierta"] == true)
        {
            $cantidadLetrasDescubiertas = $cantidadLetrasDescubiertas + 1;
        }
        if($cantidadLetrasDescubiertas == count($coleccionLetras))
        {
            $palabraFueDescubierta = true;
        }
        else
        {
            $palabraFueDescubierta = false;
        }
    }
    return $palabraFueDescubierta;
}

/**Solicita al usuario que ingrese una letra, la convierte a minuscula.
* @return string $letra
*/
function solicitarLetra()
{
    $letraCorrecta = false;
    do{
        echo "Ingrese una letra: ";
        $letra = strtolower(trim(fgets(STDIN)));
        if(strlen($letra)!=1){
            echo "Debe ingresar 1 letra!\n";
        }else{
            $letraCorrecta = true;
        }
    }while(!$letraCorrecta);
    return $letra;
}

/**Descubre todas las letras de la colección de letras iguales a la letra ingresada.
* Devuelve la coleccionLetras modificada, con las letras descubiertas
* @param array $coleccionLetras
* @param string $letra
* @return array colección de letras modificada.
*/
function destaparLetra($coleccionLetras, $letra)
{
    for($contador = 0; $contador < count($coleccionLetras);$contador++)
    {
        if($letra == $coleccionLetras[$contador]["letra"])
        {
            $coleccionLetras[$contador]["descubierta"] = true;
        }
    }
    return $coleccionLetras;
}

/**Obtiene la palabra con las letras descubiertas y * (asterisco) en las letras no descubiertas.
* @param array $coleccionLetras
* @return string $pal
*/
function stringLetrasDescubiertas($coleccionLetras)
{
    $pal = "";
    for($contador = 0; $contador < count($coleccionLetras); $contador++)
    {
        if($coleccionLetras[$contador]["descubierta"] == false)
        {   
            $pal = $pal."*";
        }
        else
        {
            $pal = $pal.$coleccionLetras[$contador]["letra"];
        }
    }
    return $pal;
}


/**Desarrolla el juego y retorna el puntaje obtenido
* Si descubre la palabra se suma el puntaje de la palabra más la cantidad de intentos que quedaron
* Si no descubre la palabra el puntaje es 0.
* @param array $coleccionPalabras
* @param int $indicePalabra
* @param int $cantIntentos
* @return int puntaje obtenido
*/
function jugar($coleccionPalabras, $indicePalabra,$cantIntentos)
{
    $pal = $coleccionPalabras[$indicePalabra]["palabra"];
    $coleccionLetras = dividirPalabraEnLetras($pal);
    $puntaje = 0;
    $contador = 0;
    echo "\n";
    echo("-------START-------\n");
    echo(stringLetrasDescubiertas($coleccionLetras)."\n");
    echo($coleccionPalabras[$indicePalabra]["pista"]."\n");
    while($contador < CANT_INTENTOS && palabraDescubierta($coleccionLetras) == false)
    {
        $letra = solicitarLetra();
        if(existeLetra($letra,$coleccionLetras))
        {
            echo("----La letra existe!----\n");
            $coleccionLetras = destaparLetra($coleccionLetras,$letra);
            echo(stringLetrasDescubiertas($coleccionLetras)."\n");
        }
        else
        {
            $contador++;
            $cantIntentos = $cantIntentos - 1;
            echo("----La letra no existe!----\n");
            echo(stringLetrasDescubiertas($coleccionLetras)."\n");
            echo("----Intentos restantes ".($cantIntentos)."----\n");
        }
    }
    if(palabraDescubierta($coleccionLetras))
    {
        $puntaje = $coleccionPalabras[$indicePalabra]["puntosPalabra"] + $cantIntentos;
        echo ("\n¡¡¡¡¡¡GANASTE ".$puntaje." puntos!!!!!!\n");
    }
    else
    {
        echo "\n¡¡¡¡¡¡AHORCADO AHORCADO!!!!!!\n";
    }
    return $puntaje;
}

/**Agrega un nuevo juego al arreglo de juegos
* @param array $coleccionJuegos
* @param int $ptos
* @param int $indicePalabra
* @return array coleccion de juegos modificada
*/
function agregarJuego($coleccionJuegos,$puntos,$indicePalabra)
{
    if(count($coleccionJuegos) == 0)
    {
        $coleccionJuegos[0] = array("puntos"=> $puntos, "indicePalabra" => $indicePalabra);
    }
    else
    {
        $coleccionJuegos[count($coleccionJuegos)] = array("puntos"=> $puntos, "indicePalabra" => $indicePalabra);
    } 
    return $coleccionJuegos;
}

/**Muestra los datos completos de un registro en la colección de palabras
* @param array $coleccionPalabras
* @param int $indicePalabra
* @return string $palabra
*/
function mostrarPalabra($coleccionPalabras,$indicePalabra)
{
    echo("Palabra: ".$coleccionPalabras[$indicePalabra]["palabra"]."\n"); 
    echo("Pista: ".$coleccionPalabras[$indicePalabra]["pista"]."\n");
    echo("Puntos por descubrir: ".$coleccionPalabras[$indicePalabra]["puntosPalabra"]."\n");   
}


/**Muestra los datos completos de un juego
* @param array $coleccionJuegos
* @param array $coleccionPalabras
* @param int $indiceJuego
*/
function mostrarJuego($coleccionJuegos,$coleccionPalabras,$indiceJuego)
{
    while($indiceJuego < 0 || $indiceJuego > count($coleccionPalabras))
    {
        echo(">Indice de partida invalido. Ingrese un numero valido\n");
        $indiceJuego = trim(fgets(STDIN));
    }
    echo "\n";
    echo "<-<-< Juego ".($indiceJuego)." >->->\n";
    echo ">Puntos ganados: ".$coleccionJuegos[$indiceJuego]["puntos"]."\n";
    echo ">Información de la palabra:\n";
    mostrarPalabra($coleccionPalabras,$coleccionJuegos[$indiceJuego]["indicePalabra"]);
    echo "\n";
}

/**Busca el juego con mayor puntaje en el registro de juegos y devuelve su indice
 * @param array $coleccionJuegos
 * @return int
 */
function buscarJuegoMayorPuntaje($coleccionJuegos)
{
    $umbralPuntaje = 0;
    for($contador = 0; $contador < count($coleccionJuegos); $contador++)
    {
        if($coleccionJuegos[$contador]["puntos"] > $umbralPuntaje)
        {
            $umbralPuntaje = $coleccionJuegos[$contador]["puntos"];
            $indiceJuego = $contador;
        }
    }
    return $indiceJuego;
}

/**Busca en el registro de juegos una partida que supere el puntaje ingresado.
 * De no encontrar esta partida devuelve el valor -1.
 * @param array $coleccionJuegos
 * @param int $umbralPuntaje
 * @return int
 */
function buscarJuegoMayorPuntajeObjetivo($coleccionJuegos,$umbralPuntaje)
{
    $indiceJuego = -1;
    // Comentario prueba git
    for($contador = 0; $contador < count($coleccionJuegos); $contador++)
    {
        if($coleccionJuegos[$contador]["puntos"] > $umbralPuntaje)
        {
            $umbralPuntaje = $coleccionJuegos[$contador]["puntos"];
            $indiceJuego = $contador;
        }
    }
    return $indiceJuego;
}

/**Recibe un arreglo de palabras y lo ordena alfabeticamente
 * @param array $coleccionPalabras
 * @return array
 */
function ordenarPalabrasAlfabeticamente($coleccionPalabras)
{
    asort($coleccionPalabras);
    return $coleccionPalabras; 
}




/************** PROGRAMA PRINCIAL *********/
define("CANT_INTENTOS", 6);
$coleccionJuegos = cargarJuegos();
$coleccionPalabras = cargarPalabras();
do{
    $opcion = seleccionarOpcion();
    switch ($opcion) 
    {
    case 1: echo "\n";
            echo "\n";
            echo("----Jugar con una palabra aleatoria----\n");
            $indicePalabra = indiceAleatorioEntre(0,(count($coleccionPalabras)-1));
            $puntaje = jugar($coleccionPalabras,$indicePalabra,CANT_INTENTOS);
            $coleccionJuegos = agregarJuego($coleccionJuegos,$puntaje,$indicePalabra);
        break;
    case 2: echo "\n";
            echo "\n";
            echo("----Jugar con una palabra elegida----\n");
            $indicePalabra = solicitarIndiceEntre(0,(count($coleccionPalabras)-1));
            $puntaje = jugar($coleccionPalabras,$indicePalabra,CANT_INTENTOS);
            $coleccionJuegos = agregarJuego($coleccionJuegos,$puntaje,$indicePalabra);
        break;
    case 3: echo "\n";
            echo "\n";
            echo("----Agregar una palabra al listado----\n");
            print_r($coleccionPalabras);
            echo(">Ingrese la palabra que desea agregar al listado\n");
            $palabraListado = strtolower(trim(fgets(STDIN)));
            while(existePalabra($coleccionPalabras,$palabraListado) == true || strlen($palabraListado) < 2)
            {
                echo("--La palabra ya existe en el registro del juego o tiene una cantidad insuficiente de caracteres.--\n");
                echo(">Ingrese una palabra distinta.\n");
                $palabraListado = strtolower(trim(fgets(STDIN)));
                existePalabra($coleccionPalabras,$palabraListado);
            }
            echo(">Defina una pista para la nueva palabra. \n");
            $pistaListado = trim(fgets(STDIN));
            echo(">Ingrese el puntaje deseado para la nueva palabra.\n");
            $puntajeListado = trim(fgets(STDIN));
            //$puntajeListado = calcularPuntosPalabra($palabraListado,$pistaListado);
            $coleccionPalabras[count($coleccionPalabras)] = array("palabra"=>$palabraListado,"pista"=>$pistaListado,"puntosPalabra"=>$puntajeListado);
            echo(">La palabra ha sido registrada con exito en la posicion ".(count($coleccionPalabras)-1)."\n");
            echo(">La pista es: ".$pistaListado."\n");
            echo(">El puntaje asignado para la palabra es de: ".$puntajeListado." puntos\n");
        break;
    case 4: echo "\n";
            echo "\n";
            echo("--Mostrar la información completa de un número de juego--\n");
                echo(">Hay un total de ".(count($coleccionJuegos))." partidas\n");
                echo(">Ingrese el numero de partida que quiere consultar. Para referirse a la primer posicion utilice el 0\n");
                $indiceJuego = trim(fgets(STDIN));
                mostrarJuego($coleccionJuegos,$coleccionPalabras,$indiceJuego);
        break;
    case 5: echo "\n";
            echo "\n";
            echo("----Mostrar la información completa del juego con más puntaje----\n");
                $indiceJuego = buscarJuegoMayorPuntaje($coleccionJuegos);
                mostrarJuego($coleccionJuegos,$coleccionPalabras,$indiceJuego);
        break;
    case 6: echo "\n";
            echo "\n";
            echo("----Mostrar la información completa del juego con puntaje mayor al indicado----\n");
            echo(">Ingrese el puntaje\n");
            $umbralPuntaje = trim(fgets(STDIN));
            $indiceJuego = buscarJuegoMayorPuntajeObjetivo($coleccionJuegos,$umbralPuntaje);
            if($indiceJuego == -1)
            {
                echo(">No hay ninguna partida que supere el puntaje ingresado.");
            }
            else
            {
                mostrarJuego($coleccionJuegos,$coleccionPalabras,$indiceJuego);
            }
         break;
    case 7: echo "\n";
            echo "\n";
            echo("----Mostrar la lista de palabras ordenada alfabeticamente----\n");
            $coleccionPalabras = ordenarPalabrasAlfabeticamente($coleccionPalabras);
            print_r($coleccionPalabras);
        break;
    }
    $opcion = verificarContinuarJugando($opcion);
}while($opcion < 8 && $opcion > 0 );