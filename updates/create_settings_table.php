<?php namespace Romanov\Flashmessage\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSettingsTable extends Migration
{

    public function up()
    {
        Schema::create('romanov_flashmessage_settings', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 100)->unique();
            $table->text('options');
            $table->text('settings');
            $table->text('settingsplacement');
            $table->text('settingsoffset');
            $table->text('settingsanimate');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('romanov_flashmessage_settings');
    }

}
