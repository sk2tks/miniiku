<?php
App::uses('AppController', 'Controller');

class DevController extends AppController {
	
	public $uses = array('Zip');
	
	
	public function import_ken_all(){
		set_time_limit(0);
		ini_set('memory_limit', '-1');
		header('Content-type: text/html; charset=UTF-8');
		
		$this->Zip->query('TRUNCATE TABLE zips');
		$csv = WWW_ROOT . 'KEN_ALL.CSV';
		$fp = fopen($csv, 'r');
		$this->autoRender = false;
		$n = 0;
		while($row = fgetcsv($fp)){
			$this->log($row);
			$sub_city = $row[8] != '以下に掲載がない場合' ? $row[8] : '';
			$data = array(
				'municipal_code' => $row[0],
				'zip' => $row[2],
				'prefecture'=>$row[6],
				'city'=> $row[7],
				'sub_city'=>$sub_city
			);
			
			$this->Zip->create();
			$this->Zip->save($data);
		}
		$this->add_area_to_zip();
		
		pr('done..');
	}
	
	private function add_area_to_zip(){
		$this->autoRender = false;
		$tbl = array();
		$tbl['1030000'] = 1;
		$tbl['1040044'] = 2;
		$tbl['1040042'] = 2;
		$tbl['1040054'] = 3;
		$tbl['1040031'] = 2;
		$tbl['1040061'] = 2;
		$tbl['1040033'] = 2;
		$tbl['1040041'] = 2;
		$tbl['1040052'] = 3;
		$tbl['1040045'] = 2;
		$tbl['1040051'] = 3;
		$tbl['1040055'] = 3;
		$tbl['1030027'] = 1;
		$tbl['1030011'] = 1;
		$tbl['1030014'] = 1;
		$tbl['1030026'] = 1;
		$tbl['1030025'] = 1;
		$tbl['1030016'] = 1;
		$tbl['1030001'] = 1;
		$tbl['1030024'] = 1;
		$tbl['1030006'] = 1;
		$tbl['1030008'] = 1;
		$tbl['1030013'] = 1;
		$tbl['1030015'] = 1;
		$tbl['1030007'] = 1;
		$tbl['1030002'] = 1;
		$tbl['1030005'] = 1;
		$tbl['1030012'] = 1;
		$tbl['1030021'] = 1;
		$tbl['1030023'] = 1;
		$tbl['1030022'] = 1;
		$tbl['1030003'] = 1;
		$tbl['1040032'] = 2;
		$tbl['1040046'] = 2;
		$tbl['1040053'] = 3;
		$tbl['1046090'] = 3;
		$tbl['1046001'] = 3;
		$tbl['1046002'] = 3;
		$tbl['1046003'] = 3;
		$tbl['1046004'] = 3;
		$tbl['1046005'] = 3;
		$tbl['1046006'] = 3;
		$tbl['1046007'] = 3;
		$tbl['1046008'] = 3;
		$tbl['1046009'] = 3;
		$tbl['1046010'] = 3;
		$tbl['1046011'] = 3;
		$tbl['1046012'] = 3;
		$tbl['1046013'] = 3;
		$tbl['1046014'] = 3;
		$tbl['1046015'] = 3;
		$tbl['1046016'] = 3;
		$tbl['1046017'] = 3;
		$tbl['1046018'] = 3;
		$tbl['1046019'] = 3;
		$tbl['1046020'] = 3;
		$tbl['1046021'] = 3;
		$tbl['1046022'] = 3;
		$tbl['1046023'] = 3;
		$tbl['1046024'] = 3;
		$tbl['1046025'] = 3;
		$tbl['1046026'] = 3;
		$tbl['1046027'] = 3;
		$tbl['1046028'] = 3;
		$tbl['1046029'] = 3;
		$tbl['1046030'] = 3;
		$tbl['1046031'] = 3;
		$tbl['1046032'] = 3;
		$tbl['1046033'] = 3;
		$tbl['1046034'] = 3;
		$tbl['1046035'] = 3;
		$tbl['1046036'] = 3;
		$tbl['1046037'] = 3;
		$tbl['1046038'] = 3;
		$tbl['1046039'] = 3;
		$tbl['1046040'] = 3;
		$tbl['1046041'] = 3;
		$tbl['1046042'] = 3;
		$tbl['1046043'] = 3;
		$tbl['1046044'] = 3;
		$tbl['1046190'] = 3;
		$tbl['1046101'] = 3;
		$tbl['1046102'] = 3;
		$tbl['1046103'] = 3;
		$tbl['1046104'] = 3;
		$tbl['1046105'] = 3;
		$tbl['1046106'] = 3;
		$tbl['1046107'] = 3;
		$tbl['1046108'] = 3;
		$tbl['1046109'] = 3;
		$tbl['1046110'] = 3;
		$tbl['1046111'] = 3;
		$tbl['1046112'] = 3;
		$tbl['1046113'] = 3;
		$tbl['1046114'] = 3;
		$tbl['1046115'] = 3;
		$tbl['1046116'] = 3;
		$tbl['1046117'] = 3;
		$tbl['1046118'] = 3;
		$tbl['1046119'] = 3;
		$tbl['1046120'] = 3;
		$tbl['1046121'] = 3;
		$tbl['1046122'] = 3;
		$tbl['1046123'] = 3;
		$tbl['1046124'] = 3;
		$tbl['1046125'] = 3;
		$tbl['1046126'] = 3;
		$tbl['1046127'] = 3;
		$tbl['1046128'] = 3;
		$tbl['1046129'] = 3;
		$tbl['1046130'] = 3;
		$tbl['1046131'] = 3;
		$tbl['1046132'] = 3;
		$tbl['1046133'] = 3;
		$tbl['1046134'] = 3;
		$tbl['1046135'] = 3;
		$tbl['1046136'] = 3;
		$tbl['1046137'] = 3;
		$tbl['1046138'] = 3;
		$tbl['1046139'] = 3;
		$tbl['1046290'] = 3;
		$tbl['1046201'] = 3;
		$tbl['1046202'] = 3;
		$tbl['1046203'] = 3;
		$tbl['1046204'] = 3;
		$tbl['1046205'] = 3;
		$tbl['1046206'] = 3;
		$tbl['1046207'] = 3;
		$tbl['1046208'] = 3;
		$tbl['1046209'] = 3;
		$tbl['1046210'] = 3;
		$tbl['1046211'] = 3;
		$tbl['1046212'] = 3;
		$tbl['1046213'] = 3;
		$tbl['1046214'] = 3;
		$tbl['1046215'] = 3;
		$tbl['1046216'] = 3;
		$tbl['1046217'] = 3;
		$tbl['1046218'] = 3;
		$tbl['1046219'] = 3;
		$tbl['1046220'] = 3;
		$tbl['1046221'] = 3;
		$tbl['1046222'] = 3;
		$tbl['1046223'] = 3;
		$tbl['1046224'] = 3;
		$tbl['1046225'] = 3;
		$tbl['1046226'] = 3;
		$tbl['1046227'] = 3;
		$tbl['1046228'] = 3;
		$tbl['1046229'] = 3;
		$tbl['1046230'] = 3;
		$tbl['1046231'] = 3;
		$tbl['1046232'] = 3;
		$tbl['1046233'] = 3;
		$tbl['1030004'] = 1;
		$tbl['1040043'] = 2;
		$tbl['1030028'] = 1;
		$tbl['1040028'] = 2;
		
		foreach($tbl as $code=>$value){
			$sql = 'update zips set area_id=? where zip=?';
			$this->Zip->query($sql, array($value, $code));
		}
		
		
	}
}