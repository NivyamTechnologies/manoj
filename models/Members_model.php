<?php
class Members_model extends MY_Model
{
	public $table = 'members'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	//public $fillable = array('sponsor_no'); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array('id'); // ...Or you can set an array with the fields that cannot be filled by insert/update
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
     * Update timestamps before updating a record
     * @param array $user
     * @return array
     */
    protected function update_timestamps($user) {
        $user['updated_at'] = date('Y-m-d H:i:s');

        return $user;
    }
}
