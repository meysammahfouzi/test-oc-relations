<?php namespace Meysam\Test\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;

class Stories extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\RelationController',
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Meysam.Test', 'main-menu-test', 'side-menu-stories');
    }
}
