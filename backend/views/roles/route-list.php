<?php

use yii\helpers\Url;

/**
 * @var array $list
 * @var \common\components\rbac\models\GroupPermissionForm $group
 */

?>
<section id="description" class="card">
    <div class="card-header">
        <h4 class="card-title"><?= $this->title ?></h4>
    </div>
    <div class="card-body collapse in">
        <div class="card-block">
            <div class="card-text">
                <table class="table">
                    <th>Ветка</th>
                    <th>Путь</th>
                    <th></th>
                    <?php
                    foreach ($list as $item) { ?>
                        <tr>
                            <?php $info = Yii::$app->accessControl->unParseRoute($item->name);
                            echo '<td><small>' . $info['branch'] . '</small></td><td>' . $info['rout'] . '</td>'; ?>
                            <td>
                                <a class="btn btn-sm btn-danger btn-flat"
                                   href="<?= Url::to(['/roles/remove-route', 'name' => $item->name, 'group' => $group->name]) ?>">
                                    X </a>
                            </td>
                        </tr>
                    <?php } ?>

                </table>
            </div>
        </div>
    </div>
</section>

