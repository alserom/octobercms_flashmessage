<?php namespace Romanov\Flashmessage\Components;

use Cms\Classes\ComponentBase;

class FormError extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'romanov.flashmessage::lang.formerror.title',
            'description' => 'romanov.flashmessage::lang.formerror.description'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun() {
        $this->addJs('/plugins/romanov/flashmessage/assets/js/formmode.js');
    }
}