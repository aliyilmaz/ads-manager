<?php

$banners = $this->samantha('banners', null);
foreach ($banners as $key => $banner) {
    $values['status'] = (!$this->lifetime($banner['end_date'])) ? 0 : 1;
    $this->update('banners', $values, $banner['id']);
}
