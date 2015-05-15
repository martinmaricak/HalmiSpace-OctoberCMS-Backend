<?php namespace HalmiSpace\BlogExtensions;

use System\Classes\PluginBase;

use RainLab\Blog\Models\Post as PostModel;
use RainLab\Blog\Controllers\Posts as PostsController;
use HalmiSpace\BlogExtensions\Models\JobDetails as JobDetailsModel;

/**
 * BlogExtensions Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'BlogExtensions',
            'description' => 'Extensions of rainlab blog plugin.',
            'author'      => 'Martin Maricak',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot() {
        PostModel::extend(function($model) {
            $model->hasOne['jobDetails'] = ['HalmiSpace\BlogExtensions\Models\jobDetails'];
        });


        PostsController::extendFormFields(function($form, $model, $context){

        if (!$model instanceof PostModel)
            return;

        if (!$model->exists)
            return;

        JobDetailsModel::getFromPost($model);


        $form->addSecondaryTabFields([
            'jobDetails[subheading]' => [
                'label'   => 'Text under the headline',
                'tab' => 'Job details',
                'type' => 'text'
            ],
            'jobDetails[cta_button]' => [
                'label'   => 'Title in the contact us button',
                'tab' => 'Job details',
                'type' => 'text'
            ],
            'jobDetails[subject_line]' => [
                'label'   => 'Contact us email subject line',
                'tab' => 'Job details',
                'type' => 'text'
            ]
        ]);

    });
    }

}
