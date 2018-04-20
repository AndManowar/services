<?php

use yii\helpers\Url;

?>

<table class="table block_on_top">
    <th>Ветка</th>
    <th>Путь</th>
    <th></th>
    <?php
    foreach ($list as $item) { ?>
        <tr>
            <?php $info = Yii::$app->accessControll->unParseRoute($item->name);
            echo '<td><small>' . $info['branch'] . '</small></td><td>' . $info['rout'] . '</td>'; ?>
            <td>
                <a class="btn btn-sm btn-danger btn-flat"
                   href="<?= Url::to(['/roles/remove-route', 'name' => $item->name, 'group' => $group->name]) ?>">
                    X </a>
            </td>
        </tr>
    <?php } ?>

</table>
