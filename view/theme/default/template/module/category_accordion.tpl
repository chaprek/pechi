<div class="box">
	<div class="box-heading-plus"><?php echo $heading_title; ?></div>
	<div class="box-content box-category-plus"><?php echo $category_accordion; ?></div>
</div>
<div class="categorybottom"></div>
<script type="text/javascript">
$(document).ready(function() {
	$('#cat_accordion').cutomAccordion({
		classExpand : 'custom_id<?php echo $category_accordion_cid; ?>',
		menuClose: false,
		autoClose: true,
		saveState: false,
		disableLink: false,		
		autoExpand: true
	});
});
</script>
