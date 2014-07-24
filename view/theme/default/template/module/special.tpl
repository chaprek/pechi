<!-- action -->
					<div class="action">
						<div class="holder clearfix">
							<div class="left"><?php echo $heading_title; ?></div>
							<div class="right">
								<div class="current">1</div>
								<div class="slash">/</div>
								<div class="number-slides"></div>
							</div>
						</div>
						<div class="slider">
							<ul>
								<?php foreach ($products as $product) { ?>
									<li>
										<div class="holder-item">
											<div class="item">
												<?php if ($product['thumb']) { ?>
													<a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a>
												<?php } ?>
											</div>
											<div class="description">
												<div class="inner">
													<span><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></span>
													<strong>
														<?php if (!$product['special']) { ?>
															<?php echo $product['price']; ?>
														<?php } else { ?>
															<?php echo $product['special']; ?>
														<?php } ?>
													</strong>
												</div>
												<button onclick="addToCart('<?php echo $product['product_id']; ?>');">В корзину</button>
											</div>
										</div>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>