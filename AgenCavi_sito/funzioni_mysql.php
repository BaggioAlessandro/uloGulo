<?php
class MysqlClass
{
	// parametri per la connessione al database
	private $nomehost = "127.0.0.1";     
	private $nomeuser = "1";          
	private $password = "2"; 
	private $nomedb = "wordpress";
			  
	// controllo sulle connessioni attive
	private $attiva = false;
	 
	// funzione per la connessione a MySQL
	public function connetti(){
		if(!$this->attiva){
			$connessione = mysql_connect($this->nomehost,$this->nomeuser,$this->password, TRUE) or die (mysql_error());
			$selezione = mysql_select_db($this->nomedb,$connessione) or die (mysql_error());
			$this->attiva = true;
			return $connessione;
		}else{
			return false;
		}
	}     
	
	//funzione per l'esecuzione delle query 
	public function query($sql){
		if($this->attiva){
			$sql = mysql_query($sql) or die (mysql_error());
			return $sql;
		}else{
			;
			return false; 
		}
	}
	
	public function disconnetti(){
		if($this->attiva){
			if(mysql_close()){
				$this->attiva = false;
				return true;
				
			}else{
				return false;
			}
		}
	}
	
	public function estrai($risultato_sql){
	
		if(isset($this->attiva)){
			$r = mysql_fetch_object($risultato_sql);
			return $r;
		}else{
			return false;
		}
	}
	
	public function inserisci($t,$v,$r)
    {
        if(isset($this->attiva)){
            $istruzione = 'INSERT INTO '.$t;
            if($r != null){
                $istruzione .= ' ('.$r.')';
            }
 
            for($i = 0; $i < count($v); $i++)
            {
                if(is_string($v[$i]))
                    $v[$i] = '"'.$v[$i].'"';
					
            }
            $v = implode(',',$v);
            $istruzione .= ' VALUES ('.$v.')';
 
            $query = mysql_query($istruzione) or die (mysql_error());
 
            }else{
                return false;
            }
    }
	
	
}
?>