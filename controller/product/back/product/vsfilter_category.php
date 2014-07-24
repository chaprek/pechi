<?php 
class ControllerProductVsfilterCategory extends Controller {  
	public function index() { 
		$this->language->load('product/vsfilter_category');
		
		$this->load->model('catalog/category');
		
		$this->load->model('module/vsfilter');
		
		$this->load->model('tool/image'); 
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
		}	
							
		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_catalog_limit');
		}
					
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
       		'separator' => false
   		);
        
        if (isset($this->request->get['path'])) {
            		
			$pathvs = $this->request->get['path'];
            $pathvs1 = '';
		
			$parts = explode('_', (string)$this->request->get['path']);
		
			$category_id = (int)array_pop($parts);
		
			foreach ($parts as $path_id) {
				if (!$pathvs1) {
					$pathvs1 = (int)$path_id;
				} else {
					$pathvs1 .= '_' . (int)$path_id;
				}
									
				$category_info = $this->model_catalog_category->getCategory($path_id);
				
				if ($category_info) {
	       			$this->data['breadcrumbs'][] = array(
   	    				'text'      => $category_info['name'],
						'href'      => $this->url->link('product/category', 'path=' . $pathvs1),
        				'separator' => $this->language->get('text_separator')
        			);
				}
			}
		} else {
            if (isset($this->request->get['pathvs']))
            {
			    $pathvs = $this->request->get['pathvs'];
                $pathvs1 = '';
		
			    $parts = explode('_', (string)$this->request->get['pathvs']);
		
			    $category_id = (int)array_pop($parts);
		
			    foreach ($parts as $path_id) {
				    if (!$pathvs1) {
					    $pathvs1 = (int)$path_id;
				    } else {
					    $pathvs1 .= '_' . (int)$path_id;
				    }
									
				    $category_info = $this->model_catalog_category->getCategory($path_id);
				
				    if ($category_info) {
	       			    $this->data['breadcrumbs'][] = array(
   	    				    'text'      => $category_info['name'],
						    'href'      => $this->url->link('product/category', 'path=' . $pathvs1),
        				    'separator' => $this->language->get('text_separator')
        			    );
				    }
			    }
            }
            else
            {                
                $category_id = 0;                
            }			
		}	

        // With $_POST
        if (isset($this->request->get['delsession']))
        {   
            $this->session->data['vs_use_sub_category'] = NULL;
            $this->session->data['choice'] = NULL;
            $this->session->data['choiceA'] = NULL;
            $this->session->data['pricemin'] = NULL;
            $this->session->data['pricemax'] = NULL;                 
            $this->session->data['pricemin1'] = NULL;
            $this->session->data['pricemax1'] = NULL;
            $this->session->data['manufacturer'] = NULL;
            $this->session->data['product_attribute_group'] = NULL;
            $this->session->data['product_attribute'] = NULL;
            $this->session->data['product_attribute_text'] = NULL;
        }
        if (isset($this->request->get['route']))
        {  
            if ($this->request->get['route'] != 'product/vsfilter_category')  
            {
                $this->session->data['vs_use_sub_category'] = NULL;
                $this->session->data['choiceA'] = NULL;
                $this->session->data['pricemin'] = NULL;
                $this->session->data['pricemax'] = NULL;
                $this->session->data['pricemin1'] = NULL;
                $this->session->data['pricemax1'] = NULL;
                $this->session->data['manufacturer'] = NULL;
                $this->session->data['product_attribute_group'] = NULL;
                $this->session->data['product_attribute'] = NULL;
                $this->session->data['product_attribute_text'] = NULL;
            }
        }
        else
        {
            $this->session->data['vs_use_sub_category'] = NULL;
            $this->session->data['choice'] = NULL;
            $this->session->data['choiceA'] = NULL;
            $this->session->data['pricemin'] = NULL;
            $this->session->data['pricemax'] = NULL;                 
            $this->session->data['pricemin1'] = NULL;
            $this->session->data['pricemax1'] = NULL;
            $this->session->data['manufacturer'] = NULL;
            $this->session->data['product_attribute_group'] = NULL;
            $this->session->data['product_attribute'] = NULL;
            $this->session->data['product_attribute_text'] = NULL;
        }

        // Use_sub_category
        if (isset($this->request->post['vs_use_sub_category'])) {
		    $this->data['vs_use_sub_category'] = $this->request->post['vs_use_sub_category'];
		} else {
            if (isset($this->session->data['vs_use_sub_category']))
            {
                $this->data['vs_use_sub_category'] = $this->session->data['vs_use_sub_category'];
            }
            else
            {
                $this->data['vs_use_sub_category'] = 0;
            }			    
		}
        if (isset($this->request->post['vs_use_sub_category']))
        {
            $this->session->data['vs_use_sub_category'] = $this->request->post['vs_use_sub_category'];
		}

        // ChoiceA
        if (isset($this->request->post['choiceA'])) {
		    $this->data['choiceA'] = $this->request->post['choiceA'];
		} else {
            if (isset($this->session->data['choiceA']))
            {
                $this->data['choiceA'] = $this->session->data['choiceA'];
            }
            else
            {
                $this->data['choiceA'] = 0;
            }			    
		}
        if (isset($this->request->post['choiceA']))
        {
            $this->session->data['choiceA'] = $this->request->post['choiceA'];
		}

        // Prices
        if (isset($this->request->post['pricemin'])) {
		    $this->data['pricemin'] = $this->request->post['pricemin'];
		} else {
            if (isset($this->session->data['pricemin']))
            {
                $this->data['pricemin'] = $this->session->data['pricemin'];
            }
            else
            {
                $this->data['pricemin'] = array();
            }			    
		}
        if (isset($this->request->post['pricemin']))
        {
            $this->session->data['pricemin'] = $this->request->post['pricemin'];
		} 

        if (isset($this->request->post['pricemax'])) {
		    $this->data['pricemax'] = $this->request->post['pricemax'];
		} else {
            if (isset($this->session->data['pricemax']))
            {
                $this->data['pricemax'] = $this->session->data['pricemax'];
            }
            else
            {
                $this->data['pricemax'] = array();
            }			    
		}
        if (isset($this->request->post['pricemax']))
        {
            $this->session->data['pricemax'] = $this->request->post['pricemax'];
		}

        if (isset($this->request->post['pricemin1'])) {
		    $this->data['pricemin1'] = $this->request->post['pricemin1'];
		} else {
            if (isset($this->session->data['pricemin1']))
            {
                $this->data['pricemin1'] = $this->session->data['pricemin1'];
            }
            else
            {
                $this->data['pricemin1'] = array();
            }			    
		}
        if (isset($this->request->post['pricemin1']))
        {
            $this->session->data['pricemin1'] = $this->request->post['pricemin1'];
		} 
        if (isset($this->request->post['pricemax1'])) {
		    $this->data['pricemax1'] = $this->request->post['pricemax1'];
		} else {
            if (isset($this->session->data['pricemax1']))
            {
                $this->data['pricemax1'] = $this->session->data['pricemax1'];
            }
            else
            {
                $this->data['pricemax1'] = array();
            }			    
		}
        if (isset($this->request->post['pricemax1']))
        {
            $this->session->data['pricemax1'] = $this->request->post['pricemax1'];
		}
        // Manufacturers
        if (isset($this->request->post['manufacturer'])) {
		    $this->data['manufacturer_ids'] = $this->request->post['manufacturer'];
		} else {
            if (isset($this->session->data['manufacturer']))
            {
                $this->data['manufacturer_ids'] = $this->session->data['manufacturer'];
            }
            else
            {
                $this->data['manufacturer_ids'] = array();
            }			    
		}
        if (isset($this->request->post['manufacturer']))
        {
            $this->session->data['manufacturer'] = $this->request->post['manufacturer'];
		}
        // Attributes 
        if (isset($this->request->post['product_attribute_group'])) {
		    $this->data['product_attribute_group_ids'] = $this->request->post['product_attribute_group'];
		} else {
            if (isset($this->session->data['product_attribute_group']))
            {
                $this->data['product_attribute_group_ids'] = $this->session->data['product_attribute_group'];
            }
            else
            {
                $this->data['product_attribute_group_ids'] = array();
            }			    
		}
        if (isset($this->request->post['product_attribute_group']))
        {
            $this->session->data['product_attribute_group'] = $this->request->post['product_attribute_group'];
		}

        if (isset($this->request->post['product_attribute'])) {
		    $this->data['product_attribute_ids'] = $this->request->post['product_attribute'];
		} else {
            if (isset($this->session->data['product_attribute']))
            {
                $this->data['product_attribute_ids'] = $this->session->data['product_attribute'];
            }
            else
            {
                $this->data['product_attribute_ids'] = array();
            }			    
		}
        if (isset($this->request->post['product_attribute']))
        {
            $this->session->data['product_attribute'] = $this->request->post['product_attribute'];
		}

        if (isset($this->request->post['product_attribute_text'])) {
		    $this->data['product_attribute_text_ids'] = $this->request->post['product_attribute_text'];
		} else {
            if (isset($this->session->data['product_attribute_text']))
            {
                $this->data['product_attribute_text_ids'] = $this->session->data['product_attribute_text'];
            }
            else
            {
                $this->data['product_attribute_text_ids'] = array();
            }			    
		}
        if (isset($this->request->post['product_attribute_text']))
        {
            $this->session->data['product_attribute_text'] = $this->request->post['product_attribute_text'];
		}
		
		$category_info = $this->model_catalog_category->getCategory($category_id);
	
		if ($category_info) {
            //////////
	  		$this->document->setTitle($category_info['name']);
			$this->document->setDescription($category_info['meta_description']);
			$this->document->setKeywords($category_info['meta_keyword']);
			
			$this->data['heading_title'] = $category_info['name'];
			//////////
			$this->data['text_refine'] = $this->language->get('text_refine');
			$this->data['text_empty'] = $this->language->get('text_empty');			
			$this->data['text_quantity'] = $this->language->get('text_quantity');
			$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$this->data['text_model'] = $this->language->get('text_model');
			$this->data['text_price'] = $this->language->get('text_price');
			$this->data['text_tax'] = $this->language->get('text_tax');
			$this->data['text_points'] = $this->language->get('text_points');
			$this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$this->data['text_display'] = $this->language->get('text_display');
			$this->data['text_list'] = $this->language->get('text_list');
			$this->data['text_grid'] = $this->language->get('text_grid');
			$this->data['text_sort'] = $this->language->get('text_sort');
			$this->data['text_limit'] = $this->language->get('text_limit');
					
			$this->data['button_cart'] = $this->language->get('button_cart');
			$this->data['button_wishlist'] = $this->language->get('button_wishlist');
			$this->data['button_compare'] = $this->language->get('button_compare');
			$this->data['button_continue'] = $this->language->get('button_continue');
					
			if ($category_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
			} else {
				$this->data['thumb'] = '';
			}
									
			$this->data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');
			$this->data['compare'] = $this->url->link('product/compare');
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}	
			
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
								
			$this->data['categories'] = array();
			
			$results = $this->model_catalog_category->getCategories($category_id);
			
			foreach ($results as $result) {
				$data = array(
					'filter_category_id'  => $result['category_id'],
					'filter_sub_category' => true
				);
				
				$product_total = $this->model_module_vsfilter->getTotalProducts($data);				
				
				$this->data['categories'][] = array(
					'name'  => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
					'href'  => $this->url->link('product/category', 'path=' . $pathvs . '_' . $result['category_id'] . $url)
				);
			}  
			
			$this->data['products'] = array();
			
            $data = array(
                    'filter_choiceA'        => $this->data['choiceA'],
                    'filter_pricemin'       => $this->data['pricemin1'],
                    'filter_pricemax'       => $this->data['pricemax1'],
				    'filter_category_id'    => $category_id, 
                    'filter_sub_category'                       => $this->data['vs_use_sub_category'],
                    'filter_manufacturer_ids'                   => $this->data['manufacturer_ids'],
                    'filter_product_attribute_group_ids'        => $this->data['product_attribute_group_ids'],
                    'filter_product_attribute_ids'              => $this->data['product_attribute_ids'],
                    'filter_product_attribute_text_ids'         => $this->data['product_attribute_text_ids'],
				    'sort'               => $sort,
				    'order'              => $order,
				    'start'              => ($page - 1) * $limit,
				    'limit'              => $limit
			    );
					
			$product_total = $this->model_module_vsfilter->getTotalProducts($data); 
			
			$results = $this->model_module_vsfilter->getProducts($data);
			
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = false;
				}
				
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}
				
				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}	
				
				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}				
				
				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}
								
				$this->data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
					'price'       => $price,
					'price_2'       => (int)$result['price'],
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $result['rating'],
					'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
					'href'        => $this->url->link('product/product', 'path=' . $pathvs . '&product_id=' . $result['product_id'])
				);
			}
			
			$url = '';
	
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
							
			$this->data['sorts'] = array();
			
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . '&sort=p.sort_order&order=ASC' . $url)
			);
			
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . '&sort=pd.name&order=ASC' . $url)
			);

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . '&sort=pd.name&order=DESC' . $url)
			);

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . '&sort=p.price&order=ASC' . $url)
			); 

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . '&sort=p.price&order=DESC' . $url)
			); 
			
			if ($this->config->get('config_review_status')) {
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . '&sort=rating&order=DESC' . $url)
				); 
				
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . '&sort=rating&order=ASC' . $url)
				);
			}
			
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . '&sort=p.model&order=ASC' . $url)
			);

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . '&sort=p.model&order=DESC' . $url)
			);
			
			$url = '';
	
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->data['limits'] = array();
			
			$this->data['limits'][] = array(
				'text'  => $this->config->get('config_catalog_limit'),
				'value' => $this->config->get('config_catalog_limit'),
				'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . $url . '&limit=' . $this->config->get('config_catalog_limit'))
			);
						
			$this->data['limits'][] = array(
				'text'  => 25,
				'value' => 25,
				'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . $url . '&limit=25')
			);
			
			$this->data['limits'][] = array(
				'text'  => 50,
				'value' => 50,
				'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . $url . '&limit=50')
			);

			$this->data['limits'][] = array(
				'text'  => 75,
				'value' => 75,
				'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . $url . '&limit=75')
			);
			
			$this->data['limits'][] = array(
				'text'  => 100,
				'value' => 100,
				'href'  => $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . $url . '&limit=100')
			);
						
			$url = '';
	
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
	
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
					
			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('product/vsfilter_category', 'pathvs=' . $pathvs . $url . '&page={page}');
		
			$this->data['pagination'] = $pagination->render();
		
			$this->data['product_total'] = $product_total;
			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
			$this->data['limit'] = $limit;
		
			$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/category.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/category.tpl';
			} else {
				$this->template = 'default/template/product/category.tpl';
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
    	} else {
			
            $this->document->setTitle($this->language->get('text_allcategories'));			
			$this->data['heading_title'] = $this->language->get('text_allcategories');
			//////////
			$this->data['text_refine'] = $this->language->get('text_refine');
			$this->data['text_empty'] = $this->language->get('text_empty');			
			$this->data['text_quantity'] = $this->language->get('text_quantity');
			$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$this->data['text_model'] = $this->language->get('text_model');
			$this->data['text_price'] = $this->language->get('text_price');
			$this->data['text_tax'] = $this->language->get('text_tax');
			$this->data['text_points'] = $this->language->get('text_points');
			$this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$this->data['text_display'] = $this->language->get('text_display');
			$this->data['text_list'] = $this->language->get('text_list');
			$this->data['text_grid'] = $this->language->get('text_grid');
			$this->data['text_sort'] = $this->language->get('text_sort');
			$this->data['text_limit'] = $this->language->get('text_limit');
					
			$this->data['button_cart'] = $this->language->get('button_cart');
			$this->data['button_wishlist'] = $this->language->get('button_wishlist');
			$this->data['button_compare'] = $this->language->get('button_compare');
			$this->data['button_continue'] = $this->language->get('button_continue');
					
			/*if ($category_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($category_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
			} else {
				$this->data['thumb'] = '';
			}*/

            $this->data['thumb'] = '';
									
			//$this->data['description'] = html_entity_decode($category_info['description'], ENT_QUOTES, 'UTF-8');

            $this->data['description'] = html_entity_decode('All categories', ENT_QUOTES, 'UTF-8');
			$this->data['compare'] = $this->url->link('product/compare');
			
			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}	
			
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
								
			$this->data['categories'] = array();
			
			$results = $this->model_catalog_category->getCategories();
			
			foreach ($results as $result) {
				$data = array(
					'filter_category_id'  => $result['category_id'],
					'filter_sub_category' => true
				);
				
				$product_total = $this->model_module_vsfilter->getTotalProducts($data);				
				
				$this->data['categories'][] = array(
					'name'  => $result['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
					'href'  => $this->url->link('product/category', 'path=' . $result['category_id'] . $url)
				);
			}

			$this->data['products'] = array();
			
			$data = array(
                'filter_choiceA'        => $this->data['choiceA'],
                'filter_pricemin'       => $this->data['pricemin1'],
                'filter_pricemax'       => $this->data['pricemax1'],
                'filter_manufacturer_ids'                   => $this->data['manufacturer_ids'],
                'filter_product_attribute_group_ids'        => $this->data['product_attribute_group_ids'],
                'filter_product_attribute_ids'              => $this->data['product_attribute_ids'],
                'filter_product_attribute_text_ids'         => $this->data['product_attribute_text_ids'],
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);
					
			$product_total = $this->model_module_vsfilter->getTotalProducts($data); 
			
			$results = $this->model_module_vsfilter->getProducts($data);
			
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
				} else {
					$image = false;
				}
				
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}
				
				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$special = false;
				}	
				
				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}				
				
				if ($this->config->get('config_review_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

                $this->load->model('catalog/product');
				$product_category = $this->model_catalog_product->getCategories($result['product_id']);	
                $category_path = '';
                if ($product_category)
                {
                    $product_category = array_pop($product_category);
                    $category_path = '&path=' . $product_category['category_id'];
                }
                			 
				$this->data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'price_2'       => (int)$result['price'],
					
					'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $result['rating'],
					'reviews'     => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
					'href'        => $this->url->link('product/product', $category_path . '&product_id=' . $result['product_id'])
				);
			}
			
			$url = '';
	
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
							
			$this->data['sorts'] = array();
			
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('product/vsfilter_category', '&sort=p.sort_order&order=ASC' . $url)
			);
			
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('product/vsfilter_category', '&sort=pd.name&order=ASC' . $url)
			);

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('product/vsfilter_category', '&sort=pd.name&order=DESC' . $url)
			);

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_price_asc'),
				'value' => 'p.price-ASC',
				'href'  => $this->url->link('product/vsfilter_category', '&sort=p.price&order=ASC' . $url)
			); 

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_price_desc'),
				'value' => 'p.price-DESC',
				'href'  => $this->url->link('product/vsfilter_category', '&sort=p.price&order=DESC' . $url)
			); 
			
			if ($this->config->get('config_review_status')) {
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_desc'),
					'value' => 'rating-DESC',
					'href'  => $this->url->link('product/vsfilter_category', '&sort=rating&order=DESC' . $url)
				); 
				
				$this->data['sorts'][] = array(
					'text'  => $this->language->get('text_rating_asc'),
					'value' => 'rating-ASC',
					'href'  => $this->url->link('product/vsfilter_category', '&sort=rating&order=ASC' . $url)
				);
			}
			
			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_model_asc'),
				'value' => 'p.model-ASC',
				'href'  => $this->url->link('product/vsfilter_category', '&sort=p.model&order=ASC' . $url)
			);

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_model_desc'),
				'value' => 'p.model-DESC',
				'href'  => $this->url->link('product/vsfilter_category', '&sort=p.model&order=DESC' . $url)
			);
			
			$url = '';
	
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			
			$this->data['limits'] = array();
			
			$this->data['limits'][] = array(
				'text'  => $this->config->get('config_catalog_limit'),
				'value' => $this->config->get('config_catalog_limit'),
				'href'  => $this->url->link('product/vsfilter_category',  $url . '&limit=' . $this->config->get('config_catalog_limit'))
			);
						
			$this->data['limits'][] = array(
				'text'  => 25,
				'value' => 25,
				'href'  => $this->url->link('product/vsfilter_category', $url . '&limit=25')
			);
			
			$this->data['limits'][] = array(
				'text'  => 50,
				'value' => 50,
				'href'  => $this->url->link('product/vsfilter_category', $url . '&limit=50')
			);

			$this->data['limits'][] = array(
				'text'  => 75,
				'value' => 75,
				'href'  => $this->url->link('product/vsfilter_category', $url . '&limit=75')
			);
			
			$this->data['limits'][] = array(
				'text'  => 100,
				'value' => 100,
				'href'  => $this->url->link('product/vsfilter_category', $url . '&limit=100')
			);
						
			$url = '';
	
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}	

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
	
			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
					
			$pagination = new Pagination();
			$pagination->total = $product_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('product/vsfilter_category', $url . '&page={page}');
		
			$this->data['pagination'] = $pagination->render();
					$this->data['product_total'] = $product_total;
		
			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
			$this->data['limit'] = $limit;
		
			$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/category.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/product/category.tpl';
			} else {
				$this->template = 'default/template/product/category.tpl';
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
  	}
}
?>