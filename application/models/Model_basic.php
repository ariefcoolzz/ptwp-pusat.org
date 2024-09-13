<?php
class Model_basic extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		// $this->simtepa = $this->load->database("simtepa",TRUE);
	}

	function get_event_aktif(){
		$this->db->select("A.id_event");
		$this->db->from('data_event AS A');
		$this->db->where('A.is_aktif', '1');
		$this->db->order_by('A.id_event', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get()->row_array();
		// DIE($this->db->last_query());
		return $query['id_event'];
	}

	function count($P)
    {
        IF(!ISSET($P['from'])) DIE("From Tidak Boleh Kosong");
        $this->db->from($P['from']);
        $this->db->where($P['where']);
		$query = $this->db->get();
		IF(ISSET($P['echo'])) echo($this->db->last_query());
		IF(ISSET($P['die'])) DIE($this->db->last_query());
		return $query->num_rows();
    }
	
    function field($P)
    {
        IF(!ISSET($P['select'])) DIE("Select Tidak Boleh Kosong dan hanya boleh 1 saja");
        IF(!ISSET($P['from'])) DIE("From Tidak Boleh Kosong");
        IF(!ISSET($P['where'])) DIE("Where Tidak Boleh Kosong");
        $this->db->select($P['select']);
        $this->db->from($P['from']);
        $this->db->where($P['where']);
		$query = $this->db->get();
		IF(ISSET($P['echo'])) echo($this->db->last_query());
		IF(ISSET($P['die'])) DIE($this->db->last_query());
		if(!$query->num_rows()) { return ""; }
		else 
			{
				return $query->row_array()[$P['select']];
			}
    }

	function query($qry) 
	{
		if ($qry == "") die("Query Tidak Boleh Kosong");
		// echo $qry;
		$query = $this->db->query($qry);
		return $query;
	}

	function select($P) 
	{
		IF(!ISSET($P['from'])) DIE("From Tidak Boleh Kosong");
		// PRINT_R($P);DIE();
		IF(ISSET($P['select'])) $this->db->select($P['select']); ELSE $this->db->select("*");
		$this->db->from($P['from']);
		IF(ISSET($P['join'])) 
			{
				IF(!IS_ARRAY($P['join'][0]))
					{
						$this->db->join($P['join'][0], $P['join'][1], $P['join'][2]); // format mesti array("From", "A.id=B.id", "LEFT")
					}
				ELSE
					{
						FOREACH($P['join'] AS $k => $v)
							{
								$this->db->join($v[0], $v[1], $v[2]); // format mesti array("From", "A.id=B.id", "LEFT")
							}
					}
			}
		IF(ISSET($P['where'])) $this->db->where($P['where']);
		IF(ISSET($P['group_by'])) $this->db->group_by($P['group_by']);
		IF(ISSET($P['having'])) $this->db->having($P['having']);
		IF(ISSET($P['order_by'])) $this->db->order_by($P['order_by']);
		IF(ISSET($P['limit'])) $this->db->limit($P['limit']);
		$query = $this->db->get();
		IF(ISSET($P['echo'])) echo($this->db->last_query());
		IF(ISSET($P['die'])) DIE($this->db->last_query());
		return $query;
	}

	function delete($P) 
	{
		IF(!ISSET($P['from'])) DIE("From Tidak Boleh Kosong");
		IF(!ISSET($P['where'])) DIE("Where Tidak Boleh Kosong");
		
		$this->db->where($P['where']);
		$query = $this->db->delete($P['from']);
		IF(ISSET($P['echo'])) echo($this->db->last_query());
		IF(ISSET($P['die'])) DIE($this->db->last_query());
		return $query;
	}

	function insert($P) 
	{
		// PRINT_R($P);DIE();
		IF(!ISSET($P['values'])) DIE("Values Tidak Boleh Kosong");
		IF(!ISSET($P['from'])) DIE("From Tidak Boleh Kosong");

		$this->db->set($P['values']);
		$query = $this->db->insert($P['from']);
		IF(ISSET($P['echo'])) echo($this->db->last_query());
		IF(ISSET($P['die'])) DIE($this->db->last_query());
		return $query;
	}

	function insert_cek($P)
	{
		// PRINT_R($P);DIE();
		if (!isset($P['values'])) die("Values Tidak Boleh Kosong");
		if (!isset($P['from'])) die("From Tidak Boleh Kosong");

		$this->db->select('*');
		$this->db->from($P['from']);
		$this->db->where($P['where']);
		$data = $this->db->get();
		if (!$data->num_rows()) {
			$this->db->set($P['values']);
			$query = $this->db->insert($P['from']);
			if (isset($P['echo'])) echo ($this->db->last_query());
			if (isset($P['die'])) die($this->db->last_query());
			return $query;
		}
	}

	function update($P) 
	{
		// PRINT_R($P);DIE();
		IF(!ISSET($P['from'])) 	DIE("From Tidak Boleh Kosong");
		IF(!ISSET($P['set'])) 		DIE("Set Tidak Boleh Kosong");
		IF(!ISSET($P['where'])) 	DIE("Where Tidak Boleh Kosong");

		$this->db->set($P['set']);
		$this->db->where($P['where']);
		$query = $this->db->update($P['from']);
		IF(ISSET($P['echo'])) echo($this->db->last_query());
		IF(ISSET($P['die'])) DIE($this->db->last_query());
		return $query;
	}
	
	function save($P) 
	{
		// PRINT_R($P);DIE();
		IF(!ISSET($P['from'])) 	DIE("From Tidak Boleh Kosong");
		IF(!ISSET($P['where'])) 	DIE("Where Tidak Boleh Kosong");
		// PRINT_R($R);DIE();
		$this->db->select("*");
		$this->db->from($P['from']);
		$this->db->where($P['where']);
		$query = $this->db->get();
		// die($this->db->last_query());
		// DIE("ketemu ".$query->num_rows());
		IF(!$query->num_rows())
			{
				return $this->insert($P);
			}
		ELSE
			{
				return $this->update($P);
			}
	}

	function insert_batch($P) 
	{
		// PRINT_R($P['values']);DIE();
		IF(!ISSET($P['from'])) 	DIE("From Tidak Boleh Kosong");
		IF(!ISSET($P['values'])) 	DIE("Values Tidak Boleh Kosong");
		$status = $this->db->insert_batch($P['from'], $P['values']);
		// die($this->db->last_query());
		IF($status)
			return true;
		else
			return false;
	}

	function replace($P) // sama dengan Insert On Key Update
	{
		IF(!ISSET($P['from'])) 	DIE("From Tidak Boleh Kosong");
		IF(!ISSET($P['data'])) 	DIE("Where Tidak Boleh Kosong");
		$status = false;
		// PRINT_R($P['data']);
		// echo COUNT($P['data'])."ffff";
		// echo "<br><br>";
		$i = 0;
		FOREACH($P['data'] AS $R) //Harus di pecah 1 per 1 array nya, gak bisa langsung, belum ketemu, kalo gak bisa juga ganti query manual aja insert on key update
			{
				$status = $this->db->replace($P['from'], $P['data'][$i]);
				$i++;
			}
		// DIE($this->db->last_query());
		return $status;
	}
}
