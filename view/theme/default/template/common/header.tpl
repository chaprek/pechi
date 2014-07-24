<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
	<meta charset="UTF-8">
	<meta content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width" name="viewport">
	<meta content="yes" name="apple-mobile-web-app-capable"/>
	<meta content="telephone=no" name="format-detection"/>
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
	
<base href="<?php echo $base; ?>" />
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="catalog/view/theme/default/stylesheet/mobile/main.css">

<!-- <script type="text/javascript" src="catalog/view/theme/default/js/styleform.js"></script> -->

</head>
<body>
	<div id="wrapper">
		<!-- hidden-menu -->
		<div id="hidden-menu" class="hidden-blocks">
			<div class="inner">
				<div class="head"><h2>меню</h2></div>
				<nav>
					<li>
						<div class="accordion">
							<div class="link-name">каталог товаров</div>
							<div class="inner-body"> 
								<?php if ($categories) { ?>
										<?php foreach ($categories as $category) { ?>
											<a href="<?= $category['href']; ?>" <?= ($category['active'])?'class="active"':'' ?>><?= $category['name']; ?></a>
										<?php } ?>
								<?php } ?>
							</div>
						</div>
					</li>
					<li>
						<div class="accordion">
							<div class="link-name">производители</div>
						</div>
					</li>
					<li>
						<div class="accordion">
							<div class="link-name">акции</div>
						</div>
					</li>
					<li>
						<div class="accordion">
							<div class="link-name">бесплатная доставка</div>
						</div>
					</li>
					<li>
						<div class="accordion">
							<div class="link-name">монтаж</div>
						</div>
					</li>
					<li>
						<div class="accordion">
							<div class="link-name">контакты</div>
						</div>
					</li>
				</nav>
					<div class="width-box">

						<?php if (!$logged) { ?>
							<?php //echo $text_welcome; ?>
							<a href="http://pechi-tut.ru/index.php?route=account/login" class="enter-cabinet" >Войти</a>
							<a href="http://pechi-tut.ru/index.php?route=account/simpleregister" class="registration" >Регистрация</a>
						<?php } else { ?>
							<?php echo $text_logged; ?>
						<?php } ?>
					</div>
			</div>
		</div>
		<!-- hidden-menu -->
		<!-- hidden-contacts -->
		<div id="hidden-contacts" class="hidden-blocks">
			<div class="head"><h2>наши контакты</h2></div>
			<nav>
				<li>
					<a href="">
						<div class="icon phone"></div>
						<div class="info clearfix">+7 (495) 542-63-79</div>
					</a>
				</li>
				<li>
					<a href="">
						<div class="icon phone"></div>
						<div class="info clearfix">+7 (495) 542-63-79</div>
					</a>
				</li>
				<li>
					<a href="">
						<div class="icon mail"></div>
						<div class="info clearfix">INFO@PECHI-TUT.RU</div>
					</a>
				</li>
				<li>
					<a href="" class="simple">
						<div class="icon address"></div>
						<div class="info clearfix">
							<span>Москва, 41км МКАД, ТОГК "Славянский Мир", Павильон Г17/3</span>
						</div>
					</a>
				</li>
				<li>
					<a href="index.php?route=information/contact">
						<div class="icon scheme"></div>
						<div class="info clearfix">СХЕМА ПРОЕЗДА</div>
					</a>
				</li>
				<li>
					<a href="" class="simple">
						<div class="icon clock"></div>
						<div class="info clearfix">
							<span>Ежедневно с 8.30 - 19:00</span>
						</div>
					</a>
				</li>
			</nav>
		</div>
		<!-- hidden-contacts -->
		<!-- hidden-cart -->
		<?php echo $cart; ?>
		<!-- hidden-cart -->
		<!-- #page -->
		<div id="page">
			<header class="clearfix">
				<div class="center">
					<div class="left">
						<a href="" class="menu"></a>
						<a href="" class="phone"></a>
					</div>
					<a href="<?php echo $home; ?>" class="logo"></a>
					</a>
					<div class="right">
						<a href="" id="search" class="search"></a>
						<a href="" class="basket"></a>
					</div>
				</div>
			</header>
			<!-- hidden search -->
			<div id="hidden-search">
				<div class="center">
					<form action="">
						<div class="width-box">
							<div class="holder">
								<a href="" class="search-icon button-search"></a>
								<?php if ($filter_name) { ?>
								<input type="text" name="filter_name" value="<?php echo $filter_name; ?>" />
								<?php } else { ?>
								<input type="text" name="filter_name" placeholder="<?php echo $text_search; ?>" onclick="this.value = '';" onkeydown="this.style.color = '#000000';" />
								<?php } ?>
								<a href="" class="close-icon"></a>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- hidden search -->

<div id="notification"></div>
