<?php

/*
	(C) 2020 Lamers High Tech Systems
	author: Paul Vermeulen

	tcp/modBus proof-of-concept
	
*/

function upload2Alis($data)
{
	/* 
		IN: $data: array of ALIS menu-specific field=>value combo's for one row
		OUT: server output from POST call

	*/
	$data['date'] = date("Y-m-d H:i:s"); 

	$jsonPost = json_encode([$data]);


	$postArr['authToken'] = 'xxxxxxxxxxxxxxxxxxxxxxxxx';
	$postArr['setId'] = '966';
	$postArr['results'] = $jsonPost;

	$ch = curl_init();
	$headers = array("Content-Type:multipart/form-data");
	curl_setopt($ch, CURLOPT_HTTPHEADER , $headers);
	curl_setopt($ch, CURLOPT_URL, "https://customer.alisqi.com/api/storeResults");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postArr); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);
	curl_close ($ch);

	return $server_output;
	
}

function crtModbusCmd($functionCode, $dataAddress, $count)
{
	$retCmd = '';

	$transID = rand(1, 65534); //2 byte
	$protID = 0; //2 byte
	$len = 6; //2 byte
	$unit = 1 ; //1 byte

	$retCmd = pack("nnnccnn", $transID, $protID, $len, $unit, $functionCode, $dataAddress, $count);

	return $retCmd;
}

function sendPDU($fp, $PDU)
{
	fwrite($fp, $PDU);
	stream_set_timeout($fp, 2);
	$retval = '';
	$res = true;
	while ($res)
	{
		$res = fread($fp, 2000);
		if ($res)
		{
			$retval .= $res;
		}
	}
	return $retval;
}

function sampleIP($clientIP)
{
	echo "sampling $clientIP ... \n";
	$fp = fsockopen($clientIP, 502, $errno, $errstr, 30);
	if ($fp)
	{
		$alisData = array(); 
		//status:
		if (true)
		{
			//prod
			$PDU = crtModbusCmd(3, 7, 8);
			$result = sendPDU($fp, $PDU); 
			$resultAr = unpack("ntid/npid/nlen/cadr/cfun/cnb/c*dat", $result);
			$prod='';
			$c=0;
			foreach($resultAr as $chr)
			{
				if ($c>5 && $chr>32) $prod .= chr($chr); 
				$c++;
			}
			echo "prod $prod\n";

			//model
			$PDU = crtModbusCmd(3, 15, 8);
			$result = sendPDU($fp, $PDU); 
			$resultAr = unpack("ntid/npid/nlen/cadr/cfun/cnb/c*dat", $result);
			$model='';
			$c=0;
			foreach($resultAr as $chr)
			{
				if ($c>5 && $chr>32) $model .= chr($chr); 
				$c++;
			}
			echo "model $model\n";

			//status 3
			$PDU = crtModbusCmd(3, 3, 1);
			$result = sendPDU($fp, $PDU); 
			$resultAr = unpack("ntid/npid/nlen/cadr/cfun/cnb/n*dat", $result);
			$status = $resultAr['dat1']; 
			echo "status: $status\n";

			//flowrate 23
			$PDU = crtModbusCmd(3, 23, 3);
			$result = sendPDU($fp, $PDU); 
			$resultAr = unpack("ntid/npid/nlen/cadr/cfun/cnb/n*dat", $result);
			$flow =   $resultAr['dat1']; 
			$norecs = $resultAr['dat2']; 
			$recidx = $resultAr['dat3']; 
			echo "flow: $flow recno $norecs recidx $recidx \n";
			$alisData['flowrate1'] = $flow/100; 
			$alisData['position'] = $norecs; 
		}
		//data:
		if (true)
		{
			$PDU = crtModbusCmd(4, 1, 24);
			$result = sendPDU($fp, $PDU); 

			$resultAr = unpack("ntid/npid/nlen/cadr/cfun/cnb/c*dat", $result);

			$samplefreq = $resultAr['dat4'];
			$ch1 = $resultAr['dat6'];
			$ch2 = $resultAr['dat10'];
			$ch3 = $resultAr['dat11'];
			echo "samplefreq $samplefreq ch1 $ch1 ch2 $ch2 ch3 $ch3\n";

			$alisData['particlesof01'] = $ch1;
			$alisData['particlesof021'] = $ch2;
			$alisData['particlesof031'] = $ch3;
		}
		fclose($fp);

		if (true)
		{
			$alisData['ponumber'] = $model.' '.$prod;
			$alisData['project'] = 'test eq uploads';
			$alisData['serial'] = $clientIP;

			if ($status == 3) upload2Alis($alisData);
		}

	}else
	{
		echo "err $errno : $errstr \n";
	}
}

sampleIP('10.27.91.89');
sampleIP('10.27.90.69');
sampleIP('10.27.89.94');

?>
