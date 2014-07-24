<?php ?>
<div class="box">
  <div class="box-heading"><span><?php echo $heading_title; ?></span></div>
  <div class="box-content" style="padding-bottom: 15px;">
    <?php foreach ($categories as $category) { ?>
    <a class="Alphabit" href="<?php echo $href; ?>#<?php echo $category['name']; ?>"><?php echo $category['name']; ?></a>
    <?php } ?>
  </div>
</div>
