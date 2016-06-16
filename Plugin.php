<?php namespace Romanov\Flashmessage;

use System\Classes\PluginBase;
use Backend;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'romanov.flashmessage::lang.plugin.name',
            'description' => 'romanov.flashmessage::lang.plugin.description',
            'author'      => 'Alexander Romanov',
            'icon'        => 'icon-bullhorn',
            'homepage'    => 'https://github.com/romanov-acc/octobercms_flashmessage'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'romanov.flashmessage::lang.plugin.name',
                'description' => 'romanov.flashmessage::lang.plugin.description',
                'icon'        => 'icon-bullhorn',
                'url'         => Backend::url('romanov/flashmessage/settings'),
                'order'       => 501,
                'category'    => 'system::lang.system.categories.cms',
                'keywords'    => 'flash message'
            ]
        ];
    }

    public function registerComponents()
    {
        return [
            'Romanov\Flashmessage\Components\FlashMessage' => 'flashmessage',
            'Romanov\Flashmessage\Components\FormError'    => 'formerrormessages'
        ];
    }
}
