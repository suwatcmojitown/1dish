<?php
class MY_Controller extends CI_Controller 
{
   protected $data;
   function __construct() {
       parent::__construct();
   }

   /*  Load the front end layout and set the ouput */
   /*
   public function render($layout)
   {
       $this->load->view('layouts/'.$layout, $this->data);
   }*/
   //set the class variable.
   //Load layout    
  public function master_layout() {
     
     $this->template['header'] = $this->load->view('layouts/header','',true);
     $this->template['menu'] = $this->load->view($this->menu,$this->data,true);
     $this->template['content'] = $this->load->view($this->middle, $this->data, true);
     $this->template['footer'] = $this->load->view('layouts/footer','',true);
     $this->load->view('layouts/layout', $this->template);

  }

  public function cms_layout() {
     
    $this->template['header'] = $this->load->view('layouts-cms/header','',true);
    $this->template['menu'] = $this->load->view($this->menu,$this->data,true);
    $this->template['content'] = $this->load->view($this->middle, $this->data, true);
    $this->template['footer'] = $this->load->view('layouts-cms/footer','',true);
    $this->load->view('layouts/layout', $this->template);

 }
}