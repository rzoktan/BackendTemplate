<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*
* file name     : M_menu
* file type     : models
* file packages : CodeIgniter 3
* author        : rizky ardiansyah
* date-create   : 14 Dec 2020
*/

class M_menu extends CI_Model
{
    // methode get menu
    public function getMenu($where)
    {
        // code here...
        $this->db->select('*');
        $this->db->from('tbl_menu');
        $this->db->where($where);
        return $this->db->get();
    }

    public function typeMenu()
    {
        $this->db->distinct();
        $this->db->select('type');
        $this->db->from('tbl_menu');
        return $this->db->get();
    }
    public function getMenuById($where)
    {
        $this->db->select('*');
        $this->db->from('tbl_menu');
        $this->db->where($where);
        return $this->db->get();
    }

    // Add new menu
    public function addNewMenu($data)
    {
        return $this->db->insert('tbl_menu', $data);
    }

    // Update Menu
    public function updateMenu($id_menu, $data)
    {
        $this->db->where('id_menu', $id_menu);
        $this->db->update('tbl_menu', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    // Delete Menu
    public function deleteMenu($data)
    {
        $this->db->where($data);
        $this->db->delete('tbl_menu');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // ==========================Sub Menu============================
    public function getSubmenuById($where)
    {
        $this->db->select('id_submenu, m.id_menu, m.nama_menu, nama_submenu, url, sm.icon, sm.is_active');
        $this->db->from('tbl_submenu sm');
        $this->db->join('tbl_menu m', 'sm.id_menu=m.id_menu');
        $this->db->where($where);
        return $this->db->get();
    }

    public function getSubMenu($where)
    {
        // code here...
        $this->db->select('*');
        $this->db->from('tbl_submenu sm');
        $this->db->where($where);
        return $this->db->get();
    }

    // methode get sub menu
    public function getSubMenuAll()
    {
        // code here...
        $this->db->select('id_submenu, nama_submenu, url, sm.icon, sm.is_active, m.nama_menu');
        $this->db->from('tbl_submenu sm');
        $this->db->join('tbl_menu m', 'sm.id_menu=m.id_menu');
        $this->db->where('editable =', 'YES');
        return $this->db->get();
    }

    // Add Submenu
    public function addNewSubmenu($data)
    {
        return $this->db->insert('tbl_submenu', $data);
    }

    // Update Sub Menu
    public function updateSubMenu($id_submenu, $data)
    {
        $this->db->where('id_submenu', $id_submenu);
        $this->db->update('tbl_submenu', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // Delete Submenu
    public function deleteSubmenu($data)
    {
        $this->db->where($data);
        $this->db->delete('tbl_submenu');
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // =================================================

    public function getUserMenu($where)
    {
        $this->db->distinct();
        $this->db->select('m.id_menu, m.nama_menu, m.link_menu, m.type, m.icon, m.is_active');
        $this->db->from('tbl_menu m');
        $this->db->join('user_access_menu uam', 'm.id_menu=uam.menu_id');
        // $this->db->join('user_role ur', 'ur.id_role=uam.role_id');
        // $this->db->join('users u', 'u.role=ur.id_role');
        $this->db->where($where);
        $this->db->order_by('m.id_menu', 'asc');
        return $this->db->get();
    }
}
