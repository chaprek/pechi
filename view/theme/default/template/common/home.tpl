<?php echo $header; ?><?php // echo $column_left; ?><?php echo $column_right; ?>


			<div class="content">
				<div class="center">
					<h1>Интернет магазин “Печи тут”</h1>
					<!-- list -->
					<div class="list">

						<?php if ($categories) { ?>
										<?php foreach ($categories as $category) { ?>
										<a href="<?= $category['href']; ?>" class="clearfix box">
											<div class="width-box">
												<div class="picture">
													<img src="image/<?= $category['image']; ?>" alt=""/>
												</div>
												<div class="description"><?= $category['name']; ?></div>
											</div>
										</a>
										<?php } ?>
								<?php } ?>
					</div>
					<!-- list -->
					<?php echo $content_top; ?>
					<?php echo $content_bottom; ?>
				</div>

			</div>
<!-- <h1 style="display: none;"><?php echo $heading_title; ?></h1> -->

<?php echo $footer; ?>