<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
    <ul class="informations">
      <?php foreach ($informations as $information) { ?>
      <li><a style="color: #707070;" href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
      <?php } ?>
      <li><a style="color: #707070;" href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
      <li><a style="color: #707070;" href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
    </ul>
  </div>
</div>
