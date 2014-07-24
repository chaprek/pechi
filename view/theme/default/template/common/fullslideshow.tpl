 <?php if(($this->config->get('polianna_status') == '1') && ( $this->config->get('polianna_slideshow') == '1')){	?>
  
    <div class="camera_wrap<?php echo $module; ?>">
        <?php foreach ($banners as $banner) { ?>
            <?php if ($banner['link']) { ?>
            	<div data-src="<?php echo $banner['image']; ?>" data-link="<?php echo $banner['link']; ?>"></div>
            <?php } else { ?>
            	<div data-src="<?php echo $banner['image']; ?>"></div>
            <?php } ?>
        <?php } ?>
    </div>

<script type="text/javascript"><!--
$(document).ready(function() {
	$('.camera_wrap<?php echo $module; ?>').camera({
		loader:'none',
		height:'30%'
	});
});
--></script>


 <?php } else { ?>
<div class="maximage_arrow" >
<a href="" id="arrow_left"></a>
<a href="" id="arrow_right"></a>
</div>


<img id="cycle-loader" src="catalog/view/theme/polianna/image/ajax-loader.gif" />
<div id="maximage">

<?php foreach ($banners as $banner) { ?>
     <div>
          
           <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>"  />

       </div>         
  <?php } ?>
</div>

<script type="text/javascript" charset="utf-8">
		$(function(){
				$('#maximage').maximage({
					cycleOptions: {
						fx:'fade',
						speed:5000, // Has to match the speed for CSS transitions in jQuery.maximage.css (lines 30 - 33)
						timeout:1000,
						prev:'#arrow_left',
						next:'#arrow_right',
						pause:1,
						
					},
					onFirstImageLoaded: function(){
						jQuery('#cycle-loader').hide();
						jQuery('#maximage').fadeIn('fast');
					}
						
				});
			
				
			});

</script>


 <?php } ?>
