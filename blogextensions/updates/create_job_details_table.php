<?php namespace HalmiSpace\BlogExtensions\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateJobDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('halmispace_blogextensions_job_details', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('post_id')->unsigned()->index();
            $table->string('subject_line')->nullable();
            $table->string('subheading')->nullable();
            $table->string('cta_button')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('halmispace_blogextensions_job_details');
    }

}
