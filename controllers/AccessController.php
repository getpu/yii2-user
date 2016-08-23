<?php

/**
 * Created by getpu on 16/8/19.
 */
 
namespace getpu\user\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use getpu\user\filters\AccessRule;

class AccessController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function(){
                            $user = \Yii::$app->user->identity;
                            return in_array($user->username, $user->module->admins)
                                   || \Yii::$app->user->can(\Yii::$app->requestedRoute);
                        },
                    ],
                ],
            ],
        ];
    }
}