<?php namespace Meysam\Test\FormWidgets;

use Backend\Classes\FormWidgetBase;
use Meysam\Test\Models\Story as StoryModel;
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
        $sessionKey = $this->controller->formGetSessionKey();
        $storyModel = $this->model;
        $wordsRelation = $storyModel->words();

        $wordId  = post($this->getFieldName());

        $context = $this->controller->widget->form->context;

        if (is_numeric($wordId)) {
            if ($context === 'update') {
                $wordsRelation->syncWithoutDetaching([$wordId]);
            } else {
                $word = WordModel::find('id');
                $wordsRelation->add($word, $sessionKey);
            }
        } else {
            // if the word that user selected, was not in the list, wordId does not contain any ID,
            // but it's the actual new word the needs to be added to the words table
            $newWord = WordModel::create(
                [
                    'title' => $wordId,
                ]
            );
            if ($context === 'update') {
                $wordsRelation->attach($newWord->id);
            } else {
                $wordsRelation->add($newWord, $sessionKey);
            }
        }

        // refresh the relation manager list
        return $this->controller->relationRefresh('words');
    }
}