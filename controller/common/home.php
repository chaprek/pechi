<?php  
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));

		$this->data['heading_title'] = $this->config->get('config_title');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/home.tpl';
		} else {
			$this->template = 'default/template/common/home.tpl';
		}
		
		$this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'
		);
										
		$this->response->setOutput($this->render());
	}
	
		 public function updatePrices(){
         $products = $this->db->query('SELECT * FROM '.DB_PREFIX.'product WHERE price_euro != "" AND price_euro != "0"');
         foreach($products->rows as $product){
              $this->db->query('UPDATE '.DB_PREFIX.'product SET price = "'.$this->currency->convert($product['price_euro'], 'EUR', 'RUB').'" WHERE product_id = "'.$product['product_id'].'"');
         }
         echo "PRODUCTS UPDATED: " . $products->num_rows;
     }
}
?>