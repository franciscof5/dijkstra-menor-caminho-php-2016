<?php
//include "rota.php";
?>

<!DOCTYPE html>
<html lang="pt" charset="utf-8">
<head>
    <title>Calculadora de Menor Caminho</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>

<h1>Calculadora de Menor Caminho</h1>

<?php

if(!empty($_GET)) {
    if(isset($_GET["erro"])) {
        echo "<p> ERRO : ".$_GET["erro"]."</p>";
    } else {
        var_dump($_GET);
    }
}
?>

<form action="rota.php" method="POST">
    <p>
        <label for="autonomia">Autonomia (km/l):</label><br />
        <input type="text" name="autonomia" value="10" />
    </p>
    <p>
        <label for="valor_gas">Valor Combustível:</label><br />
        <input type="text" name="valor_gas" value="2,5" />
    </p>
    <p>
        <label for="origem">Origem:</label><br />
        <input type="text" name="origem" value="A" />
    </p>
    <p>
        <label for="destino">Destino:</label><br />
        <input type="text" name="destino" value="D" />
    </p>
    <p>
        <input type="radio" name="numero_mapa">Malha pré-configurada
        <input type="radio" name="numero_mapa">CUSTOM
    </p>
    <button type="submit">Enviar</button>
</form>
<h2>MALHAS</h2>
<form>
<textarea>
    I
A B 10
B D 15
A C 20
C D 30
B E 50
D E 30
</textarea>
    
</form>


<?php

$malha = "
I
A B 10
B D 15
A C 20
C D 30
B E 50
D E 30";

/*$malha = "
I
A B 10
B D 15
A C 20";
*/
$separator = "\r\n";
$line = strtok($malha, $separator);
//$graph = array('A' => array('D' => 3, 'F' => 6));
$graph = array();
while ($line !== false) {
    # do something with $line
    echo " l:".$line = strtok( $separator );
    echo " p1:".$ponto1 = substr($line,0,1);
    echo " p2:".$ponto2 = substr($line,2,1);
    echo " d:".$dist = substr($line,4);
    if(array_key_exists($ponto1, $graph)) {
        echo "existe nivel 1";
        //$graph [$ponto1][] = array($ponto2 => $dist);
        if(array_key_exists($ponto2, $graph[$ponto1])) {
            echo "existe nivel 2";
            $graph[$ponto1][] = array($ponto2 => $dist);
        } else {
            echo "nao existe nivel 2";
            $graph[$ponto1][$ponto2] = $dist;
            //$graph [$ponto1] = array($ponto2 => array($ponto1 => $dist));
            //array_push($graph[$ponto1], )
        }
    } else {
        echo "nao existe nivel 1";
        $graph["$ponto1"] = array($ponto2 => $dist);
        //array_push($grap, "B");
    }
    //
    if(array_key_exists($ponto2, $graph)) {
        echo "existe nivel 1";
        //$graph [$ponto1][] = array($ponto2 => $dist);
        if(array_key_exists($ponto1, $graph[$ponto2])) {
            echo "existe nivel 2";
            $graph[$ponto2][] = array($ponto1 => $dist);
        } else {
            echo "nao existe nivel 2";
            $graph[$ponto2][$ponto1] = $dist;
            //$graph [$ponto1] = array($ponto2 => array($ponto1 => $dist));
            //array_push($graph[$ponto1], )
        }
    } else {
        echo "nao existe nivel 1";
        $graph["$ponto2"] = array($ponto1 => $dist);
        //array_push($grap, "B");
    }
    echo "<br />";
}
print_r($graph );
?>
</body>
</html>

<?php
/*
A B 10
B D 15
A C 20
C D 30
B E 50
D E 30