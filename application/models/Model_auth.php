<?php 

class Model_auth extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  /* 
    This function checks if the username exists in the database
  */
  public function check_username($uname) 
  {
    if($uname) {
      $sql = 'SELECT * FROM account WHERE username = ?';
      $query = $this->db->query($sql, array($uname));
      $result = $query->num_rows();
      return ($result == 1) ? true : false;
    }

    return false;
  }

 public function check_status($uname) 
  {
    if($uname) {
      $sql = 'SELECT * FROM account,user WHERE username = ? AND user.Status = 1 AND user.a_id = account.Account_id';
      $query = $this->db->query($sql, array($uname));
      $result = $query->num_rows();
      return ($result == 1) ? true : false;
    }

    return false;
  }




  /* 
    This function checks if the username and password matches with the database
  */
  public function login($uname, $password) {
    if($uname && $password) {
      $sql = "SELECT * FROM account,user WHERE account.username = ? AND user.a_id = account.Account_id";
      $query = $this->db->query($sql, array($uname));

      if($query->num_rows() == 1) {
        $result = $query->row_array();

        $hash_password = password_verify($password, $result['password']);
        if($hash_password === true) {
          return $result; 
        }
        else {
          return false;
        }

        
      }
      else {
        return false;
      }
    }
  }
}