		<div id="hidden-basket" class="hidden-blocks">
			<div class="head"><h2><?php echo $heading_title; ?></h2></div>
			<!-- item-list -->
			

		<?php if ($products || $vouchers) { ?>
			<div class="items-list">
			<?php foreach ($products as $product) { ?>

				<div class="item clearfix">
					<div class="picture">
						<?php if ($product['thumb']) { ?>
						<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
						<?php } ?>
					</div>
					<div class="description">
						<div class="name"><?php echo $product['name']; ?></div>
						<div class="info">
							<div class="left">Цена:</div>
							<div class="right"><?php echo $product['total']; ?></div>
						</div>
						<a onclick="(getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') ? location = 'index.php?route=checkout/cart&remove=<?php echo $product['key']; ?>' : $('#cart').load('index.php?route=module/cart&remove=<?php echo $product['key']; ?>' + ' #cart > *');" class="close"></a>
					</div>
				</div>
			<?php } ?>

		</div>
			<!-- item-list -->
			<!-- order-info -->
			<div class="order-info">
				<div class="center">
					<?php foreach ($totals as $total) { ?>
						<div class="amount clearfix">
							<div class="left"><?php echo $total['title']; ?>:</div>
							<div class="right"><?php echo $total['text']; ?></div>
						</div>
					<?php } ?>
				</div>
				<!-- form -->
					<div class="width-box">
						<a class="basket-view" href="<?php echo $cart; ?>"><?php echo $text_cart; ?></a>
						<a class="ordering" href="<?php echo $checkout; ?>"><?php echo $text_checkout; ?></a>
					</div>
				<!-- form -->
			</div>
			<!-- order-info -->

		<?php } else { ?>
			<div class="empty"><?php echo $text_empty; ?></div>
		<?php } ?>


		</div>
