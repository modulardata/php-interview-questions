<?php
/*
New South Wales	NSW	1000—1999 (LVRs and PO Boxes only)
2000—2599
2619—2898
2921—2999
Australian Capital Territory	ACT	0200—0299 (LVRs and PO Boxes only)
2600—2618
2900—2920
Victoria	VIC	3000—3999
8000—8999 (LVRs and PO Boxes only)
Queensland	QLD	4000—4999
9000—9999 (LVRs and PO Boxes only)
South Australia	SA	5000—5799
5800—5999 (LVRs and PO Boxes only)
Western Australia	WA	6000—6797
6800—6999 (LVRs and PO Boxes only)
Tasmania	TAS	7000—7799
7800—7999 (LVRs and PO Boxes only)
Northern Territory	NT	0800—0899
0900—0999 (LVRs and PO Boxes only)
*/
/*
Canadian
NL	NS	PE	NB	QC	ON	MB	SK	AB	BC	NU/NT	YT
A	B	C	E	G	H	J	K	L	M	N	P	R	S	T	V	X	Y
*/
$alpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$postCode['CA'] = array('NL-A', 'NS-B', 'PE-C', 'NB-E', 'NU-N',
						'YT-Y', 'MB-J', 'SK-K', 'AB-L', 'BC-M', 
						'NT-N', 'ON-K', 'ON-L', 'ON-M', 'ON-N', 
						'ON-P', 'QC-G', 'QC-H', 'QC-J');
$postCode['AU'] = array('ACT-2600-2618', 'ACT-2900-2920', 'NSW-2000-2599', 'NSW-2619-2989', 'NSW-2921-2999',
						'VIC-3000-3999', 'QLD-4000-4999', 'SA-5000-5799', 'WA-6000—6797', 'TAS-7000—7799', 'NT-800—0899');
$postCode['US'] = array('AR','AK','DE','PA','NH','MA','CT','NY','NJ','WV','NC','MD','SC','GA','FL','IL','OH','KT','TN',
						'MO','LA','MI','IN','WI','MT','ND','SD','KS','IO','OK','TX','NV','UT','ID','WY','AZ','NM','WA',
						'OR','CA','HI','PR','AK','MA','VT','RI','VA');

$countries = array('US', 'CA', 'AU', 'UK');
$companies1 = array('north','south','tele','fast','cable','east','west');
$companies2 = array('com','media','net');
$companies3 = array('com','net');

include '../Model/Members.php';
$members = new Members();
$all = $members->getAllMembers();
$pdo = $members->getPdo();

foreach ($all as $row) {
	$country = $countries[rand(0, 3)];
	$email = strtolower(str_replace(' ', '.', $row['name'])) . '@' 
		   . $companies1[rand(0,6)] . $companies2[rand(0,2)] 
		   . '.' . $companies3[rand(0,1)];
	$us = FALSE;
	switch ($country) {
		case 'CA' :
			$pos = rand(0, count($postCode['CA'])-1);
			list($province, $startLetter) = explode('-', $postCode['CA'][$pos]);
			$newCode = $startLetter . rand(0,9) . substr($alpha, rand(0,25), 1) 
					  . ' ' . rand(0,9) . substr($alpha, rand(0,25), 1) . rand(0,9);
			break;
		case 'AU' :
			$pos = rand(0, count($postCode['AU'])-1);
			list($province, $startNum, $endNum) = explode('-', $postCode['AU'][$pos]);
			$startNum = (int) $startNum;
			$endNum = (int) $endNum;
			$newCode = sprintf('%04d', rand($startNum, $endNum));
			break;
		case 'UK' :
			$province = '';
			$newCode = substr($alpha, rand(0,25), 1) . substr($alpha, rand(0,25), 1) . rand(1,99)
					  . ' ' . rand(1,99) . substr($alpha, rand(0,25), 1) . substr($alpha, rand(0,25), 1);
			break;
		default :
			$pos = rand(0, count($postCode['US'])-1);
			$province = $postCode['US'][$pos];
			$newCode = rand(10000, 99999);
	}
	$sql = 'UPDATE `members` SET `state_province` = ?, `postal_code` = ?, `country` = ?, `email` = ? WHERE `user_id` = ?';
	$stmt = $pdo->prepare($sql);
	echo $stmt->execute(array($province, $newCode, $country, $email, $row['user_id'])), ':';
}
