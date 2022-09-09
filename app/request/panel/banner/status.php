<?php

$banner = $this->theodore('banners', ['id'=>$this->post['banner_id']]);
$this->update('banners', ['status'=>($banner['status']) ? 0 : 1, 'updated_at'=>$this->timestamp], $this->post['banner_id']);
$this->addLayer('app/middleware/lifetime/banner');
$this->redirect($this->page_back);