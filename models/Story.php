<?php namespace Meysam\Test\Models;

use Model;

/**
 * Model
 */
class Story extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'meysam_test_stories';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title' => 'required'
    ];

    public $belongsToMany = [
        'words' => [
            'Meysam\Test\Models\Word',
            'table'    => 'meysam_test_stories_words',
            'key'      => 'story_id',
            'otherKey' => 'word_id',
        ],
    ];
}
