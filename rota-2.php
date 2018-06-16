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
                    ARRAY("A", "B", 7),
                    ARRAY("A", "C", 9),
                    ARRAY("A", "F", 14),
                    ARRAY("B", "C", 10),
                    ARRAY("B", "D", 15),
                    ARRAY("C", "D", 11),
                    ARRAY("C", "F", 2),
                    ARRAY("D", "E", 6),
                    ARRAY("E", "F", 9)
               );

$graph_array = array(
                    ARRAY("A", "B", 7),
                    ARRAY("A", "D", 6),
                    ARRAY("B", "C", 9),
                    ARRAY("D", "E", 8),
                    ARRAY("D", "F", 7),
                    ARRAY("E", "G", 10),
                    ARRAY("F", "G", 8)
               );


//var_dump($_POST);die;
if(!empty($_POST)) {
	$fp = fopen($_FILES["arquivo_malha"]["tmp_name"], "rw");
    //var_dump($fp);
    $graph = array();
    while ( ($line = fgets($fp)) !== false) {
        //echo " ============== ";
        //var_dump($ponto1 = substr($line,0,1));die; 
        # do something with $line
        echo " l:".$line;// = strtok( $separator );
        //echo $line;
        echo " p1:".$ponto1 = substr($line,0,1);
        echo " p2:".$ponto2 = substr($line,2,1);
        echo " d:".$distanci = substr($line,4);
        $np = array("$ponto1", "$ponto2", $distanci);
        //print_r($np);
        //die;
        array_push($graph, array($ponto1, $ponto2, $distanci));
        /*if(array_key_exists($ponto1, $graph)) {
            echo "existe nivel 1";
            $graph [$ponto1][] = array($ponto2 => $dist);
            if(array_key_exists($ponto2, $graph[$ponto1])) {
                //echo "existe nivel 2";
                $graph[$ponto1][] = array($ponto2 => $dist);
            } else {
                //echo "nao existe nivel 2";
                $graph[$ponto1][$ponto2] = $dist;
                //$graph [$ponto1] = array($ponto2 => array($ponto1 => $dist));
                //array_push($graph[$ponto1], )
            }
        } else {
            echo "nao existe nivel 1";
            $graph["$ponto1"] = array($ponto2 => $dist);
            //array_push($grap, "B");
        }*/
    }
   
    echo "<hr />";
    var_dump($graph);
    echo "<hr />";
    var_dump($graph_array);
    echo "<hr />";
	//, 
	//
	$path = dijkstra($graph, $_POST["origem"], $_POST["destino"]);
	//$path = dijkstra($graph_array, "A", "D");
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
	//die;
	header( "HTTP/1.1 303 See Other" );
	header( "Location: index.php?distancia=$dista&rota=$rota&custo=$custo" );
} else {
    header( "HTTP/1.1 303 See Other" );
    header( "Location: index.php?erro=Nada recebido" );
}