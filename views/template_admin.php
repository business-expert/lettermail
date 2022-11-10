   <?php $this->load->view('admin/static/header');?>   
   <?php $this->load->view('admin/static/sidebar_'.$user_status->user_group);?>   
      <?php $this->load->view($view);?>
   <?php $this->load->view('admin/static/footer');?>