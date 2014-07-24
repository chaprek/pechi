<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
 <div class="breadcrumb">
     <?php
            $w_bc_total = count($breadcrumbs);
            if ($w_bc_total > 0) {
                 $w_bc_last = $w_bc_total - 1;
                  foreach ($breadcrumbs as $i => $breadcrumb) { ?>
                  <?php if ($i == $w_bc_last) { break; } ?>
                  <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
                  <?php } ?>
             <?php echo $breadcrumbs[$w_bc_last]['separator']; ?><?php echo $breadcrumbs[$w_bc_last]['text']; ?>
      <?php } ?>
  </div>

<table style="border-collapse: collapse; margin-bottom: 20px;" border="0">
 <tr>
<td class="h1left"></td>
<td><h1 style="white-space: nowrap;"><?php echo $heading_title; ?></h1></td>
<td class="h1right"></td>
 </tr>
</table>

  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <p><?php echo $text_email; ?></p>
    <h2><?php echo $text_your_email; ?></h2>
    <div class="content">
      <table class="form">
        <tr>
          <td><?php echo $entry_email; ?></td>
          <td><input type="text" name="email" value="" /></td>
        </tr>
      </table>
    </div>
    <div class="buttons">
      <div class="left"><a href="<?php echo $back; ?>" class="button"><?php echo $button_back; ?></a></div>
      <div class="right">
        <input type="submit" value="<?php echo $button_continue; ?>" class="button" />
      </div>
    </div>
  </form>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>