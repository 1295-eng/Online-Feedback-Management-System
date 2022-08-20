<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& ($_SESSION['priv']="admin" || strtolower($_SESSION['user'])=="administrator") && !empty($_SESSION['branch'])){
  require_once("cgs.php");
  require_once('fpdf/fpdf.php');


  $obj = new CGS();

  $res = $obj->getFacByBranch($_SESSION['branch']);
echo $_SESSION['branch'];
  if(!empty($res['status']) && $res['status']==1 && !empty($res['count'])){
    $q1 = 'Teacher comes to the class on time';
    $q2 = 'Teacher speaks clearly and audibly';
    $q3 = 'Teacher plans lesson with clear objective';
    $q4 = 'Teacher has got command on the subject';
    $q5 = 'Teacher writes and draws legibly';
    $q6 = 'Teacher asks questions to promote interaction and effective thinking';
    $q7 = 'Teacher encourages,compliments and praises originality and creativity displayed by the student';
    $q8 = 'Teacher is courteous and impartial in dealing with the students';
    $q9 = 'Teacher covers the syllabus completely';
    $q10 = 'Teacher evaluation of the sessional exams answer scripts, lab records etc is fair and impartial';
    $q11 = 'Teacher is prompt in valuing and returning the answer scripts providing feedback on performance';
    $q12 = 'Teacher offers assistance and counseling to the needy students';
    $q13 = 'Teacher imparts the practical knowledge concerned to the subject';
    $q14 = 'Teacher leaves the class on time';
    $pdf = new FPDF();
    $pdf->SetFont('Arial','',14);


    for($i=0;$i<$res['count'];$i++){
		if(isset($res2)){
			unset($res2);
		}
		$res2 = $obj->getStaffFeed($res['names'][$i]);
var_dump($res);
      if(!empty($res2['status']) && $res2['status']==1 && !empty($res2['ival'])){

        $j = 1;
        $pdf->AddPage();
        if($res2['ival']>2){
          $xval = 90;
          $colwidth = 15;
          $fontsize = 11;
        }else{
          $xval = 100;
          $colwidth = 20;
          $fontsize = 12;
        }
        $pdf->SetFont('Arial','',$fontsize);
        $setxyxval = $xval+10;

        $pdf->SetXY(0, 20);
        $pdf->SetLeftMargin(15);
        $pdf->Cell(180,10,"JNTUA College of Engineering, Ananthapuramu",0);
        $pdf->Image('images/jntuacea.png',130,15,25,25,'PNG');
        $pdf->Ln();
        $pdf->Cell(180,10,"Online Feedback Report",0);
        $pdf->Ln();
        $pdf->Cell(50,8,"Name of the faculty : "); $pdf->Cell(200,8,$res['names'][$i],0); $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(10,8,$j++,1); $pdf->Cell($xval,8,$q1,1); $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs1"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,8,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,8,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();
        $pdf->Cell(10,8,$j++,1); $pdf->Cell($xval,8,$q2,1); $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs2"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,8,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,8,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();
        $pdf->Cell(10,8,$j++,1); $pdf->Cell($xval,8,$q3,1); $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs3"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,8,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,8,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();
        $pdf->Cell(10,8,$j++,1); $pdf->Cell($xval,8,$q4,1); $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs4"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,8,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,8,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();
        $pdf->Cell(10,8,$j++,1); $pdf->Cell($xval,8,$q5,1); $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs5"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,8,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,8,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();
        $y = $pdf->GetY(); $pdf->Cell(10,16,$j++,1); $pdf->MultiCell($xval,8,$q6,1); $x = $pdf->getX(); $pdf->SetXY($x + $setxyxval,$y);
        $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs6"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,16,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,16,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();
        $y = $pdf->GetY(); $pdf->Cell(10,16,$j++,1); $pdf->MultiCell($xval,8,$q7,1); $x = $pdf->getX(); $pdf->SetXY($x + $setxyxval,$y);
        $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs7"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,16,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,16,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();
        $y = $pdf->GetY(); $pdf->Cell(10,16,$j++,1); $pdf->MultiCell($xval,8,$q8,1); $x = $pdf->getX(); $pdf->SetXY($x + $setxyxval,$y);
        $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs8"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,16,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,16,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();
        $pdf->Cell(10,8,$j++,1); $pdf->Cell($xval,8,$q9,1);
        $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs9"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,8,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,8,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();
        $y = $pdf->GetY(); $pdf->Cell(10,16,$j++,1); $pdf->MultiCell($xval,8,$q10,1); $x = $pdf->getX(); $pdf->SetXY($x + $setxyxval,$y);
        $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs10"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,16,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,16,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();
        $y = $pdf->GetY(); $pdf->Cell(10,16,$j++,1); $pdf->MultiCell($xval,8,$q11,1); $x = $pdf->getX(); $pdf->SetXY($x + $setxyxval,$y);
        $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs11"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,16,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,16,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();
        $y = $pdf->GetY(); $pdf->Cell(10,16,$j++,1); $pdf->MultiCell($xval,8,$q12,1); $x = $pdf->getX(); $pdf->SetXY($x + $setxyxval,$y);
        $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs12"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,16,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,16,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();
        $y = $pdf->GetY(); $pdf->Cell(10,16,$j++,1); $pdf->MultiCell($xval,8,$q13,1); $x = $pdf->getX(); $pdf->SetXY($x + $setxyxval,$y);
        $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs13"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,16,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,16,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();
        $pdf->Cell(10,8,$j++,1); $pdf->Cell($xval,8,$q14,1); $totperc = 0; for($k=0;$k<$res2["ival"];$k++){ $perc = round((($res2[$k]["qs14"]/($res2[$k]["count"]*10))*100),1); $totperc += $perc; $pdf->Cell($colwidth,8,$perc."",1,0,"C"); } $pdf->SetFont('Arial','B',$fontsize); $totperc = round($totperc/$res2['ival'],1); $tot[$j] = $totperc; $pdf->Cell($colwidth,8,$totperc."",1,0,"C"); $pdf->SetFont('Arial','',$fontsize); $pdf->Ln();

        $avg = 0;
        for($i=2;$i<16;$i++){
          $avg += $tot[$i];
        }
        $avg = round(($avg/14),2);
        $pdf->Cell(180,8,$avg.' %',0,0,'R');
        $pdf->Ln();$pdf->Ln();

        $pdf->SetFont('Arial','',10);
        $pdf->Cell(10,6,"Percentage Calculated (%) = (Sum of Students rating)/ No. of Students Submitted",0,0,'L');$pdf->Ln();
        $pdf->Cell(10,6,"Overall Percentage = (Sum of Percentages Calculated)/14 ",0,0,'L');$pdf->Ln();

      }
    }
    $name = $_SESSION['branch'].".pdf";
    $pdf->Output($name,'D',true);
  }
}else{
  header('Location: ./');
}





?>
