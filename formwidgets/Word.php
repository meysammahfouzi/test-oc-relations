<?php namespace Meysam\Test\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Meysam\Test\Models\Word as WordModel;

class Word extends FormWidgetBase
{
    /**
     * @var string A unique alias to identify this widget.
     */
    protected $defaultAlias = 'word';

    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('word');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['id']    = $this->getId();
        $this->vars['name']  = $this->getFieldName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
    }

    public function onGetWords()
    {
        $search  = post('term');
        $results = WordModel::where('title', 'like', '%' . $search . '%')->pluck('title', 'id');

        return ['result' => $results];
    }

    public function onAddWord()
    {
        $wordId = post($this->getFieldName());

        if (is_numeric($wordId)) {
            $this->model->words()->syncWithoutDetaching([$wordId]);
        } else {
            // if the word that user selected, was not in the list, wordId does not contain any ID,
            // but it's the actual new word the needs to be added to the words table
            $newWord = WordModel::create(
                [
                    'title' => $wordId,
                ]
            );
            $this->model->words()->attach($newWord->id);
        }

        // refresh the relation manager list
        return $this->controller->relationRefresh('words');
    }
}