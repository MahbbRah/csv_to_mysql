<?php

	class DB
	{	

        private static function getPdo() {
            
            $whitelist = array(
                '127.0.0.1',
                '::1',
                'localhost',
                '192.168.1.7',
                '192.168.1.6',
                '192.168.1.4',
                '192.168.1.3',
            );
            $remoteAddress = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'CLI_COMMAND';

            if(in_array($remoteAddress, $whitelist)){

                return new PDO("mysql:host=localhost;dbname=unlimited_leads", "root", "", array(PDO::MYSQL_ATTR_LOCAL_INFILE => true));
            } else {
                return new PDO("mysql:host=localhost;dbname=bebop_drop_simply", "bebop_drop_simpl", "~N7a[v9R!5w^");
            }

        }


		public static function rawPdo(){
			self::getPdo()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return self::getPdo();
		}

		public static function query($query, $params = array(), $enableLastInsertId=false){
            
            //Taking the PDO instance to variable to collect the last insert id;;
            $pdoInstance = self::rawPdo();
			$statement = $pdoInstance->prepare($query);
			$insertData = $statement->execute($params);
			if(explode(' ', $query)[0] == 'SELECT'){
				$data = $statement->fetchAll(PDO::FETCH_ASSOC);
				return $data;
			} else {
                //Attempt to get lastInsertedId: FAILED returning always 0
                if($enableLastInsertId) {
                    return $pdoInstance->lastInsertId();
                } else {

                    return $insertData;
                }
            }
        }
        
		
		

	}
   
?>