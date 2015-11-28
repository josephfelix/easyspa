<?php
class Chat_model extends CI_Model
{
	public function pegar_conversa( $user1, $user2 )
	{
		$this->db->where("(user1 = {$user1} AND user2 = {$user2})")
				 ->or_where("(user1 = {$user2} AND user2 = {$user1})");
		$this->db->order_by('data', 'ASC');
		$busca = $this->db->get('chat');
		if ( $busca->num_rows() > 0 )
			return $busca->result();
		return false;
	}
	public function pegar_chats( $where = false )
	{
		if ( $where )
			$this->db->where( $where );
		$busca = $this->db->get('chat');
		if ( $busca->num_rows() > 0 )
			return $busca->result();
		return false;
	}
	
	public function pegar_chat( $where = false )
	{
		if ( $where )
			$this->db->where( $where );
		$busca = $this->db->get('chat');
		if ( $busca->num_rows() > 0 )
			return $busca->row();
		return false;
	}
	
	
	public function inserir( $insert )
	{
		$this->db->insert('chat', $insert);
		return $this->db->insert_id();
	}
	
	public function alterar( $update, $where )
	{
		$this->db->where( $where );
		$this->db->update('chat', $update);
	}
}
?>