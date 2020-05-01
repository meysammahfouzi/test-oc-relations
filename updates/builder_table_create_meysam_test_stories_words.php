<?php namespace Meysam\Test\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMeysamTestStoriesWords extends Migration
{
    public function up()
    {
        Schema::create('meysam_test_stories_words', function($table)
        {
            $table->engine = 'InnoDB';
            $table->integer('story_id')->unsigned();
            $table->integer('word_id')->unsigned();
            
            $table->foreign('story_id')->references('id')->on('meysam_test_stories')->onDelete('cascade');
            $table->foreign('word_id')->references('id')->on('meysam_test_words')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('meysam_test_stories_words');
    }
}