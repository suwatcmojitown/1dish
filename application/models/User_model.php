<?php
class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
        }
        
    public function fetch_user_login($username,$password)
	{
                //$password = md5($password);
                //$password = '81dc9bdb52d04dc20036dbd8313ed055';
                $data = array (
                        'username' => $username,
                        'password' => $password,
                        'system_at' => 'backoffice',
                );
                $myJSON = json_encode($data); 

                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => PATH_API.'backend/auth',
                    CURLOPT_TIMEOUT => 20,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $myJSON,
                    CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "cache-control: no-cache"
                    ),
                    CURLOPT_VERBOSE => true,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_SSL_VERIFYPEER => false,
                 ));                

                $response = curl_exec($curl);
                curl_close($curl);
        
                $result = json_decode($response); 
                //console($result);
                if($result->header->res_code=='200')
                {
                        $object = $result->body;
                }
                else $object = NULL;
                return $object;  
			   
	}

	public function updatePassword($data)
    {
			$myJSON = json_encode($data); 
            $result = json_decode(callAPI('PUT',PATH_API.'changepassword',$myJSON)); 
            if($result->header->res_code=='200')
            {
                    return true;
            }
            else return false;
    }

    public function addUser($data){
    		$this->db->insert('user', $data);

            return ($this->db->affected_rows() != 1) ? false : true;
    }

    public function getTotalUser($active_page,$limit)
    {   
    			$query = $this->db->query("
                        SELECT count(user_id) as total
                        FROM user
                        ;");       
                
                $object = $query->result_array();  

                $total = $object[0]['total'];
                $offset = ($active_page-1)*$limit;
                $total_page = ceil($total/$limit);

                $object[0]['total_page'] = $total_page;
                $object[0]['active_page'] = $active_page;
                $object[0]['total_content'] = $total;

				return $object[0];
    }

    public function getUserList($keysearch='',$active_page=1,$limit)
    {   
                /*
                $this->db->select('*');
                $this->db->from('content');
                $this->db->where('category_id', $category_id);
                */

                $offset = ($active_page-1)*$limit;
                
                $this->db->select('*');
                $this->db->from('user');
				if($keysearch!='')
                {
                    $this->db->like('username', $keysearch);
                }
                $this->db->order_by('user_id', 'DESC');
                $this->db->limit($limit, $offset);
                


                $query = $this->db->get();

                if ( $query->num_rows() > 0 )
                {
                    $row = $query->result();
                    return $row;
                }
                else return null;
    }

    

    public function updateUser($data)
    {
        
            $this->db->where('user_id', $data->user_id);
            $this->db->update('user', $data);
            return ($this->db->affected_rows() != 1) ? false : true;
           
    }

    public function getDetail($id)
    {
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('user_id', $id);
            $this->db->where('status', 1);
            $query = $this->db->get();

            if ( $query->num_rows() > 0 )
            {
                $row = $query->result();
                return $row[0];
            }
            else return null;
    }
    
}