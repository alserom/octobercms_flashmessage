# Flash Message component
Display flash messages on front-end.  
The plugin integrates  [Bootstrap Notify](http://bootstrap-notify.remabledesigns.com)  v3.0.0 plugin (many thanks to the author for a wonderful plugin)! You can create your own configuration for the messages.
###Installation
Open the update panel and search the Romanov.Flashmessage plugin.

###Create own configuration for Flash message component  

Go to [Bootstrap Notify documentation page](http://bootstrap-notify.remabledesigns.com) and read it. Then open *Settings -> Flash message* on your backend and click *Add configuration*. Enter configuration name and  Bootstrap Notify options. Save configuration. Profit ;)  

###How to use  

The plugin has two components: flash message and form error message.

#####Flash message  

Show custom Flash messages on the website pages. This component can show ajax error messages and messages what been set by Components or inside the page or layout PHP section with the Flash class.  
Component use [Bootstrap Notify](http://bootstrap-notify.remabledesigns.com)  v3.0.0 plugin (many thanks to the author for a wonderful plugin)! So you can create own configuration for display message (see how in documentation tab).

#####Form error messages  
Displays ajax error processing forms on top of the input fields. Can be useful if part with input of your form looks some like this:
~~~
...
<div class="form-group">
        ...
        <input name="..." type="...">
</div>
...
~~~
This component does not have any settings, so if you like how component display errors onto your form you can use it.
Add component to your page or layout and choose configuration. Component without configuration will be displayed with default options.

###Important!
If you want display messages what been set with the Flash class don't use tags `{% flash %}` & `{% endflash %}` on page with this component.
