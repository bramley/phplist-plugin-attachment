<?php
/**
 * AttachmentPlugin for phplist
 * 
 * This file is a part of AttachmentPlugin.
 *
 * @category  phplist
 * @package   AttachmentPlugin
 * @author    Duncan Cameron
 * @copyright 2012-2015 Duncan Cameron
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License, Version 3
 */

/**
 * This file contains the English help text
 */
?>
<p>
This plugin displays rows from the attachment table. Each row refers to a file that is attached, or has been attached, to a campaign. If a file is detached from a campaign, phplist does not remove the row from the attachment table nor delete the file from the file system. </p>
<p>It is safe to delete rows from the attachment table that refer to files that are no longer attached to campaigns, and to delete the files from the file system. If you attach the same file again then phplist will create a new row in the attachment table; it does not re-use an existing row.</p>
<p>When attaching a file to a campaign phplist copies the file and renames it by adding a suffix. A 0-byte length file with that new name and an empty file extension is also created.</p>
<table>
<tr>
<td>Repository</td>
<td>The location of the attachment repository, from config.php.</td>
</tr>
<tr>
<td>ID</td>
<td>The ID of the row in the attachment table.</td>
</tr>
<tr>
<td>File</td>
<td>The name of the file in the attachment repository directory.</td>
</tr>
<tr>
<td>MIME type</td>
<td>The mime type of the file.</td>
</tr>
<tr>
<td>Size</td>
<td>The size of the file in bytes.</td>
</tr>
<tr>
<td>Status</td>
<td>An attachment icon <image src='./?page=image&pi=CommonPlugin&image=attach.png'> indicates that the file exists in the attachment repository. An email icon <image src='./?page=image&pi=CommonPlugin&image=email.png'> indicates that the campaign exists.</td>
</tr>
<tr>
<td>Select</td>
<td>Only those attachments that are no longer attached to a campaign can be selected.</td>
</tr>
<tr>
<td>Description</td>
<td>The description added when the file was attached to a campaign.</td>
</tr>
<tr>
<td>Remote file</td>
<td>The name of the remote file that was added.</td>
</tr>
<tr>
<td>Campaign</td>
<td>The ID and subject of the campaign to which the file is attached. If the file is no longer attached to a campaign then this field is not displayed.</td>
</tr>
<tr>
<td>Delete Selected button</td>
<td>The plugin will delete the selected rows from the attachment table. It will also delete the associated file and 0-byte file from the file system.</td>
</tr>
</table>
