<?php
GLOBAL $dist;
function dijkstra($graph_array, $source, $target) {
	GLOBAL $dist;
    $vertices = array();
    $neighbours = array();
    foreach ($graph_array as $edge) {
        array_push($vertices, $edge[0], $edge[1]);
        $neighbours[$edge[0]][] = array("end" => $edge[1], "cost" => $edge[2]);
        $neighbours[$edge[1]][] = array("end" => $edge[0], "cost" => $edge[2]);
    }
    $vertices = array_unique($vertices);
 
    foreach ($vertices as $vertex) {
        $dist[$vertex] = INF;
        $previous[$vertex] = NULL;
    }
 
    $dist[$source] = 0;
    $Q = $vertices;
    while (count($Q) > 0) {
 
        // TODO - Find faster way to get minimum
        $min = INF;
        foreach ($Q as $vertex){
            if ($dist[$vertex] < $min) {
                $min = $dist[$vertex];
                $u = $vertex;
            }
        }
 
        $Q = array_diff($Q, array($u));
        if ($dist[$u] == INF or $u == $target) {
            break;
        }
 
        if (isset($neighbours[$u])) {
            foreach ($neighbours[$u] as $arr) {
                $alt = $dist[$u] + $arr["cost"];
                if ($alt < $dist[$arr["end"]]) {
                    $dist[$arr["end"]] = $alt;
                    $previous[$arr["end"]] = $u;
                }
            }
        }
    }
    $path = array();
    $u = $target;
    while (isset($previous[$u])) {
        array_unshift($path, $u);
        $u = $previous[$u];
    }
    array_unshift($path, $u);
    return $path;
}
 



$graph_array = array(
                    array("a", "b", 7),
                    array("a", "c", 9),
                    array("a", "f", 14),
                    array("b", "c", 10),
                    array("b", "d", 15),
                    array("c", "d", 11),
                    array("c", "f", 2),
                    array("d", "e", 6),
                    array("e", "f", 9)
               );

$graph_array = array(
                    array("a", "b", 7),
                    array("a", "d", 6),
                    array("b", "c", 9),
                    array("d", "e", 8),
                    array("d", "f", 7),
                    array("e", "g", 10),
                    array("f", "g", 8)
               );


//var_dump($_POST);die;
if(!empty($_POST)) {
	//, 
	//
	$path = dijkstra($graph_array, $_POST["origem"], $_POST["destino"]);
	echo "path is: ".implode(", ", $path)."\n";
	//die;
	$rota = implode(", ", $path);
	//
	var_dump($dist[$_POST["destino"]]);
	//die;
	$dista = $dist[$_POST["destino"]];
	
	$autonomia = $_POST["autonomia"];
	$valor_gas = $_POST["valor_gas"];
	$custo_km = ($autonomia/$valor_gas);
	//
	$custo = $dista/$custo_km;
	header( "HTTP/1.1 303 See Other" );
	header( "Location: index.php?distancia=$dista&rota=$rota&custo=$custo" );
} else {
    header( "HTTP/1.1 303 See Other" );
    header( "Location: index.php?erro=Nada recebido" );
}