<?php
class PriorityQueue extends SplPriorityQueue
{
    public function compare($p1, $p2) {
        if ($p1 == $p2) {
			return 0;
		}
		else {
            return ($p1 < $p2) ? 1 : -1;
		}
  }
}
class Dijkstra
{
    protected $graph;
    public function __construct($graph) {
        $this->graph = $graph;
    }
    public function shortestPath($source, $target) {
        // initialize Q, d and pi for all vertices
        $d = array();  // array of best estimates of shortest path to each vertex
        $pi = array(); // array of predecessors for each vertex
        $Q = new SplPriorityQueue(); // queue of all unoptimized vertices
        foreach ($this->graph as $v => $adj) {
            $d[$v] = INF; // set initial distance to "infinity"
            $pi[$v] = null; // no known predecessors yet
            foreach ($adj as $w => $cost) {
                // use the edge cost as the priority
                $Q->insert($w, $cost);
            }
        }
        // initial distance at source is 0
        $d[$source] = 0;
        while (!$Q->isEmpty()) {
            // extract min cost
            $u = $Q->extract();
            if (!empty($this->graph[$u])) {
                // "relax" each adjacent vertex
                foreach ($this->graph[$u] as $v => $cost) {
                    // alternate route length to adjacent neighbor
                    $alt = $d[$u] + $cost;
                    // if alternate route is shorter
                    if ($alt < $d[$v]) {
                        $d[$v] = $alt; // update minimum length to vertex
                        $pi[$v] = $u;  // add neighbor to predecessors for vertex
                    }
                }
            }
        }
        // we can now find the shortest path using reverse iteration
        $S = new SplStack(); // construct the shortest path with a stack S
        $u = $target;
        $dist = 0;
        // traverse from target to source
        while (isset($pi[$u]) && $pi[$u]) {
            $S->push($u);
            $dist += $this->graph[$u][$pi[$u]];  // add distance to next predecessor
            $u = $pi[$u];
        }
        // stack will be empty if there is no route back
        if ($S->isEmpty()) {
            return "No route from $source to $target\n";
        }
        else {
            // add the source node and print the path in reverse (LIFO) order
            $S->push($source);
            //echo "$dist:";
            
            $sep = '';
            foreach ($S as $v) {
                //echo $sep, $v;
                $sep .= $v;
                //$sep .= '->';
                $sep .= ' ';
            }
            return array($dist, $sep);
          //echo "\n";
        }
    }
}
//var_dump($_POST);
//var_dump($_FILES);
//var_dump($fp = fopen($_FILES["arquivo_malha"]['tmp_name'], "r"));
//die;
//error_reporting(E_ALL);die; 


GLOBAL $dist_;
function dijkstra($graph_array, $source, $target) {
    GLOBAL $dist_;
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
    //
    $dist_ = $dist;
    //
    return $path;
}

//var_dump($fp = fopen($_FILES['uploaded_file']['tmp_name'], 'r'));
//var_dump($fp = fopen($_POST("arquivo_malha"), 'rb'));
if(!empty($_POST)) {
    
    /*$graph = array(
      'A' => array('B' => 3, 'D' => 3, 'F' => 6),
      'B' => array('A' => 3, 'D' => 1, 'E' => 3),
      'C' => array('E' => 2, 'F' => 3),
      'D' => array('A' => 3, 'B' => 1, 'E' => 1, 'F' => 2),
      'E' => array('B' => 3, 'C' => 2, 'D' => 1, 'F' => 5),
      'F' => array('A' => 6, 'C' => 3, 'D' => 2, 'E' => 5),
    );*/
    
/*$malha = "
I
A B 10
B D 15
A C 20
C D 30
B E 50
D E 30";*/

    /*$malha = "
    I
    A B 10
    B D 15
    A C 20";
    */

#AQUI 
    //$separator = "\r\n";
    //$line = strtok($malha, $separator);
    //$graph = array('A' => array('D' => 3, 'F' => 6));
    $graph = array();
    $graph2 = array();
    //while ($line !== false) {

    $fp = fopen($_FILES["arquivo_malha"]["tmp_name"], "rw");
    //var_dump($fp);
    while ( ($line = fgets($fp)) !== false) {
        //echo " ============== ";
        //var_dump($ponto1 = substr($line,0,1));die; 
        # do something with $line
        echo " l:".$line;// = strtok( $separator );
        //echo $line;
        echo " p1:".$ponto1 = substr($line,0,1);
        echo " p2:".$ponto2 = substr($line,2,1);
        echo " d:".$distanci = substr($line,4);
        
        //ALGORITIMO2
        $np = array("$ponto1", "$ponto2", $distanci);
        //print_r($np);
        //ALGORITIMO2
        array_push($graph2, array($ponto1, $ponto2, $distanci));
        
        //
        if(array_key_exists($ponto1, $graph)) {
            echo "existe nivel 1";
            //$graph [$ponto1][] = array($ponto2 => $distanci);
            if(array_key_exists($ponto2, $graph[$ponto1])) {
                //echo "existe nivel 2";
                $graph[$ponto1][] = array($ponto2 => $distanci);
            } else {
                //echo "nao existe nivel 2";
                $graph[$ponto1][$ponto2] = $distanci;
                //$graph [$ponto1] = array($ponto2 => array($ponto1 => $dist));
                //array_push($graph[$ponto1], )
            }
        } else {
            echo "nao existe nivel 1";
            $graph["$ponto1"] = array($ponto2 => $distanci);
            //array_push($grap, "B");
        }
        //
        if(array_key_exists($ponto2, $graph)) {
            //echo "existe nivel 1";
            //$graph [$ponto1][] = array($ponto2 => $distanci);
            if(array_key_exists($ponto1, $graph[$ponto2])) {
                //echo "existe nivel 2";
                $graph[$ponto2][] = array($ponto1 => $distanci);
            } else {
                //echo "nao existe nivel 2";
                $graph[$ponto2][$ponto1] = $distanci;
                //$graph [$ponto1] = array($ponto2 => array($ponto1 => $dist));
                //array_push($graph[$ponto1], )
            }
        } else {
            //echo "nao existe nivel 1";
            $graph["$ponto2"] = array($ponto1 => $distanci);
            //array_push($grap, "B");
        }
        //echo "<br />";
    }
    echo "<hr />";
    print_r($graph );
    
    $mapa2 = array(
      'A' => array('B' => 10, 'C' => 9, 'D' => 10, 'E' => 12),
      'B' => array('A' => 10, 'C' => 7),
      'C' => array('A' => 9, 'B' => 7, 'D' => 8),
      'D' => array('A' => 10, 'C' => 8, 'E' => 9, 'F' => 8),
      'E' => array('A' => 12, 'D' => 9, 'F' => 7),
      'F' => array('D' => 8, 'E' => 7),
    );
    $mapa3 = array(
      'A' => array('B' => 3, 'D' => 3, 'F' => 6),
      'B' => array('A' => 3, 'D' => 1, 'E' => 3),
      'C' => array('E' => 2, 'F' => 3),
      'D' => array('A' => 3, 'B' => 1, 'E' => 1, 'F' => 2),
      'E' => array('B' => 3, 'C' => 2, 'D' => 1, 'F' => 5),
      'F' => array('A' => 6, 'C' => 3, 'D' => 2, 'E' => 5),
    );
    echo "<hr />2";
    print_r($mapa2);
    //$graph=$mapa3;
    echo "<hr />3";
    //$result = array_diff($graph, $mapa2);
    //print_r($result);
    
    $g = new Dijkstra($graph);
    $a = $g->shortestPath($_POST["origem"], $_POST["destino"]);  //
    $dist = $a[0];
    $rota = $a[1];
    var_dump( $a );
    //die;

    //ALGORITMO 2
    $autonomia = $_POST["autonomia"];
    $valor_gas = $_POST["valor_gas"];
    $custo_km = ($autonomia/$valor_gas);
    //
    $custo = $dist/$custo_km;

    /**/
    $graph_array = array(
                    array("A", "B", 7),
                    array("A", "D", 6),
                    array("B", "C", 9),
                    array("D", "E", 8),
                    array("D", "F", 7),
                    array("E", "G", 10),
                    array("F", "G", 8)
               );
    //$path = dijkstra($graph_array, "G", "C");

    var_dump($path = dijkstra($graph2, $_POST["origem"], $_POST["destino"]));
    var_dump($graph2);

    echo $rota2 = implode(", ", $path);
    //die;
    $dista2 = $dist_[$_POST["destino"]];
    //
    $custo2 = $dista2/$custo_km;

    header( "HTTP/1.1 303 See Other" );
    header( "Location: index.php?distancia=$dist&rota=$rota&custo=$custo&distancia2=$dist2&rota2=$rota2&custo2=$custo2" );
} else {
    header( "HTTP/1.1 303 See Other" );
    header( "Location: index.php?erro=Nada recebido" );
}

//echo $custo = $rota/$consumo;

//var_dump($a[0]);

/*$g->shortestPath('C', 'A');  // 6:C->E->D->A
$g->shortestPath('B', 'F');  // 3:B->D->F
$g->shortestPath('F', 'A');  // 5:F->D->A 
$g->shortestPath('A', 'G');  // No route from A to G