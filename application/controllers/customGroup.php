<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class CustomGroup extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('group_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
      if($this->isSuplier()=='true' || $this->isAdmin() =='true' || $this->isIndividual() == 'true' || $this->isCompany()=='true')
      {
           $data['pageTitle'] = 'Group';
           $this->global['pageTitle'] = 'Fit4Site : Group';
           $data['groups'] = $this->group_model->getGroupList();
          $this->loadViews("group/index", $this->global, $data, NULL);
      }
      else
      {
        $this->loadThis();
      }

    }

    public function addGroup()
    {
        if($this->isSuplier()=='true' || $this->isAdmin() =='true' || $this->isIndividual() == 'true' || $this->isCompany()=='true')
        {
           if(!empty($_POST))
           {
             $this->form_validation->set_rules('title','Group Name','required');
             $this->form_validation->set_rules('group_visibility','Group Visivility','required');
             if($_FILES['cover_image']['name']=='')
                        $this->form_validation->set_rules('cover_image','Image','required');
             if($this->form_validation->run()==TRUE)
             {
               $config['upload_path'] = './uploads/groups/';
               $config['allowed_types'] = 'gif|jpg|png|jpeg';
               $config['file_name']  = substr(md5(time()), 0, 28);
               $this->load->library('upload', $config);
               $this->upload->do_upload('cover_image');
               $upload_data	= $this->upload->data();

                 @chmod('./uploads/',0777);

               $mainimagefilename	= $upload_data['file_name'];

               $config1['image_library'] = 'gd2';
               $config1['source_image'] = $upload_data['full_path'];
               $config1['new_image'] = "./uploads/groups/group_thumb/$mainimagefilename";
               $config1['maintain_ratio'] = FALSE;
               $config1['width']         = 100;
               $config1['height']       = 100;
               $this->load->library('image_lib', $config1);
               $this->image_lib->initialize($config1);
               $this->image_lib->resize();

               $config1['image_library'] = 'gd2';
               $config1['source_image'] = $upload_data['full_path'];
               $config1['new_image'] = "./uploads/groups/group_resize/$mainimagefilename";
               $config1['maintain_ratio'] = FALSE;
               $config1['width']         = 1024;
               $config1['height']       = 840;
               $this->load->library('image_lib', $config1);
               $this->image_lib->initialize($config1);
               $this->image_lib->resize();

               $groupData = array(
                  'title' => $this->input->post('title'),
                  'cover_image' => $mainimagefilename,
                  'description' => $this->input->post('description'),
                  'group_visibility' => $this->input->post('group_visibility'),
                  'created_by' => $this->session->userdata('userId'),
                  'created_at' => date('Y-m-d H:i:s')
               );
               $this->group_model->insertGroup($groupData);
               redirect('customGroup');
             }
             else
             {
               $data['groups'] = 'Group';
               $this->global['pageTitle'] = 'Fit4Site : Add Group';
               $this->loadViews("group/add", $this->global, $data, NULL);
             }
           }
           else
           {
             $data['groups'] = 'Group';
             $this->global['pageTitle'] = 'Fit4Site : Add Group';
             $this->loadViews("group/add", $this->global, $data, NULL);
           }
        }
        else
        {
          $this->loadThis();
        }

    }

    public function editGroup($groupId){
      if($this->isSuplier()=='true' || $this->isAdmin() =='true' || $this->isIndividual() == 'true' || $this->isCompany()=='true')
      {
            $created_by = $this->session->userdata('userId');
            if(!empty($groupId) && !empty($created_by))
            {
              $this->global['pageTitle'] = 'Fit4Site : Edit Group Information';
              $data['groupinfo'] = $this->group_model->getGroupInformation($groupId,$created_by);
              $this->loadViews("group/edit",$this->global,$data,NULL);
            }
      }
      else
      {
          $this->loadThis();
      }
    }

    public function updateGroup(){
        $created_by = $this->session->userdata('userId');
        $groupId = $this->input->post('groupId');
        if(!empty($_POST)){
          $this->form_validation->set_rules('title','Group Name','required');
          $this->form_validation->set_rules('group_visibility','Group Visivility','required');
          if($this->form_validation->run()==TRUE)
          {
            $config['upload_path'] = './uploads/groups/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name']  = substr(md5(time()), 0, 28);
            $this->load->library('upload', $config);

            $this->upload->do_upload('cover_image');
            $upload_data	= $this->upload->data();
              @chmod('./uploads/',0777);


            if($_FILES['cover_image']['name']!=''){

            $mainimagefilename	= $upload_data['file_name'];
            $config1['image_library'] = 'gd2';
            $config1['source_image'] = $upload_data['full_path'];
            $config1['new_image'] = "./uploads/groups/group_thumb/$mainimagefilename";
            $config1['maintain_ratio'] = FALSE;
            $config1['width']         = 100;
            $config1['height']       = 100;
            $this->load->library('image_lib', $config1);
            $this->image_lib->initialize($config1);
            $this->image_lib->resize();

            $config1['image_library'] = 'gd2';
            $config1['source_image'] = $upload_data['full_path'];
            $config1['new_image'] = "./uploads/groups/group_resize/$mainimagefilename";
            $config1['maintain_ratio'] = FALSE;
            $config1['width']         = 1024;
            $config1['height']       = 840;
            $this->load->library('image_lib', $config1);
            $this->image_lib->initialize($config1);
            $this->image_lib->resize();
            $old = $this->input->post('cover_image_old');
            unlink("./uploads/groups/group_resize/$old");
            unlink("./uploads/groups/$old");
            unlink("./uploads/groups/group_thumb/$old");
          }else{

              $mainimagefilename	= $this->input->post('cover_image_old');
          }

            $groupData = array(
               'title' => $this->input->post('title'),
               'cover_image' => $mainimagefilename,
               'description' => $this->input->post('description'),
               'group_visibility' => $this->input->post('group_visibility'),
               'modified_by' => $this->session->userdata('userId'),
               'modified_at' => date('Y-m-d H:i:s')
            );

            $st = $this->group_model->updateGroup($groupData,$groupId);
            if($st==true)
            {
              redirect('customGroup');
            }
            else
            {
              redirect("customGroup/editGroup/$groupId");
            }

          }
        }
    }

    public function deleteGroupInfo($groupid)
    {
      $created_by = $this->session->userdata('userId');
      $groupinfo = $this->group_model->getGroupInformation($groupid,$created_by);
      if(!empty($groupinfo))
      {
        $img = $groupinfo[0]->cover_image;
        unlink("./uploads/groups/group_resize/$img");
        unlink("./uploads/groups/$img");
        unlink("./uploads/groups/group_thumb/$img");
      }
      $this->group_model->deleteGroup($groupid);
      redirect('customGroup');
    }

}
