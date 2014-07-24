<?php

class ControllerProductAttachManager extends Controller {

    public function getfile() {

        $this->load->model('catalog/attachmanager');

        if (isset($this->request->get['product_attach_file_id'])) {
            $product_attach_file_id = $this->request->get['product_attach_file_id'];
        } else {
            $product_attach_file_id = 0;
        }

        $download_info = $this->model_catalog_attachmanager->getDownloads($product_attach_file_id);
//                
//                var_dump($download_info);
//                exit();
        if ($download_info) {
            $file = DIR_DOWNLOAD . '' . $download_info['filename'];
            $mask = basename($download_info['mask']);
            $mime = 'application/octet-stream';
            $encoding = 'binary';

            if ($download_info['login_required'] == 1) { // check required login
                if ($this->customer->isLogged()) {

                    if (!headers_sent()) {
                        if (file_exists($file)) {
                            header('Pragma: public');
                            header('Expires: 0');
                            header('Content-Description: File Transfer');
                            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                            header('Content-Type: ' . $mime);
                            header('Content-Transfer-Encoding: ' . $encoding);
                            header('Content-Disposition: attachment; filename=' . ($mask ? $mask : basename($file)));
                            header('Content-Length: ' . filesize($file));

                            $file = readfile($file, 'rb');

                            print($file);
                            $download_count = $download_info['download'] + 1;
                            $download_count = $this->model_catalog_attachmanager->getDownloadsUpdate($product_attach_file_id, $download_count);
                        } else {
                            exit('Error: Could not findd file ' . $file . '!');
                        }
                    } else {
                        exit('Error: Headers already sent out!');
                    }
                } else {
                    $this->redirect(HTTPS_SERVER . '/index.php?route=account/login');
                }
            } else {

                if (!headers_sent()) {
                    if (file_exists($file)) {
                        header('Pragma: public');
                        header('Expires: 0');
                        header('Content-Description: File Transfer');
                        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                        header('Content-Type: ' . $mime);
                        header('Content-Transfer-Encoding: ' . $encoding);
                        header('Content-Disposition: attachment; filename=' . ($mask ? $mask : basename($file)));
                        header('Content-Length: ' . filesize($file));

                        $file = readfile($file, 'rb');

                        print($file);
                        $download_count = $download_info['download'] + 1;
                        $download_count = $this->model_catalog_attachmanager->getDownloadsUpdate($product_attach_file_id, $download_count);
                    } else {
                        exit('Error: Could not findd file ' . $file . '!');
                    }
                } else {
                    exit('Error: Headers already sent out!');
                }
            }
        }
    }

}

?>
