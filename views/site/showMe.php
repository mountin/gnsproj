<?php
/**
 * Created by PhpStorm.
 * User: mountin
 * Date: 30.05.16
 * Time: 10:44
 */?>
<style>
    .mytable td, th {text-align:center};
    </style>
<table width="100%" class="mytable">
    <tr>
<th>
    дата
    </th>
    <th>
        аббревиатура команды хозяева
    </th>
    <th>
        аббревиатура команды гостя
    </th>
    <th>
        ID тадиона
    </th>
</tr>

    <?php foreach($responce as $value):?>
    <tr>
        <td><?php echo $value->{'day'};?></td>
        <td><?php echo $value->{'hometeam'};?></td>
        <td><?php echo $value->{'awayteam'};?></td>
        <td><?php echo $value->{'GameID'};?></td>


    </tr>
    <?php endforeach;?>
    </table>