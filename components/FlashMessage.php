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
        if (!is_array($data['options'])) {
            $data['options'] = json_decode($data['options'],true);
        }
        if (!is_array($data['settings'])) {
            $data['settings'] = json_decode($data['settings'],true);
        }
        if (!is_array($data['settingsplacement'])) {
            $data['settingsplacement'] = json_decode($data['settingsplacement'],true);
        }
        if (!is_array($data['settingsoffset'])) {
            $data['settingsoffset'] = json_decode($data['settingsoffset'],true);
        }
        if (!is_array($data['settingsanimate'])) {
            $data['settingsanimate'] = json_decode($data['settingsanimate'],true);
        }
        $res['options'] = $this->checkArray($data['options']);
        $s = $data['settings'];
        $sp = $data['settingsplacement'];
        $so = $data['settingsoffset'];
        $sa = $data['settingsanimate'];
        $s['placement'] = $sp;
        $s['animate'] = $sa;
        if(!$s['offset']) $s['offset'] = $so;
        $res['settings'] = $this->checkArray($s);
        return $res;
    }

}
