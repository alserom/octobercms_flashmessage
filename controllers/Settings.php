<?php namespace Romanov\Flashmessage\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

class Settings extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Romanov.Flashmessage', 'flashmessage', 'settings');
    }




}