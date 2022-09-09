<?php

// $this->print_pre($this->post);

$values = [];
$values['created_at'] = $this->timestamp;
$values['status'] = 1;

$rule = [
   'title'        => 'required',
   'url'          => 'required',
   'position'     => 'required',
   'start_date'   => 'date:Y-m-d',
   'end_date'     => 'date:Y-m-d'
];

$message = [
   'title'=>[
      'required'=>'The title must be specified.'
   ],
   'url'=>[
      'required'=>'The url must be specified.'
   ],
   'position'=>[
      'required'=>'The position must be specified.'
   ],
   'start_date'=>[
      'date'=>'The start date must be specified.'
   ],
   'end_date'=>[
      'date'=>'The end date must be specified.'
   ]
];

if(isset($this->post['title'])){
   
   $this->post['title'] = (!empty($this->post['title'])) ? $this->post['title'] : '';
   $this->post['url'] = (!empty($this->post['url'])) ? $this->post['url'] : '';
   $this->post['position'] = (!empty($this->post['position'])) ? $this->post['position'] : '';
   $this->post['start_date'] = (!empty($this->post['start_date'])) ? $this->post['start_date'] : '';
   $this->post['end_date'] = (!empty($this->post['end_date'])) ? $this->post['end_date'] : '';
   
   if($this->validate($rule, $this->post, $message)){
      $values['title'] = $this->post['title'];
      $values['url'] = $this->post['url'];
      $values['position'] = $this->permalink($this->post['position']);
      $values['start_date'] = $this->post['start_date'];
      $values['end_date'] = $this->post['end_date'];
   }

   if(empty($this->post['image']['name'])){
      $this->errors['image']['required'] = 'The image must be selected.';
   }

   if(empty($this->errors)){

      $image = $this->upload($this->post['image'], 'public/banners/'.date('Y-m-d').'/');
      if(!empty($image)){
         $values['image'] = $image[0]; 
      } else {
         $this->errors['image']['required'] = 'The image could not be loaded.';
      }

   }
   
   if(empty($this->errors)){
      $this->insert('banners', $values);
   }

   $this->addLayer('app/middleware/lifetime/banner');
}
