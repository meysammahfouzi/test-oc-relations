<?php namespace Meysam\Test;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function registerSettings()
    {
    }

    public function registerFormWidgets()
    {
        return [
            'Meysam\Test\FormWidgets\Word' => 'story_word',
        ];
    }
}
