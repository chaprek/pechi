<?php
class ControllerProductWebmeProductQuestion extends Controller {
	
	public function write_product_question() {
		$this->language->load('product/webme_product_question');
		$this->load->model('catalog/webme_product_question');
		
		$json = array();
		$error = array();
		
		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if ((utf8_strlen($this->request->post['author']) < 3) || (utf8_strlen($this->request->post['author']) > 25)) {
				//$json['error'] = $this->language->get('error_author');
				$error[] = $this->language->get('error_author');
			}
			
			if ((utf8_strlen($this->request->post['question']) < 25) || (utf8_strlen($this->request->post['question']) > 1000)) {
				//$json['error'] = $this->language->get('error_question');
				$error[] = $this->language->get('error_question');
			}
			
			if (isset($this->request->post['receive_answers']) && ($this->request->post['receive_answers'] == 1)) {
				if ($this->request->post['receive_answers'] == 1) {
					if (empty($this->request->post['email_for_answers'])) {
						//$json['error'] = $this->language->get('error_email_empty');
						$error[] = $this->language->get('error_email_empty');
					} else {
						if (!$this->filter_string($this->request->post['email_for_answers'], "2")) {
							//$json['error'] = $this->language->get('error_email_format');
							$error[] = $this->language->get('error_email_format');
						}
					}
				}
			}
			
			if (empty($this->session->data['webme_product_question_captcha']) || ($this->session->data['webme_product_question_captcha'] != $this->request->post['captcha'])) {
				//$json['error'] = $this->language->get('error_captcha');
				$error[] = $this->language->get('error_captcha');
			}
			
			$webme_product_question_auth_required = $this->config->get('webme_product_question_auth_required');
			if ($webme_product_question_auth_required) {
				if (!$this->customer->isLogged()) {
					$error = array();
					$error[] = $this->language->get('text_wpq_auth_required');
				}
			}
			
			if (!empty($error)) {
				$json['error'] = implode("<br />", $error);
			}
			
			if (!isset($json['error'])) {
				$this->request->post['language_id'] = $this->config->get('config_language_id');
				$this->model_catalog_webme_product_question->addQuestion($this->request->get['product_id'], $this->request->post);
				$json['success'] = $this->language->get('text_success');
			}
		}
		
		$this->response->setOutput(json_encode($json));
	}
	
	public function write_admin_answer() {
		$this->language->load('product/webme_product_question');
		$json = array();
		
		
		$this->data['wpq_show_answer_ctrl'] = 0;
		// User
		require_once(DIR_SYSTEM . 'library/user.php');
		$this->registry->set('user', new User($this->registry));
		if ($this->user->isLogged()) {
			//$this->data['webmeProductQuestionCustomerName'] = $this->user->getUserName();
			//$this->session->data['wpq_user_id'] = $this->user->getId();
			//$this->data['wpq_show_answer_ctrl'] = 1;
			
			$error = array();
			if ($this->request->server['REQUEST_METHOD'] == 'POST') {
				if ((utf8_strlen($this->request->post['author']) < 3) || (utf8_strlen($this->request->post['author']) > 25)) {
					//$json['error'] = $this->language->get('error_author');
					$error[] = $this->language->get('error_author');
				}
				
				if ((utf8_strlen($this->request->post['question']) < 25) || (utf8_strlen($this->request->post['question']) > 1000)) {
					//$json['error'] .= $this->language->get('error_question');
					$error[] = $this->language->get('error_question');
				}
				
				if (isset($this->request->post['receive_answers']) && ($this->request->post['receive_answers'] == 1)) {
					if ($this->request->post['receive_answers'] == 1) {
						if (empty($this->request->post['email_for_answers'])) {
							//$json['error'] = $this->language->get('error_email_empty');
							$error[] = $this->language->get('error_email_empty');
						} else {
							if (!$this->filter_string($this->request->post['email_for_answers'], "2")) {
								//$json['error'] = $this->language->get('error_email_format');
								$error[] = $this->language->get('error_email_format');
							}
						}
					}
				} else {
					$this->request->post['email_for_answers'] = ''; // clear email_for_answers
				}
				
				if (empty($this->session->data['webme_product_question_captcha']) || ($this->session->data['webme_product_question_captcha'] != $this->request->post['captcha'])) {
					//$json['error'] = $this->language->get('error_captcha');
					$error[] = $this->language->get('error_captcha');
				}
				
				if (!empty($error)) {
					$json['error'] = implode("<br />", $error);
				}
				
				if (!isset($json['error'])) {
					
					if (isset($this->request->post['wpq_page'])) {
						$wpq_page = $this->request->post['wpq_page'];
					} else {
						$wpq_page = 1;
					}
					
					$question_id = $this->request->get['question_id'];
					$data = array(
									'admin_answer' => $this->request->post['question'],
									'user_id' => $this->session->data['wpq_user_id'],
									'user_name' => $this->request->post['author'],
									'wpq_page' => $wpq_page,
								);
					
					$this->load->model('catalog/webme_product_question');
					
					$fullQuestion = $this->model_catalog_webme_product_question->addAdminAnswer($question_id, $data);
					
					$admin_answer = '
						<a name="wpq_'.$question_id.'_admin_reply"></a>
						<div class="reply" id="wpq_'.$question_id.'_admin_reply">
							<div class="reply-body" style="padding-left:3.0em;">
							
							<div class="author">
								<span class="avatar">
								<a>
								<img src="catalog/view/theme/default/image/webme/product_question/product_question_admin_avatar_x64.png" border="0" width="48" alt="'.$fullQuestion['user_name'].'" title="'.$fullQuestion['user_name'].'">
								</a>
								</span>
							</div>
							
							<div class="reply-container">
								<div class="username">
								<a class="username-link">'.$fullQuestion['user_name'].'</a>'.$this->language->get('text_admin').'
								<span class="question-date">'.$fullQuestion['date_answered'].'</span>
								</div>
								<div class="reply-message">
								<div class="answer">'.$fullQuestion['admin_answer'].'</div>
								<div class="clear"></div>
								</div>
							</div>
							</div>
							<div class="clear"></div>
						</div>
					';
					
					$json['success'] = $this->language->get('text_admin_answer_success');
					$json['answer'] = $admin_answer;
				}
			}
		} else {
			$json['error'] = $this->language->get('error_auth');
		}
		
		$this->response->setOutput(json_encode($json));
	}
	
	public function webme_product_question_captcha() {
		$this->load->library('captcha');
		$captcha = new Captcha('webme_product_question_captcha');
		$this->session->data['webme_product_question_captcha'] = $captcha->getCode();
		$captcha->showImage();
	}
	
	/*=============================================
	| If you want to validate an email in one line, use filter_var() function !
	| http://fr.php.net/manual/en/function.filter-var.php
	| (PHP 5 >= 5.2.0)
	|
	| easy use, as described in the document example :
	| var_dump(filter_var('bob@example.com', FILTER_VALIDATE_EMAIL));
	|=============================================*/
	public function filter_string($string="", $filter="2") {
		//var_dump(filter_var($email, FILTER_VALIDATE_EMAIL));
		
		$filters["1"] = FILTER_VALIDATE_INT;
		$filters["2"] = FILTER_VALIDATE_EMAIL;
		$filters["0"] = FILTER_VALIDATE_BOOLEAN;
		
		$res = filter_var($string, $filters["".$filter.""]);
		
		return($res);
	}
	
}
?>