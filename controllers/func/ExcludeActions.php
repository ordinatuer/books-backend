<?php
namespace app\controllers\func;

trait ExcludeActions
{
	public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete'], $actions['create'], $actions['update']);

        return $actions;
    }
}