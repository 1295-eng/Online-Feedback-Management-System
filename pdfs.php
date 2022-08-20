<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])){

	require_once('cr_codes.php');
	require_once('cgs.php');
	require_once('fpdf/fpdf.php');

	$feeds=explode('_',$_GET['feeds']);
	$feedid = $feeds[0];
	
	if(!empty($_GET['cr']) && !empty($_GET['br']) && !empty($_GET['yr']) && !empty($_GET['sem']) && !empty($_GET['reg']) && !empty($feedid) )
	{

		$obj = new CGS();
		$res = $obj->clsWise($_GET['cr'],$_GET['br'],$_GET['yr'],$_GET['sem'],$_GET['reg'],$feedid);
		$name = $_GET['cr'].'_'.$_GET['br'].'_'.$_GET['yr'].'_'.$_GET['sem'].'_'.$feedid.'.pdf';
		$q1 = 'Teacher comes to the class on time';
		$q2 = 'Teacher speaks clearly and audibly';
		$q3 = 'Teacher plans lesson with clear objective';
		$q4 = 'Teacher has got command on the subject';
		$q5 = 'Teacher writes and draws legibly';
		$q6 = 'Teacher asks qstions to promote interaction and effective thinking';
		$q7 = 'Teacher encourages,compliments and praises originality and creativity displayed by the student';
		$q8 = 'Teacher is courteous and impartial in dealing with the students';
		$q9 = 'Teacher covers the syllabus completely';
		$q10 = 'Teacher evaluation of the sessional exams answer scripts, lab records etc is fair and impartial';
		$q11 = 'Teacher is prompt in valuing and returning the answer scripts providing feedback on performance';
		$q12 = 'Teacher offers assistance and counseling to the needy students';
		$q13 = 'Teacher imparts the practical knowledge concerned to the subject';
		$q14 = 'Teacher leaves the class on time';

		if(!empty($res['ival']) && $res['ival']>0){
			$pdf = new FPDF();
			
			
			for($i=0;$i<$res['ival'];$i++){
				$pdf->SetFont('Arial','',14);
				$j = 1;
				$pdf->AddPage();
				$pdf->SetXY(0, 20);
				$pdf->SetLeftMargin(15);
				$pdf->Cell(180,10,"JNTUA College of Engineering, Kalikiri",0);
				$pdf->Image('images/jntuacek.png',160,15,25,25,'PNG');
				$pdf->Ln();
				$pdf->Cell(180,10,"Online Feedback Report",0);				
				$pdf->Ln();
				$pdf->Ln();
				$pdf->Cell(50,8,"Name of the faculty : "); $pdf->Cell(200,8,$res[$i]['fid'],0); $pdf->Ln();
				$pdf->Cell(50,8,"Subject Name : "); $pdf->Cell(200,8,$res[$i]['sid'],0); $pdf->Ln();
				if($_GET['cr']=='D'){
					$cls = $cr_name[$_GET['cr']].' (R'.$_GET['reg'].') - '.$spec_name[$_GET['br']].' - '.$_GET['yr'].' yr '.$_GET['sem'].' sem (2019-2020)';
				}
				else{
					$cls = $cr_name[$_GET['cr']].' (R'.$_GET['reg'].') - '.$br_name[$_GET['br']].' - '.$_GET['yr'].' yr '.$_GET['sem'].' sem (2019-2020)';					
				}
				$pdf->Cell(50,8,"Class : "); $pdf->Cell(200,8,$cls,0); $pdf->Ln();
				if($feeds[1]==$feeds[2]){
					$feedtime = $feeds[1];
				}else{
					$feedtime = $feeds[1].'   -   '.$feeds[2];
				}
				$feedtime = $feeds[1];
				$pdf->Cell(50,8,"Date(s) of Feedback : "); $pdf->Cell(200,8,$feedtime,0); $pdf->Ln();								
								
				$tot_st = 'No. of Students Submitted : '.$res[$i]['count'];
				$avg = 'Overall Percentage : '.round($res[$i]['avg']*10,2).' %';
				$pdf->Cell(100,8,$tot_st); $pdf->Ln();								
				$pdf->Ln();
				$pdf->Cell(10,8,$j++,1); $pdf->Cell(150,8,$q1,1); $pdf->Cell(20,8,round((($res[$i]['qs1']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();
				$pdf->Cell(10,8,$j++,1); $pdf->Cell(150,8,$q2,1); $pdf->Cell(20,8,round((($res[$i]['qs2']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();
				$pdf->Cell(10,8,$j++,1); $pdf->Cell(150,8,$q3,1); $pdf->Cell(20,8,round((($res[$i]['qs3']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();
				$pdf->Cell(10,8,$j++,1); $pdf->Cell(150,8,$q4,1); $pdf->Cell(20,8,round((($res[$i]['qs4']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();
				$pdf->Cell(10,8,$j++,1); $pdf->Cell(150,8,$q5,1); $pdf->Cell(20,8,round((($res[$i]['qs5']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();
				$pdf->Cell(10,8,$j++,1); $pdf->Cell(150,8,$q6,1); $pdf->Cell(20,8,round((($res[$i]['qs6']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();
				$y = $pdf->GetY(); $pdf->Cell(10,16,$j++,1); $pdf->MultiCell(150,8,$q7,1); $x = $pdf->getX(); $pdf->SetXY($x + 160,$y); $pdf->Cell(20,16,round((($res[$i]['qs7']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();
				$pdf->Cell(10,8,$j++,1); $pdf->Cell(150,8,$q8,1); $pdf->Cell(20,8,round((($res[$i]['qs8']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();
				$pdf->Cell(10,8,$j++,1); $pdf->Cell(150,8,$q9,1); $pdf->Cell(20,8,round((($res[$i]['qs9']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();
				$y = $pdf->GetY(); $pdf->Cell(10,16,$j++,1); $pdf->MultiCell(150,8,$q10,1); $x = $pdf->getX(); $pdf->SetXY($x + 160,$y); $pdf->Cell(20,16,round((($res[$i]['qs10']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();
				$y = $pdf->GetY(); $pdf->Cell(10,16,$j++,1); $pdf->MultiCell(150,8,$q11,1); $x = $pdf->getX(); $pdf->SetXY($x + 160,$y); $pdf->Cell(20,16,round((($res[$i]['qs11']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();				
				$pdf->Cell(10,8,$j++,1); $pdf->Cell(150,8,$q12,1); $pdf->Cell(20,8,round((($res[$i]['qs12']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();
				$pdf->Cell(10,8,$j++,1); $pdf->Cell(150,8,$q13,1); $pdf->Cell(20,8,round((($res[$i]['qs13']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();
				$pdf->Cell(10,8,$j++,1); $pdf->Cell(150,8,$q14,1); $pdf->Cell(20,8,round((($res[$i]['qs14']/($res[$i]['count']*10))*100),2),1,0,'C'); $pdf->Ln();			
				$pdf->Cell(180,8,$avg,0,0,'R');
			        $pdf->Ln();$pdf->Ln();
			        $pdf->SetFont('Arial','',10);
				$pdf->cell(10,6,"Rating: Poor-2, Average-4, Good-6, Very Good-8, Excellent-10",0,0,'L');$pdf->Ln();
			        $pdf->Cell(10,6,"Percentage Calculated (%) = (Sum of Students rating)/ No. of Students Submitted",0,0,'L');$pdf->Ln();
			        $pdf->Cell(10,6,"Overall Percentage = (Sum of Percentages Calculated)/14 ",0,0,'L');$pdf->Ln();
			}
				$j = 1;
				$pdf->AddPage();
				$pdf->SetFont('Arial','',14);
				$pdf->SetXY(0, 20);
				$pdf->SetLeftMargin(15);
				$pdf->Cell(180,10,"JNTUA College of Engineering, Kalikiri",0);
				$pdf->Image('images/jntuacek.png',160,15,25,25,'PNG');
				$pdf->Ln();
				$pdf->Cell(180,10,"Online Feedback Report",0);				
				$pdf->Ln();
				if($_GET['cr']=='D'){
					$cls = $cr_name[$_GET['cr']].' (R'.$_GET['reg'].') - '.$spec_name[$_GET['br']].' - '.$_GET['yr'].' yr '.$_GET['sem'].' sem (2019-2020)';
				}
				else{
					$cls = $cr_name[$_GET['cr']].' (R'.$_GET['reg'].') - '.$br_name[$_GET['br']].' - '.$_GET['yr'].' yr '.$_GET['sem'].' sem (2019-2020)';					
				}
				$pdf->Cell(50,8,"Class : "); $pdf->Cell(200,8,$cls,0); $pdf->Ln();
				if($feeds[1]==$feeds[2]){
					$feedtime = $feeds[1];
				}else{
					$feedtime = $feeds[1].'   -   '.$feeds[2];
				}
				$feedtime = $feeds[1];
				$pdf->Cell(50,8,"Date(s) of Feedback : "); $pdf->Cell(200,8,$feedtime,0); $pdf->Ln();								
				$pdf->Ln();
			for($i=0;$i<$res['ival'];$i++){
				$faculty_subject = "Faculty Name : ".$res[$i]['fid']."\nSubject Name : ".$res[$i]['sid'];
				$y = $pdf->getY();
				$pdf->MultiCell(160,8,$faculty_subject,1);
				$x = $pdf->getX(); $pdf->SetXY($x + 160,$y); 
				$avg = round($res[$i]['avg']*10,2).' %';
				$pdf->Cell(20,16,$avg,1,'C');
				$pdf->Ln();
			}
			$pdf->Output($name,'D',true);			
		}
	
	}

}
else {
  header('Location: index.php');
}
?>