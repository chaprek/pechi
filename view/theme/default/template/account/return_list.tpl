<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
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

  <?php if ($returns) { ?>
  <?php foreach ($returns as $return) { ?>
  <div class="return-list">
    <div class="return-id"><b><?php echo $text_return_id; ?></b> #<?php echo $return['return_id']; ?></div>
    <div class="return-status"><b><?php echo $text_status; ?></b> <?php echo $return['status']; ?></div>
    <div class="return-content">
      <div><b><?php echo $text_date_added; ?></b> <?php echo $return['date_added']; ?><br />
        <b><?php echo $text_order_id; ?></b> <?php echo $return['order_id']; ?></div>
      <div><b><?php echo $text_customer; ?></b> <?php echo $return['name']; ?></div>
      <div class="return-info"><a href="<?php echo $return['href']; ?>"><img src="catalog/view/theme/default/image/info.png" alt="<?php echo $button_view; ?>" title="<?php echo $button_view; ?>" /></a></div>
    </div>
  </div>
  <?php } ?>
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <?php } ?>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>