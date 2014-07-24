<?php if (count($products)) { ?>
<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
    <div class="box-product-imageforviewed" style="text-align: left;">
      <?php foreach ($products as $product) { ?>
      <div style="margin: 2px 0px 2px 6px; padding: 2px;">
        <?php if ($product['thumb']) { ?>
        <div class="imageforviewed"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a></div>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php } ?>