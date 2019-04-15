<?php

use app\models\Location;
use yii\helpers\Html;

$location = new Location();?>
<table class="diaria">
    <tr class="bordaMenu">
        <th class="borda" style="width: 25%">Alerta</th>
        <th class="borda" style="width: 25%">Nome Bovino</th>
        <th class="borda" style="width: 25%">Ícone</th>
        <th class="borda" style="width: 15%">Data</th>
    </tr>

    <?php
    $arrayOutside = $location->getLocationOutsideFence();
    foreach ($arrayOutside as $key){
        $dataFormatada = new DateTime($key['location_data']);
        echo '
    <tr>
        <td class="borda" style="text-align: center"><div class="glyphicon glyphicon-warning-sign" style="color: red;font-size:14px; "><label style="font-family: Arial,serif; margin-left: 15px">Animal fora da cerca!</label></div></td>
        <td class="borda ">'.$key['bovino_nome'].'</td>
        <td class="borda">'.Html::img($key['device_base'].$key['device_icon']).'</td>
        <td class="borda"> '.$dataFormatada->format("d/m/Y H:i:s").'</td>
    </tr>';
    }?>
</table>