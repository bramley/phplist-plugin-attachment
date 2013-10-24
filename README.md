# Manage Attachments Plugin #

## Description ##

The plugin allows you to delete attachments that are no longer used.

## Installation ##

### Dependencies ###

Requires php version 5.2 or later.

Requires the Common Plugin to be installed. 

See <https://github.com/bramley/phplist-plugin-common>

### Set the plugin directory ###
You can use a directory outside of the web root by changing the definition of `PLUGIN_ROOTDIR` in config.php.
The benefit of this is that plugins will not be affected when you upgrade phplist.

### Install through phplist ###
Install on the Plugins page (menu Config > Plugins) using the package URL `https://github.com/bramley/phplist-plugin-attachment/archive/master.zip`.

### Install manually ###
Download the plugin zip file from <https://github.com/bramley/phplist-plugin-attachment/archive/master.zip>

Expand the zip file, then copy the contents of the plugins directory to your phplist plugins directory.
This should contain

* the file AttachmentPlugin.php
* the directory AttachmentPlugin

## Version history ##

    version     Description
    2013-10-18  Initial version for phplist 3.0 converted from 2.10 version
    2013-10-24  Added to GitHub
