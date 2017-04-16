<?php
/* 
 * Generated by CRUDigniter v2.3 Beta 
 * www.crudigniter.com
 */
 
class Page_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get page by id
     */
    function get_page($id)
    {
        return $this->db->get_where('pages',array('id'=>$id))->row_array();
    }
    
    /*
     * Get all pages
     */
    function get_all_pages()
    {
        return $this->db->get('pages')->result_array();
    }
    
    /*
     * function to add new page
     */
    function add_page($params)
    {
        $this->db->insert('pages',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update page
     */
    function update_page($id,$params)
    {
        $this->db->where('id',$id);
        $response = $this->db->update('pages',$params);
        if($response)
        {
            return "page updated successfully";
        }
        else
        {
            return "Error occuring while updating page";
        }
    }
    
    /*
     * function to delete page
     */
    function delete_page($id)
    {
        $response = $this->db->delete('pages',array('id'=>$id));
        if($response)
        {
            return "page deleted successfully";
        }
        else
        {
            return "Error occuring while deleting page";
        }
    }
}
