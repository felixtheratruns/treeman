<?php
//Requirements
require_once(GCTOOLS_DIR . "database.inc.php");

class SpeciesTable { 
	private $dbres;		//Database resource



        //Contructor
        public function SpeciesTable() {
            $this->dbres = new MySQL(SQL_HOST, SQL_USER, SQL_PASS, SQL_DB);

        }

        public function GetSpecies() {
            /*Precondition: Database connected and populated
             *Postcondition: Returns JSON optimized array of species info.
            */
            $res = $this->QueryGetSpecies();
            $i = 0;
            while ($row = mysql_fetch_assoc($res)) {
                $selectedSpecies[$i] = array(
                  'sid' => (int)$row['SSpeciesId'],
                  'commonname' => $row['SCommonName'],
                  'american' => (bool)$row['SNAmerica'],
                  'ky' => (bool)$row['SKy'],
                  'nonnative' => (bool)$row['SNonNative'],
                  'comments' => $row['SComments']
                );
            $i++;
            }
            return $selectedSpecies;
        }

        private function QueryGetSpecies() {
            /*Precondition: Database connected and populated
             *Postcondition: Returns mysql_dataset of species info*/
            return $this->dbres->query("SELECT SSpeciesId, SCommonName,
                          SNAmerica, SKy, SNonNative, SComments
                    FROM  Species
                    ");
         
        }
}
?>