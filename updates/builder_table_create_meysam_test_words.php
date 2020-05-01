<?php namespace Meysam\Test\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateMeysamTestWords extends Migration
{
    public function up()
    {
        Schema::create('meysam_test_words', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 100);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('meysam_test_words');
    }
}