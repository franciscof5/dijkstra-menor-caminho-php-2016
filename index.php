<?php
//include "rota.php";
?>

<!DOCTYPE html>
<html lang="pt" charset="utf-8">
<head>
    <title>Calculadora de Menor Caminho</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body style="width: 750px;background-color: #EEE">
<center>
<h1>Calculadora de Menor Caminho</h1>
</center>
<?php

if(!empty($_GET)) {
    if(isset($_GET["erro"])) {
        echo "<p> ERRO : ".$_GET["erro"]."</p>";
    } else { ?>
        <table style="background-color: #CE9;width: 100%;">
        <tr>
        <td>
        <?php 
        echo "<h4>Algorítimo 1</h4>";
        echo "Distancia: ".$_GET["distancia"]."<br />Rota: ".$_GET["rota"]."<br />Custo: ".$_GET["custo"];
         ?>
        </td>
        <td>
        <?php
        echo "<h4>Algorítimo 2</h4>";
        echo "Distancia: ".$_GET["distancia2"]."<br />Rota: ".$_GET["rota2"]."<br />Custo: ".$_GET["custo2"]; ?>
        </td>
        </tr>
        </table>
    <?php }
}
?>
<table>
<tr>
<td>
<form action="rota-3.php" method="POST" enctype="multipart/form-data">
    <p>
        <label for="autonomia">Autonomia (km/l):</label><br />
        <input type="text" name="autonomia" value="10" />
    </p>
    <p>
        <label for="valor_gas">Valor Combustível:</label><br />
        <input type="text" name="valor_gas" value="2.5" />
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
        <label for="arquivo_malha">Arquivo malha (.txt):</label><br />
        <input type="file" name="arquivo_malha">
    </p>
    <button type="submit">Enviar</button>
</form>
</td>
<td style="background-color: #DDD;padding: 0 20px;">
<h2>Exemplo de mapas</h2>
<p>Os arquivos de mapa de malha abaixo são exemplos para testar o sistema, faça o download em seu computador [opção: salvar arquivo como] para enviar o arquivo no formulário acima. O sistema aceita comunicação direta entre máquinas, o formulário acima é feito para testes de cálculos dos algorítimos.</p>
<ul>
    <li><a href="mapas/mapa1.txt">mapa1.txt</a> - 5 nós</li>
    <li><a href="mapas/mapa2.txt">mapa2.txt</a> - 6 nós</li>
    <li><a href="mapas/mapa3.txt">mapa3.txt</a> - 7 nós</li>
    <li><a href="mapas/mapa4.txt">mapa4.txt</a> - 8 nós</li>
    <li><a href="mapas/mapa5.txt">mapa5.txt</a> - 11 nós</li>
</ul>
</td>
</tr>
</table>
<center>
<h2>Francisco Matelli Matulovic</h2>
<p>2016-2018</p>
</center>
<?php
