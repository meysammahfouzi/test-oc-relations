<?php namespace Meysam\Test\Models;

use Model;

/**
 * Model
 */
class Word extends Model
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
    public $table = 'meysam_test_words';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title' => 'required'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    public $belongsToMany = [
        'stories' => [
            'Meysam\Test\Models\Story',
            'table'    => 'meysam_test_stories_words',
            'key'      => 'word_id',
            'otherKey' => 'story_id',
        ],
    ];

}
