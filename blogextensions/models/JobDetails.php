<?php namespace HalmiSpace\BlogExtensions\Models;

use Model;

/**
 * JobDetails Model
 */
class JobDetails extends Model
{

    /**
     * @var string The database table used by the model.
     */
    public $table = 'halmispace_blogextensions_job_details';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $belongsTo = [
        'post' => ['RainLab\Blog\Models\Post']
    ];

    public static function getFromPost($post) {
        if ($post->jobDetails) {
            return $post->jobDetails;
        }

        $jobDetails = new static;
        $jobDetails->post = $post;
        $jobDetails->save();

        return $jobDetails;
    }

}