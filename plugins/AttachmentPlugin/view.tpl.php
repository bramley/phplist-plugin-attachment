<?php
/**
 * AttachmentPlugin for phplist
 * 
 * This file is a part of AttachmentPlugin.
 *
 * @category  phplist
 * @package   AttachmentPlugin
 * @author    Duncan Cameron
 * @copyright 2012-2013 Duncan Cameron
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License, Version 3
 */

/**
 * This is the HTML template for the plugin page
 *
 * Available fields
 * - formName: value to be used for the form name
 * - message: location of the attachment directory
 * - files: array of files in the attachment directory
 * - help: help link
 * - listing: CommonPlugin_Listing
 */

global $pagefooter;

$pagefooter[basename(__FILE__)] = <<<END
<script type="text/javascript">
$(document).ready(function() {
    $(".button").unbind('click');
    $(".button").click(function() {
        if ($('#attachments:checked').length == 0) {
            alert('Please select at least one checkbox');
            return false;
        }
        if (confirm('$confirm_prompt')) {
            document.$formName.submit();
        }
    });
}); 
</script>
END;
?>

<div>
	<hr>
	<a name='top'> </a>
<?php echo $toolbar; ?>
	<div>
<?php if (isset($deleteResult)):
    echo $deleteResult; ?>
    <br>
<?php endif; ?>
<?php echo $message; ?>
	</div>
	<div style='padding-top: 10px;' >
		<form name='<?php echo $formName; ?>' id='<?php echo $formName; ?>' method='post' action='<?php echo htmlspecialchars($action); ?>' >
<?php echo $listing; ?>
		</form>
	</div>
	<p><a href='#top'>[<?php echo $this->i18n->get('top'); ?>]</p>
</div>
