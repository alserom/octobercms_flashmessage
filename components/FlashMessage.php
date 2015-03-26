<?php namespace Romanov\Flashmessage\Components;

use Cms\Classes\ComponentBase;
use Romanov\Flashmessage\Models\Setting as FlashConfigur;

class FlashMessage extends ComponentBase
{
    public $conf_id;
    public $settings;
    public $options;
    public $flag = false;

    public function componentDetails()
    {
        return [
            'name'        => 'romanov.flashmessage::lang.plugin.name',
            'description' => 'romanov.flashmessage::lang.plugin.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'configuration' => [
                'title' => 'romanov.flashmessage::lang.settings.conftitle',
                'type' => 'dropdown',
                'default' => '',
                'showExternalParam' => false,
            ],
        ];
    }

    public function onRun() {
        $this->addJs('/plugins/romanov/flashmessage/assets/js/bootstrap-notify.min.js');
        $this->addJs('/plugins/romanov/flashmessage/assets/js/main.js');
        if($this->property('configuration')){
            $this->flag = true;
            $this->getParam();
        }
    }

    public function onShowFlashMsg(){
        $msg = \Flash::all();
        if($msg) {
            $res['msgs'] = $msg;
            if($this->property('configuration')) {
                $data = FlashConfigur::find($this->property('configuration'))->toArray();
                $conf = $this->combineSettings($data);
                $res['options'] = $conf['options'];
                $res['settings'] = $conf['settings'];
            }else{
                $res['options'] = [];
                $res['settings'] = [];
            }
            return $res;
        }
    }

    public function getConfigurationOptions()
    {
        $arr = FlashConfigur::lists('title', 'id');
        $arr[''] = '...';
        return $arr;
    }

    private function getParam(){
        $data = FlashConfigur::find($this->property('configuration'))->toArray();
        $conf = $this->combineSettings($data);
        $this->options = $conf['options'];
        $this->settings = $conf['settings'];
    }

    private function checkArray($array){
        $arr = array_where($array, function($key, $value)
        {
            if(is_array($value)){
                return $this->checkArray($value);
            }
            return !empty($value);
        });
        return $arr;
    }

    private function combineSettings($data){
        $res['options'] = $this->checkArray(json_decode($data['options'],true));
        $s = json_decode($data['settings'],true);
        $sp = json_decode($data['settingsplacement'],true);
        $so = json_decode($data['settingsoffset'],true);
        $sa = json_decode($data['settingsanimate'],true);
        $s['placement'] = $sp;
        $s['animate'] = $sa;
        if(!$s['offset']) $s['offset'] = $so;
        $res['settings'] = $this->checkArray($s);
        return $res;
    }

}