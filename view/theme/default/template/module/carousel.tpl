<!-- brands -->
					<div class="brands box">
						<div class="holder clearfix">
							<div class="left">бренды</div>
						</div>
						<div class="slider">
							<ul>
								<? $i = 0;?>
								<?php foreach ($banners as $banner) { ?>
									<? if($i == 0 || $i%2 == 0){?>
									<li>
										<div class="holder-brand box">
										<div class="brand-left block-brand">
											<a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" /></a>
										</div>
									<? }?>
									
									<? if(($i == count($banners) - 1) || $i%2 != 0){?>
										<div class="brand-right block-brand">
											<a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" /></a>
										</div>
										</div>
									</li>
									<? }?>
									<? $i++;?>
								<? }?>
							</ul>
						</div>
					</div>