<?php
/* 
 * Generated by CRUDigniter v2.3 Beta 
 * www.crudigniter.com
 */
 
class Content extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Content_model');
    } 

    /*
     * Listing of contents
     */
    function index()
    {
        $data['contents'] = $this->Content_model->get_all_contents();

        $this->load->view('content/index',$data);
    }

    /*
     * Adding a new content
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'codename' => $this->input->post('codename'),
				'topic' => $this->input->post('topic'),
				'detail' => $this->input->post('detail'),
				'created' => $this->input->post('created'),
            );
            
            $content_id = $this->Content_model->add_content($params);
            redirect('content/index');
        }
        else
        {
            $this->load->view('content/add');
        }
    }  

    /*
     * Editing a content
     */
    function edit($id)
    {   
        // check if the content exists before trying to edit it
        $content = $this->Content_model->get_content($id);
        
        if(isset($content['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'codename' => $this->input->post('codename'),
					'topic' => $this->input->post('topic'),
					'detail' => $this->input->post('detail'),
					'created' => $this->input->post('created'),
                );

                $this->Content_model->update_content($id,$params);            
                redirect('content/index');
            }
            else
            {   
                $data['content'] = $this->Content_model->get_content($id);
    
                $this->load->view('content/edit',$data);
            }
        }
        else
            show_error('The content you are trying to edit does not exist.');
    } 

    /*
     * Deleting content
     */
    function remove($id)
    {
        $content = $this->Content_model->get_content($id);

        // check if the content exists before trying to delete it
        if(isset($content['id']))
        {
            $this->Content_model->delete_content($id);
            redirect('content/index');
        }
        else
            show_error('The content you are trying to delete does not exist.');
    }
    
}
