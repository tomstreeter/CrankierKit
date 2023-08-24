
<!DOCTYPE html>
<html lang="en">
<?php
use Kirby\Cms;
/**
 * Call the <head> snippet that has three optional slots:
 *   1.  $custom_head_meta
 *   2.  $custom_head_links
 *   3.  $custom_head_title
 */
snippet('layout/head', slots: true);
// Check for an incoming custom_head_meta slot
if ($custom_head_meta = $slots->custom_head_meta()) :
	// Pass the slot content along to the <head> snippet 
	slot('custom_head_meta');
		echo $custom_head_meta;
	endslot();
endif;
// Repeat logic for custom_head_links and custom_head_title

if ($custom_head_links = $slots->custom_head_links()) :
	slot('custom_head_links');
		echo $custom_head_links;
	endslot();
endif;
if ($custom_head_title = $slots->custom_head_title()) :
	slot('custom_head_title');
		echo $custom_head_title;
	endslot();
endif;
endsnippet();
/**
 * An array of strings that will set the class attributes of the respective landmark HTML elements within the snippet. Set to an empty string by default.
 * @var array
 */
$landmarkClasses = [
	'bodyClasses' => $bodyClasses = ($bodyClasses ?? ''),
	'headerClasses' => $headerClasses = ($headerClasses ?? ''),
	'navClasses' => $navClasses = ($navClasses ?? ''),
	'mainClasses' => $mainClasses = ($mainClasses ?? ''),
	'footerClasses' => $footerClasses = ($footerClasses ?? ''),
];
?>
<body id="<?= $page->intendedTemplate(); ?>-<?= $page->slug(); ?>" 
<?php e($bodyClasses != '', 'class="' . $bodyClasses . '"'); ?>
> 
<?php
	if ($customBody = $slots->customBody()) :
		echo $customBody;
	else :
		if ($customHeader = $slots->customHeader()) :
			echo $customHeader;
		else :
			snippet('layout/header', ['headerClasses' => $headerClasses = ($headerClasses ?? ''), 'navClasses' => $navClasses = ($navClasses ?? '')], slots: true);
			endsnippet();
		endif;
		if ($customMain = $slots->customMain()) :
			echo $customMain;
		else :
			snippet('layout/main', ['mainClasses' => $mainClasses = ($mainClasses ?? '')], slots: true);;
			endsnippet();
		endif;
		if ($customFooter = $slots->customFooter()) :
			echo $customFooter;
		else :
			snippet('layout/footer', ['footerClasses' => $footerClasses = ($footerClasses ?? '')], slots: true);;
			endsnippet();
		endif;
	endif;
	?>
</body>
</html>
