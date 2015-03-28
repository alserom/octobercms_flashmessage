<?php namespace Romanov\Flashmessage\Models;

use Model;
use Lang;
class Setting extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = 'romanov_flashmessage_settings';
    public $rules = [
        'title' => 'required',
    ];
    public $attributeNames;
    protected $guarded = ['*'];

    protected $fillable = [];
    protected $jsonable = ['options','settings','settingsplacement','settingsoffset','settingsanimate'];

    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function __construct()
    {
        $this->attributeNames = [
            'title' => '"'.Lang::get('romanov.flashmessage::lang.settings.name').'"',
        ];
        parent::__construct();
    }

}