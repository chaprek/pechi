<div id="footer">

<a class="Up" title="BBEPX" alt="BBEPX" href="javascript://" id="toTop"><img src="catalog/view/theme/default/image/up.png"><br /></a>
<script> 
 $(window).scroll(function(){ 
  if($(window).scrollTop()){ 

  } 
}); 
 $('#toTop').click(function(){ 
  $('html, body').animate({scrollTop:0}, 350); 
}); 
</script>

  <?php if ($informations) { ?>
  <div class="column">
    <h3><?php echo $text_information; ?></h3>
    <ul>
      <?php foreach ($informations as $information) { ?>
      <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
  <?php } ?>
  <div class="column">
    <h3><?php echo $text_service; ?></h3>
    <ul>
      <li><a href="<?php echo $contact; ?>">Схема проезда</a></li>
      <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
      <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
    </ul>
  </div>
  <div class="column">
    <h3><?php echo $text_account; ?></h3>
    <ul>
      <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
      <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
      <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
      <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
    </ul>
  </div>
  <div class="column">
    <h3><?php echo $text_extra; ?></h3>
    <ul>
      <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
      <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
      <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
      <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
    </ul>
  </div>
<div id="footer2">
  <div class="columnCART">
    <h3 style="width: 424px;"><?php echo $text_weonthemap; ?></h3>

<!--------------------------------------- КАРТА ---------------------------------------->

<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=UV-68SIIgJXYfWl3t3hVQ-4fLKRvuky7&width=424&height=205"></script>

<!--------------------------------------- КАРТА ---------------------------------------->
<style>.ymaps-copyrights-logo {opacity: 0;display: none;}.ymaps-copyrights-legend {opacity: 0;display: none;}.ymaps-map {background: none;}.ymaps-image {}</style>
  </div>


  <div class="column">
    <h3><?php echo $text_contacts; ?></h3>


<!-----------------------	КОНТАКТЫ (НАЧАЛО)	------------------------->

<img style="vertical-align: middle;" src="image/footer/homephone.png" title="Стационарный телефон"> +7 (495) 542-63-79<br>

<img style="vertical-align: middle;" src="image/footer/mobilephone.png" title="Мобильный телефон"> +7 (910) 081-97-67<br>

<img style="vertical-align: middle;" src="image/footer/email.png" title="Почта">&nbsp;&nbsp;<a href="mailto:info@pechi-tut.ru">info@pechi-tut.ru</a><br>

<img style="vertical-align: middle; padding-right: 4px;margin-left: 2px;margin-bottom: 2px;" src="image/footer/address.png" title="Адрес">&nbsp;&nbsp;Адрес: Москва, 41 км МКАД, ТОГК "Славянский Мир", Павильон Г17/3<br>

<!-----------------------	КОНТАКТЫ (КОНЕЦ)	-------------------------->


    <h3 style="margin-top: 15px;"><?php echo $text_weinsocialnetworks; ?></h3>



<!-----------------------	 СОЦИАЛЬНЫЕ СЕТИ (НАЧАЛО)	------------------->

	<a class="ShareF" href="https://www.facebook.com/pechitut" target="_blank" title="Facebook"></a>
	<a class="ShareT" href="https://twitter.com/pechitut" target="_blank" title="Twiter"></a>
	<a class="ShareV" href="" target="_blank" title="Вконтакте"></a>
	<a class="ShareO" href="http://www.youtube.com/user/pechitut" target="_blank" title="YouTube"></a>
	<a class="ShareG" href="https://plus.google.com/u/0/b/105522138477918526505/+PechitutRus/about" target="_blank" title="Google +" ></a>

<!-----------------------	 СОЦИАЛЬНЫЕ СЕТИ (КОНЕЦ)	-------------------->
 </div>



  <div class="column">
    <h3><?php echo $text_aboutus; ?></h3>
<p style="text-align: justify; width: 190px; color: #747474;">
<img src="image/minimalism_footer.png"><br>


<!-----------------------	ОПИСАНИЕ (НАЧАЛО)	-------------------------->
Наш магазин открылся в 2013 году и по сей день радует своих клиентов, большим выбором и качеством товаров. Опытные консультанты с радостю помогут вам определиться с выбором.<br>

<img style="vertical-align: middle; padding: 5px 5px 5px 0;" src="image/footer/clock.png" title="Часы работы"><b style="color: #000;"> Ежедневно с 8.30 - 19:00</b>
<!-----------------------	ОПИСАНИЕ (КОНЕЦ)	--------------------------->


</p>
  </div>
</div>
</div>
<!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->
<div id="powered"><?php echo $powered; ?></div>
<!--
OpenCart is open source software and you are free to remove the powered by OpenCart if you want, but its generally accepted practise to make a small donation.
Please donate via PayPal to donate@opencart.com
//-->
</div>
<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=24260023&amp;from=informer"
target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/24260023/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:24260023,lang:'ru'});return false}catch(e){}"/></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter24260023 = new Ya.Metrika({id:24260023,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/24260023" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body></html>