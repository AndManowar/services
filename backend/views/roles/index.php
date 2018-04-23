<?php


use yii\helpers\Url;

/** @var \yii\rbac\Role $roles */

$this->title = 'Разрешения';

$this->params['breadcrumbs'][] = $this->title;
?>

<section id="justified-top-border">
    <div class="row match-height">
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Редактирование RBAC</h4>
                </div>
                <div class="card-body">
                    <div class="card-block">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" id="active-tab" data-toggle="tab" href="#active"
                                   aria-controls="active" aria-expanded="false">Роли</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="link-tab" data-toggle="tab" href="#link"
                                   aria-controls="link" aria-expanded="true">Группы разрешений</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="linkOpt-tab" data-toggle="tab" href="#linkOpt"
                                   aria-controls="linkOpt">Роли/разрешения</a>
                            </li>
                        </ul>
                        <div class="tab-content px-1 pt-1">
                            <div role="tabpanel" class="tab-pane fade active in" id="active"
                                 aria-labelledby="active-tab"
                                 aria-expanded="false">
                                <section id="description" class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Роли</h4>
                                        <a class="heading-elements-toggle"><i
                                                    class="icon-ellipsis font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a href="<?= Url::to(['/roles/create-update']) ?>"><i
                                                                class="icon-android-add-circle"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body collapse in">
                                        <div class="card-block">
                                            <div class="card-text">
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
                                                                <td data-af-name="name"
                                                                    data-af-value="<?= $item->name ?>"><?= $item->name ?></td>
                                                                <td data-af-name="description"
                                                                    data-af-value="<?= $item->description ?>"><?= $item->description ?></td>
                                                                <td><?= date('H:i / d-m-Y', $item->createdAt) ?></td>
                                                                <td><?= date('H:i / d-m-Y', $item->updatedAt) ?></td>
                                                                <td>
                                                                    <a class="btn btn-success btn-sm btn-flat"
                                                                       href="<?= Url::to(['create-update', 'name' => $item->name]) ?>"><i
                                                                                class="material-icons">build</i></a>

                                                                    <a class="btn btn-danger btn-sm btn-flat"
                                                                       onclick="return confirm('Вы уверены, что хотите удалить роль?')"
                                                                       href="<?= Url::to(['index', 'name' => $item->name]) ?>"><i
                                                                                class="material-icons">delete</i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="link" role="tabpanel" aria-labelledby="link-tab"
                                 aria-expanded="true">
                                <section id="description" class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Группы разрешений</h4>
                                        <a class="heading-elements-toggle"><i
                                                    class="icon-ellipsis font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a href="<?= Url::to(['/roles/create-update-group-permission']) ?>"><i
                                                                class="icon-android-add-circle"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body collapse in">
                                        <div class="card-block">
                                            <div class="card-text">
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
                                                                <td data-af-name="name"
                                                                    data-af-value="<?= $item->name ?>"><?= $item->name ?></td>
                                                                <td data-af-name="description"
                                                                    data-af-value="<?= $item->description ?>"><?= $item->description ?></td>
                                                                <td><?= date('H:i / d-m-Y', $item->createdAt) ?></td>
                                                                <td><?= date('H:i / d-m-Y', $item->updatedAt) ?></td>
                                                                <td>
                                                                    <a class="btn btn-success btn-sm btn-flat"
                                                                       href="<?= Url::to(['create-update-group-permission', 'name' => $item->name]) ?>"><i
                                                                                class="material-icons">build</i></a>

                                                                    <a class="btn btn-warning btn-sm btn-flat"
                                                                       href="<?= Url::to(['route-list', 'name' => $item->name]) ?>"><i
                                                                                class="material-icons">description</i></a>
                                                                    <a class="btn btn-danger btn-sm btn-flat"
                                                                       href="<?= Url::to(['index', 'name' => $item->name, 'type' => 2]) ?>"
                                                                       onclick="return confirm('Вы уверены, что хотите удалить группу разрешений?')"><i
                                                                                class="material-icons">delete</i></a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="tab-pane fade" id="linkOpt" role="tabpanel" aria-labelledby="linkOpt-tab"
                                 aria-expanded="false">
                                <section id="description" class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Роли/разрешения</h4>
                                    </div>
                                    <div class="card-body collapse in">
                                        <div class="card-block">
                                            <div class="card-text">
                                                <div class="box box-primary">
                                                    <div class="box-header with-border">
                                                    </div>
                                                    <div class="box-body">
                                                        <br>
                                                        <table class="table table-bordered table-hover"
                                                               id="access-permission-change-tbl">
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
                                                                        $tableTr .= '<td data-role="' . $rItem->name . '"><div class="checkbox checkbox-slider--b-flat"><label><input class="access-permission-change-checkbox" type="checkbox" checked><span class="access-permission-change-checkbox"></span></label></div></td>';
                                                                    } else {
                                                                        $tableTr .= '<td data-role="' . $rItem->name . '"><div class="checkbox checkbox-slider--b-flat"> <label><input class="access-permission-change-checkbox" type="checkbox"><span class="access-permission-change-checkbox"></span></label></div></td>';
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
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>





