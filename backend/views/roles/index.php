<?php


use yii\helpers\Url;

/** @var \yii\rbac\Role $roles */

$this->title = 'Разрешения';

$this->params['breadcrumbs'][]=$this->title;
?>

<div class="col-md-12 block_on_top">
    <div id="exTab1" class="tab-pane fade in">
        <ul class="nav nav-pills">
            <li class="active"><a href="#roles" data-toggle="tab">Роли </a></li>
            <li><a href="#permissions" data-toggle="tab">Группы разрешений</a></li>
            <li><a href="#user_permissions" data-toggle="tab">Роли/разрешения</a></li>


        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="roles">
                <br>
                <div class="col-md-12 well">
                    <a href="<?= Url::to(['/roles/create-update']) ?>" class="btn btn-info btn-block">Создать
                        роль</a>
                </div>

                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Системное имя</th>
                            <th>Описание</th>
                            <th>Создано</th>
                            <th>Изменено</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($roles as $item) { ?>
                            <tr data-key="<?= $item->name ?>">
                                <td data-af-name="name" data-af-value="<?= $item->name ?>"><?= $item->name ?></td>
                                <td data-af-name="description"
                                    data-af-value="<?= $item->description ?>"><?= $item->description ?></td>
                                <td><?= date('H:i / d-m-Y', $item->createdAt) ?></td>
                                <td><?= date('H:i / d-m-Y', $item->updatedAt) ?></td>
                                <td>
                                    <a class="btn btn-success btn-sm btn-flat"
                                       href="<?= Url::to(['create-update', 'name' => $item->name]) ?>"><i class="material-icons">build</i></a>

                                    <a class="btn btn-danger btn-sm btn-flat"
                                       href="<?= Url::to(['index', 'name' => $item->name]) ?>"><i class="material-icons">delete</i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="tab-pane" id="permissions">
                <br>
                <div class="col-md-12 well">
                    <a href="<?= Url::to(['/roles/create-update-group-permission']) ?>"
                       class="btn btn-info btn-block">Создать
                        группу разрешений</a>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Системное имя</th>
                            <th>Описание</th>
                            <th>Создано</th>
                            <th>Изменено</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($permissions as $item) { ?>
                            <tr data-key="<?= $item->name ?>">
                                <td data-af-name="name" data-af-value="<?= $item->name ?>"><?= $item->name ?></td>
                                <td data-af-name="description"
                                    data-af-value="<?= $item->description ?>"><?= $item->description ?></td>
                                <td><?= date('H:i / d-m-Y', $item->createdAt) ?></td>
                                <td><?= date('H:i / d-m-Y', $item->updatedAt) ?></td>
                                <td>
                                    <a class="btn btn-success btn-sm btn-flat"
                                       href="<?= Url::to(['create-update-group-permission', 'name' => $item->name]) ?>"><i class="material-icons">build</i></a>

                                    <a class="btn btn-warning btn-sm btn-flat"
                                       href="<?= Url::to(['route-list', 'name' => $item->name]) ?>"><i class="material-icons">description</i></a>
                                    <a class="btn btn-danger btn-sm btn-flat"
                                       href="<?= Url::to(['index', 'name' => $item->name, 'type' => 2]) ?>"><i class="material-icons">delete</i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" id="user_permissions">

                <div class="box box-primary">
                    <div class="box-header with-border">
                    </div>
                    <div class="box-body">
                        <br>
                        <table class="table table-bordered table-hover" id="access-permission-change-tbl">
                            <thead>
                            <tr>
                                <th></th>
                                <?php foreach ($roles as $item) { ?>
                                    <th><?= $item->description ?></th>
                                <?php } ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($permissions as $gItem) {
                                $tableTr = '';
                                foreach ($roles as $rItem) {
                                    $tmpP = Yii::$app->authManager->getPermissionsByRole($rItem->name);
                                    if (isset($tmpP[$gItem->name])) {
                                        $tableTr .= '<td data-role="' . $rItem->name . '"><div class="checkbox checkbox-slider--b-flat"><label><input class="access-permission-change-checkbox" type="checkbox" checked><span class="slider round access-permission-change-checkbox"></span></label></div></td>';
                                    } else {
                                        $tableTr .= '<td data-role="' . $rItem->name . '"><div class="checkbox checkbox-slider--b-flat"> <label><input class="access-permission-change-checkbox" type="checkbox"><span class="slider round access-permission-change-checkbox"></span></label></div></td>';
                                    }
                                }

                                ?>
                                <tr data-group="<?= $gItem->name ?>">
                                    <td style="text-align: left;"><?= $gItem->description ?></td>
                                    <?= $tableTr ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="box-footer">
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>





