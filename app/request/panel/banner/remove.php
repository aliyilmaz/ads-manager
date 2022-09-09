<?php

$this->addLayer('app/middleware/lifetime/banner');
if(isset($this->post['banner_id'])){
    $banner = $this->theodore('banners', ['id'=>$this->post['banner_id']]);
    if(!empty($banner)){
        $this->rm_r($banner['image']);
        $this->delete('banners', $this->post['banner_id'], 'id');
    }

}
$this->redirect($this->page_back);