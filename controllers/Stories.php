<?php namespace Meysam\Test\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use Meysam\Test\Models\Story as StoryModel;

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

    public function onLoadWordForm()
    {
        $config            = $this->makeConfig('$/meysam/test/models/story/fields_short.yaml');
        $config->alias     = '';
        $config->arrayName = '';
        $config->model     = StoryModel::find(post('record_id'));
        $storyFormWidget   = $this->makeFormWidget('Backend\Widgets\Form', $config);
        $storyFormWidget->bindToController();

        $this->initForm($config->model);

        $this->vars['storyFormWidget'] = $storyFormWidget;
        $this->vars['recordId'] = post('record_id');

        return $this->makePartial('story_form');
    }
}
