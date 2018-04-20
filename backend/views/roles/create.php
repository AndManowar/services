<?php

count($rbacs)>1 ? $this->title='Роль - '.$rbacs->name : $this->title='Добавить роли';
$this->params['breadcrumbs'][] = ['label' => 'RBAC', 'url' => ['/roles']];
$this->params['breadcrumbs'][]=$this->title;
echo $this->render('_form',['rbacs'=>$rbacs,'isCreate'=>$isCreate]);
?>