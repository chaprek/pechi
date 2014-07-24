<?php

class ControllerFeedSoforpFastSitemap extends Controller {
    protected function log( $message ){
        file_put_contents(DIR_LOGS . $this->config->get("config_error_filename") , date("Y-m-d H:i:s - ") . "SOFORP FastSitemap " . $message . "\r\n", FILE_APPEND );
    }

    protected function getProductsCount(){

        $sql = "select count(p.product_id) as `cnt` from `" . DB_PREFIX . "product` p ";
        if( "1" == $this->multistore_status ){
            $sql .= " inner join product_to_store ps on (p.product_id = ps.product_id) ";
        }
        $sql .= " WHERE p.status=1 ";
        if( "1" == $this->multistore_status ){
            $sql .= " and ps.store_id = " . (int)$this->store_id;
        }

        $query = $this->db->query($sql);
        if(!$query->rows)
            return 0;

        return (int)$query->rows[0]["cnt"];
    }


    protected function getInformation() {

        $output = '';

        $begin = microtime(true);
        $this->log("Генерация информации стартовала!" );

        $sql = "select i.information_id from `" . DB_PREFIX . "information` i";
        if( "1" == $this->multistore_status ){
            $sql .= " inner join information_to_store `is` on (i.information_id = `is`.information_id) ";
        }
        $sql .= " where i.status=1 ";
        if( "1" == $this->multistore_status ){
            $sql .= " and `is`.store_id = " . (int)$this->store_id;
        }
        $informations = $this->db->query($sql);
        foreach ($informations->rows as $information) {
            $output .= "<url>\n";

            if( "0" != $this->seo_status ) {
                $output .= "\t<loc>" . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('information/information', 'information_id=' . $information['information_id']))) . "</loc>\n";
            } else {
                $output .= "\t<loc>" . $this->store_host . "index.php?route=information/information&amp;information_id=" . $information['information_id'] . "</loc>\n";
            }
            $output .= "\t<changefreq>weekly</changefreq>\n";
            $output .= "\t<priority>0.5</priority>\n";
            $output .= "</url>\n";
        }

        $this->log("Генерация информации выполнена за " . round(microtime(true) - $begin,3) . " сек" );

        return $output;
    }

    protected function getManufacturers() {

        $output = '';

        $begin = microtime(true);
        $this->log("Генерация производителей стартовала!" );


        $sql = "select m.manufacturer_id from `" . DB_PREFIX . "manufacturer` m ";
        if( "1" == $this->multistore_status ){
            $sql .= " inner join manufacturer_to_store ms on (m.manufacturer_id = ms.manufacturer_id) where ms.store_id = " . (int)$this->store_id;
        }

        $manufacturers = $this->db->query($sql);
        foreach ($manufacturers->rows as $manufacturer) {
            $output .= "<url>\n";

            if( "0" != $this->seo_status ) {
                $output .= "\t<loc>" . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer['manufacturer_id']))) . "</loc>\n";
            } else {
                $output .= "\t<loc>" . $this->store_host . "index.php?route=product/manufacturer/info&amp;manufacturer_id=" . $manufacturer['manufacturer_id'] . "</loc>\n";
            }
            $output .= "\t<changefreq>weekly</changefreq>\n";
            $output .= "\t<priority>0.7</priority>\n";
            $output .= "</url>\n";
        }

        $this->log("Генерация производителей выполнена за " .  ( round(microtime(true) - $begin,3) ) . " сек" );

        return $output;
    }

    protected function getBlog()
    {
        $output = '';

        if( 0 == $this->blog_status ) {
            $this->log("Генерация блога отключена!" );
            return '';
        }

        $begin = microtime(true);
        $this->log("Генерация блога стартовала!" );

        if( 1 == $this->blog_status ) {
            $this->getChild('common/seoblog');
            $output .= $this->getBlogCategories_OcCms(0);
            $output .= $this->getBlogRecords_OcCms();
        }

        if( 2 == $this->blog_status ){
            $output .= $this->getBlogCategories_PavBlog();
            $output .= $this->getBlogRecords_PavBlog();
        }

        $this->log("Генерация блога выполнена за " . round(microtime(true) - $begin,3) . " сек" );

        return $output;
    }

    protected function getBlogCategories_PavBlog()
    {
        $output  = '';

        $sql = "SELECT c.category_id as blog_id FROM " . DB_PREFIX . "pavblog_category c ";
        $sql .= " WHERE c.published = '1' ";
        if( "1" == $this->multistore_status ){
            $sql .= " AND c.store_id = " . (int)$this->store_id;
        }
        $results = $this->db->query($sql);

        foreach ($results->rows as $blog) {
            if( 1 == (int)$blog['blog_id'] )
                continue;
            $output .= "<url>\n";
            $output .= "\t<loc>" . $this->store_host . "index.php?route=pavblog/category&amp;id=" . $blog['blog_id'] . "</loc>\n";
            $output .= "\t<changefreq>weekly</changefreq>\n";
            $output .= "\t<priority>0.7</priority>\n";
            $output .= "</url>\n";

        } //$results as $result
        return $output;
    }

    protected function getBlogRecords_PavBlog()
    {
        $output  = '';

        $sql = "SELECT r.blog_id as record_id, r.date_modified FROM " . DB_PREFIX . "pavblog_blog r ";
        if( "1" == $this->multistore_status ){
            $sql .= " inner join pavblog_category c on (r.category_id = c.category_id) ";
        }
        $sql .= " WHERE r.status = '1' ";
        if( "1" == $this->multistore_status ){
            $sql .= " and c.store_id = " . (int)$this->store_id;
        }
        $results = $this->db->query($sql);

        foreach ($results->rows as $record) {
            $output .= '<url>';
            $output .= "\t<loc>" . $this->store_host . "index.php?route=pavblog/blog&amp;id=" . $record['record_id'] . "</loc>\n";
            $output .= "\t<lastmod>" . substr( $record['date_modified'], 0, 10) . "</lastmod>\n";
            $output .= "\t<changefreq>weekly</changefreq>\n";
            $output .= "\t<priority>1.0</priority>\n";
            $output .= "</url>\n";
        }

        return $output;
    }

    protected function getBlogCategories_OcCms($parent_id, $current_path = '')
    {
        $output  = '';

		$sql = "SELECT b.blog_id, b.date_added, b.date_modified FROM " . DB_PREFIX . "blog b ";
        if( "1" == $this->multistore_status ){
            $sql .= " inner join blog_to_store bs on (b.blog_id = bs.blog_id) ";
        }
        $sql .= " WHERE b.parent_id = '" . $parent_id . "' AND b.status = '1' AND b.customer_group_id = '" . (int)$this->customer_group_id. "'";
        if( "1" == $this->multistore_status ){
            $sql .= " and bs.store_id = " . (int)$this->store_id;
        }
        $results = $this->db->query($sql);

        foreach ($results->rows as $blog) {
            if (!$current_path) {
                $new_path = $blog['blog_id'];
            } else {
                $new_path = $current_path . '_' . $blog['blog_id'];
            }
            $output .= "<url>\n";
            if( "0" != $this->seo_status ) {
                $output .= "\t<loc>" . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('record/blog', 'blog_id=' . $new_path))) . "</loc>\n";
            } else {
                $output .= "\t<loc>" . $this->store_host . "index.php?route=record/blog&amp;blog_id=" . $blog['blog_id'] . "</loc>\n";
            }

            $output .= "\t<lastmod>" . substr(max($blog['date_added'], $blog['date_modified']), 0, 10) . "</lastmod>\n";
            $output .= "\t<changefreq>weekly</changefreq>\n";
            $output .= "\t<priority>0.7</priority>\n";
            $output .= "</url>\n";
            $output .= $this->getBlogCategories_OcCms($blog['blog_id'], $new_path);
        } //$results as $result
        return $output;
    }

    protected function getBlogRecords_OcCms()
    {
        $output  = '';

        $sql = "SELECT r.record_id, r.date_modified, r.date_available FROM " . DB_PREFIX . "record r ";
        if( "1" == $this->multistore_status ){
            $sql .= " inner join record_to_store rs on (r.blog_id = rs.blog_id) ";
        }
        $sql .= " WHERE r.status = '1' AND r.customer_group_id = '" . (int)$this->customer_group_id. "' AND NOW() BETWEEN r.date_available AND r.date_end ";
        if( "1" == $this->multistore_status ){
            $sql .= " and rs.store_id = " . (int)$this->store_id;
        }
        $results = $this->db->query($sql);

        foreach ($results->rows as $record) {
            $output .= "<url>\n";
            if( "0" != $this->seo_status ) {
                $output .= "\t<loc>" . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('record/record', 'record_id=' . $record["record_id"]))) . "</loc>\n";
            } else {
                $output .= "\t<loc>" . $this->store_host . "index.php?route=record/record&amp;record_id=" . $record['record_id'] . "</loc>\n";
            }

            $output .= "\t<lastmod>" . substr(max($record['date_available'], $record['date_modified']), 0, 10) . "</lastmod>\n";
            $output .= "\t<changefreq>weekly</changefreq>\n";
            $output .= "\t<priority>1.0</priority>\n";
            $output .= "</url>\n";
        }

        return $output;
    }

    protected function getCategories($parent_id, $current_path = '') {

        $output = '';

        if( 0 == $parent_id) {
            $begin = microtime(true);
            $this->log("Генерация категорий стартовала!" );
        }

        $sql = "SELECT c.category_id, c.date_added, c.date_modified FROM " . DB_PREFIX . "category c ";
        if( "1" == $this->multistore_status ){
            $sql .= " inner join category_to_store cs on (c.category_id = cs.category_id) ";
        }
        $sql .= " WHERE c.parent_id = '" . $parent_id . "' AND c.status = '1' ";
        if( "1" == $this->multistore_status ){
            $sql .= " and cs.store_id = " . (int)$this->store_id;
        }
        $results = $this->db->query($sql);


        foreach ($results->rows as $category) {
            if (!$current_path) {
                $new_path = $category['category_id'];
            } else {
                $new_path = $current_path . '_' . $category['category_id'];
            }

            $output .= "<url>\n";
            if( "0" != $this->seo_status ) {
                $output .= "\t<loc>" . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('product/category', 'path=' . $new_path))) . "</loc>\n";
            } else {
                $output .= "\t<loc>" . $this->store_host . "index.php?route=product/category&amp;category_id=" . $category['category_id'] . "</loc>\n";
            }
            $output .= "\t<lastmod>" . substr(max($category['date_added'], $category['date_modified']), 0, 10) . "</lastmod>\n";
            $output .= "\t<changefreq>weekly</changefreq>\n";
            $output .= "\t<priority>0.7</priority>\n";
            $output .= "</url>\n";

            $output .= $this->getCategories($category['category_id'], $new_path);
        }

        if( 0 == $parent_id) {
            $this->log("Генерация категорий выполнена за " . round(microtime(true) - $begin,3) . " сек" );
        }

        return $output;
    }

    protected function getProduct($product){
        $output = "";

        $output .= "<url>\n";

        $this->registry->set("product_keyword_cache",1);

        if( "2" == $this->seo_status ) { // оптимизация для seo_url
            $this->registry->set("product_keyword_empty",($product["keyword"] ? 0 : 1 ));
            $this->registry->set("product_keyword",$product["keyword"]);
            $this->registry->set("product_vqmod_patch", 0 );
            $output .= "\t<loc>" . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('product/product', 'product_id=' . $product['product_id']))) . "</loc>\n";
            if( "0" == $this->registry->get("product_vqmod_patch") ) {
                $this->log("ERROR! Патч seo_url не работает!" );
                // exit();
            }
        } else if( "1" == $this->seo_status ) { // оптимизация для seo_pro
            if( isset($product["main_category_id"]) ) {
                $category_id = $product["main_category_id"];
                //$this->log("Используем главную категорию товара: $category_id");
            } else if( isset($product["slave_category_id"]) ) {
                $category_id = $product["slave_category_id"];
                //$this->log("Используем подчиненную категорию товара: $category_id");
            } else {
                $category_id = 0;
                //$this->log("Внимание!!! По товару №" . $product['product_id'] . " не заданы категории, используем корневую категорию");
            }
            $this->registry->set("product_category_id",$category_id);
            $this->registry->set("product_vqmod_patch", 0 );
            $output .= "\t<loc>" . str_replace('&', '&amp;', str_replace('&amp;', '&', $this->url->link('product/product', 'product_id=' . $product['product_id']))) . "</loc>\n";
            if( "0" == $this->registry->get("product_vqmod_patch") ) {
                $this->log("ERROR! Патч seo_pro не работает!" );
                // exit();
            }
        } else {
            $output .= "\t<loc>" . $this->store_host . "index.php?route=product/product&amp;product_id=" . $product['product_id'] . "</loc>\n";
        }
        $output .= "\t<lastmod>" . substr(max($product['date_added'], $product['date_modified']), 0, 10) . "</lastmod>\n";
        $output .= "\t<changefreq>weekly</changefreq>\n";
        $output .= "\t<priority>1.0</priority>\n";
        $output .= "</url>\n";

        return $output;
    }

    protected function getProducts($part = -1){
        $output = "";

        $this->log("Генерация продуктов стартовала!" );
        $begin = microtime(true);

        if( "2" == $this->seo_status ) {
            $sql = "select p.product_id, p.date_added, p.date_modified from `" . DB_PREFIX . "product` p ";
        } else if( "1" == $this->seo_status ) {
            $sql = "select p.product_id, (SELECT pc1.category_id FROM `" . DB_PREFIX . "product_to_category` pc1 WHERE pc1.product_id = p.product_id and pc1.main_category = 1 LIMIT 1) as main_category_id, (SELECT pc2.category_id FROM `" . DB_PREFIX . "product_to_category` pc2 WHERE pc2.product_id = p.product_id and pc2.main_category = 0 LIMIT 1) as slave_category_id, p.date_added, p.date_modified from `" . DB_PREFIX . "product` p ";
        } else {
            $sql = "select p.product_id, 0 as category_id, p.date_added, p.date_modified from `" . DB_PREFIX . "product` p ";
        }
        if( "1" == $this->multistore_status ){
            $sql .= " inner join product_to_store ps on (p.product_id = ps.product_id) ";
        }
        $sql .= " WHERE p.status=1 ";
        if( "1" == $this->multistore_status ){
            $sql .= " and ps.store_id = " . (int)$this->store_id;
        }
        if( $part != -1 ){
            $sql .= " ORDER BY p.product_id ASC ";
            $sql .= " limit " . (($part-1)*$this->product_part) . ", " . ($part*$this->product_part - 1);
        }
        //$this->log($sql);

        $queryBegin = microtime(true);
        $products = $this->db->query($sql);
        $this->log("Запрос по продуктам выполнен за " . round(microtime(true) - $queryBegin,3)  . " сек" );

        $keywords = array();
        if( "2" == $this->seo_status ) { // оптимизация для seo_url
            $sql = "SELECT substr(query,12) as product_id, keyword FROM `" . DB_PREFIX . "url_alias` WHERE query like \"product_id=%\";";
            $queryBegin = microtime(true);
            $keywordsData = $this->db->query($sql);
            $this->log("Запрос по ключам выполнен за " . round(microtime(true) - $queryBegin,3)  . " сек" );

            $queryBegin = microtime(true);
            foreach( $keywordsData->rows as $keyword ){
                $keywords[$keyword["product_id"]] = $keyword["keyword"];
            }
            unset($keywordsData);
            $this->log("Трансформация ключей выполнена за " . round(microtime(true) - $queryBegin,3)  . " сек" );
        }

        $count = 1;
        $partBegin = microtime(true);
        foreach ($products->rows as $product) {

            if( "2" == $this->seo_status ) { // оптимизация для seo_url
                if( isset($keywords[$product["product_id"]])){
                    $product["keyword"] = $keywords[$product["product_id"]];
                } else {
                    $product["keyword"] = null;
                }
            }
            $output .= $this->getProduct($product);

            // дополнительные замеры производительности
            $count++;
            if( ($count % 5000) == 0 ) {
                $this->log("Обработано 5000 продуктов за  " . round(microtime(true) - $partBegin,3)  . " сек" );
                $partBegin = microtime(true);
            }
        }

        $this->log("Генерация продуктов выполнена за " . round(microtime(true) - $begin,3)  . " сек" );

        unset($products);
        unset($keywords);
        return $output;
    }

    protected function getSitemapIndex(){

        $begin = microtime(true);
        $this->log("Генерация индекса карт сайта стартовала!" );

        $output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $output .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        $products = $this->getProductsCount();
        $maps =  1 + ceil($products/$this->product_part);

        for($i = 0; $i < $maps; $i++ ){
            $output .= "\t<sitemap>\n";
            $output .= "\t\t<loc>" . $this->store_host . 'index.php?route=feed/soforp_fast_sitemap&amp;index=' . $i ."</loc>\n";
            $output .= "\t\t<lastmod>" . date("Y-m-d") . "</lastmod>\n";
            $output .= "\t</sitemap>\n";
        }

        $output .= "</sitemapindex>\n";

        $this->log("Генерация индекса карт сайта выполнена за " . round(microtime(true) - $begin,3) . " сек" );

        return $output;
    }

    protected function getSitemapPart($part){

        $begin = microtime(true);

        $this->log("Генерация части №" . $part . " карты сайта стартовала!" );

        $output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $output .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        if( "0" == $part ) {
            $output .= $this->getCategories(0);
            $output .= $this->getManufacturers();
            $output .= $this->getInformation();
            $output .= $this->getBlog(0);
        } else {
            $output .= $this->getProducts($part);
        }

        $output .= "</urlset>";

        $this->log("Генерация части №" . $part . " карты сайта выполнена за " . round(microtime(true) - $begin,3) . " сек" );

        return $output;
    }


    protected function getFullSitemap(){

        $begin = microtime(true);
        $this->log("Генерация полной карты сайта стартовала!" );

        $output  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $output .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        $output .= $this->getProducts();
        $output .= $this->getCategories(0);
        $output .= $this->getManufacturers();
        $output .= $this->getInformation();
        $output .= $this->getBlog(0);

        $output .= '</urlset>';

        $this->log("Генерация полной карты сайта выполнена за " . round(microtime(true) - $begin,3) . " сек" );

        return $output;
    }

	public function index() {
		if ("1" != $this->config->get('soforp_fast_sitemap_status')) {
            $this->log("Карта сайта отключена и не будет построена");
            exit();
        }

        $this->seo_status = $this->config->get("soforp_fast_sitemap_seo_status");
        $this->log("ЧПУ: " . $this->seo_status);
        $this->blog_status = $this->config->get("soforp_fast_sitemap_blog_status");
        $this->multistore_status = $this->config->get("soforp_fast_sitemap_multistore_status");
        $this->store_host = 'http' . ( (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']) ? "s" : "" ) . '://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . rtrim(dirname($_SERVER['PHP_SELF']), '/.\\') . '/';
        $this->store_id = (int)$this->config->get("config_store_id");
        $this->language_id = (int)$this->config->get('config_language_id');
        $this->customer_group_id = (int)$this->config->get('config_customer_group_id');
        $this->product_part = 50000;

        if( "1" == $this->config->get("soforp_fast_sitemap_partition_status")){
            if( !isset($this->request->get["index"])){
                $output = $this->getSitemapIndex();
            } else {
                $output = $this->getSitemapPart($this->request->get["index"]);
            }
        } else {
            $output = $this->getFullSitemap();
        }

        $this->response->addHeader('Content-Type: application/xml');
        if( "0" == $this->config->get("soforp_fast_sitemap_gzip_status") ) {
            $this->response->setOutput($output);
        } else {
            if( !function_exists("gzencode")){
                $this->log("Отсутствует функция gzencode! Обратитесь к хостеру. Ответ будет отдан без сжатия!");
                $this->response->setOutput($output);
            } else {
                $data = gzencode($output,$this->config->get("soforp_fast_sitemap_gzip_status"));
                if( !$data ){
                    $this->log("Не удалось выполнить сжатие. Обратитесь к разработчику с логами веб-сервера. Ответ будет отдан без сжатия!");
                    $this->response->setOutput($output);
                } else {
                    $this->log("Сжатие отработало успешно, размер ответа - " . strlen($data) . " байт");
                    $this->response->addHeader('Content-Encoding: gzip');
                    //$this->response->addHeader('Content-length: ' . strlen($data) );
                    $this->response->setOutput($data);
                }
            }
        }
	}


}
?>