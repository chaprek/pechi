<?php
//-----------------------------------------------------
// News Module for Opencart v1.5.5  v3.2 							
// Modified by villagedefrance                          			
// contact@villagedefrance.net                         			
//-----------------------------------------------------
?>

<?php if ($news) { ?>
<?php if($box) { ?>
	<div class="box">
		<div class="box-heading">
			<?php if($icon) { ?>
				<div style="float: left; margin-right: 8px;"><img src="catalog/view/theme/default/image/message.png" alt="" /></div>
			<?php } ?>
			<?php if($customtitle) { ?>
				<?php echo $customtitle; ?>
			<?php } ?>
		</div>
		<div class="box-content">
		<?php foreach ($news as $news_story) { ?>
			<div class="box-news">
				<?php if ($show_headline) { ?>
					<h4><?php echo $news_story['title']; ?></h4>
				<?php } ?>
				<p><a href="<?php echo $news_story['href']; ?>"><img src="catalog/view/theme/default/image/message-news.png" alt="" /></a> 
				<span style="color: #990000;"><?php echo $news_story['posted']; ?></span>
				</p>
				<p style="color: #707070;"><?php echo $news_story['description']; ?> .. <br /></p>
				<p style="text-align: right;"><a style="color: #404040;" href="<?php echo $news_story['href']; ?>"> <?php echo $text_more; ?></a></p>
			</div>
		<?php } ?>
		<?php if($showbutton) { ?>
			<div style="text-align:right;">
				<a href="<?php echo $newslist; ?>" class="button"><span><?php echo $buttonlist; ?></span></a>
			</div>
		<?php } ?>
		</div>
	</div>
<?php } else { ?>
	<div style="margin-bottom:10px;">
		<?php foreach ($news as $news_story) { ?>
			<div class="box-news">
				<?php if ($show_headline) { ?>
					<h4><?php echo $news_story['title']; ?></h4>
				<?php } ?>
				<p><a href="<?php echo $news_story['href']; ?>"><img src="catalog/view/theme/default/image/message-news.png" alt="" /></a> 
				<span style="color: #990000;"><?php echo $news_story['posted']; ?></span>
				</p>
				<p style="color: #707070;"><?php echo $news_story['description']; ?> .. <br /></p>
				<p style="text-align: right;"><a style="color: #404040;" href="<?php echo $news_story['href']; ?>"> <?php echo $text_more; ?></a></p>
			</div>
		<?php } ?>
		<?php if($showbutton) { ?>
			<div style="text-align:right;">
				<a href="<?php echo $newslist; ?>" class="button"><span><?php echo $buttonlist; ?></span></a>
			</div>
		<?php } ?>
	</div>
<?php } ?>
<?php } ?>