## Overview and Help

  * Managing Inline Help
  * Robot Text files
  * CSS Changes

---

### Managing inline help


Via github you can find a file and edit it and click save.

Every file you want to edit is in the app/views folder
For example if you wanted to edit the Settings form you would look in

~~~
app/views/settings
~~~

and find the edit file or index file.

In those files will be 1 place that you know are save to edit. That place will be inside this class

~~~
<div class="help-block">Some text here</div>
~~~

So it is save to edit that text.

Finally make a comment on the form and click save and your code is not part of the code base.



### Robot Text and Maintenance mode

There is a robot.txt file in the public folder that is made by the system. You can optimize the robot.txt.allow and robot.txt.block file right in the github repo. Those will be saved.

As you edit Settings and put the site in maintenance mode it will copy one of those files over the robots.txt file. 



### CSS Changes 

Coming soon...


### Setup

  * bower
  * gulp
  * composer

