<?php 

namespace App\Controllers;

use chillerlan\QRCode\QROptions;
use App\QR\Image\QRImageWithLogo;
use App\QR\Options\LogoOptions;
use chillerlan\QRCode\QRCode;
use \Mpdf\Mpdf;
class PdfController extends BaseController{

    public function index(){
        return view('pdf_view');
    }

    public function htmlToPDF($year = 0, $section = ""){
        $dompdf = new \Dompdf\Dompdf();
        $getYear = $year;
        $getSection = $section;
        $queryBuilder = $this->studentModel->select("*")->where("GRADE", $getYear)->where("SECTION", $getSection)->get();
        $data = [
            'sectionData' => $queryBuilder,
            'section' => $getSection
        ];

        $dompdf->loadHtml(view('pdf_view', $data));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream(); 
    }

    public function studenHTMLTOPDF($id = 0,){
       
        $getID = $id;
        $queryBuilder = $this->studentModel->where("ID", $getID)->first();
        $fName = $queryBuilder['FIRSTNAME'];
        $lName = $queryBuilder['LASTNAME'];
        $mName = $queryBuilder['MIDDLENAME'];
        $grade = $queryBuilder['GRADE'];
        $section = $queryBuilder['SECTION'];
        $gender = $queryBuilder['GENDER'];
        $LRN = $queryBuilder['LRN'];
        $qr = $fName . " " . $lName . " " . $mName . " " .$LRN . " " . $gender . " " . $grade . " " . $section;;
        $decryptedQRCode = password_verify($qr, $queryBuilder['QR']);
        if ($decryptedQRCode) {
            $qrCode = $qr;
        } else {
            $qrCode = null; 
        }
        $qrCode = ($decryptedQRCode) ? $qr : null;
        $options = new QROptions(
            [
              'eccLevel' => QRCode::ECC_L,
              'outputType' => QRCode::OUTPUT_MARKUP_SVG,
              'version' => 5,
            ]
          );
          
        $generateQR = (new QRCode($options))->render($qrCode);
          
        $finalTest = "C:/Users/Solutions Resource/Projects/Web-and-Mobile-Attendance-System/public/uploads/qr-code/TESTER.png";
        $malePicture = "C:/Users/Solutions Resource/Projects/Web-and-Mobile-Attendance-System/public/uploads/male.png";
        $femalePicture = "C:/Users/Solutions Resource/Projects/Web-and-Mobile-Attendance-System/public/uploads/female.png";
        $picture = ($gender == "1") ? "<p style='text-align:center;'><img width='200'"." src="."'".$malePicture."'/> </p>" : "<p style='text-align:center;'> <img width='200'"." src="."'".$femalePicture."'/></p>";
        $html = "";
        $html .= $picture;
        $html .= "<p style='font-size:30px;text-align:center;font-weight:bold'>".$fName." ".$lName."</p>";
        $html .= "<p style='font-size:30px;text-align:center;font-weight:bold'>"."LRN:".$LRN."</p>";
        $html .= "<p style='font-size:30px;text-align:center;font-weight:bold'>"."Grade ".((int)$grade + 6)." & Section ".$section."</p>"; 
        $html .=  "<p style='text-align:center;' > <img width='450px'"." src="."'".$generateQR."'/> </p>";
        $mpdf = new \Mpdf\Mpdf();
        
        $mpdf->SetHeader("Student Data|2022-2023|{PAGENO}");
        $mpdf->SetFooter("PCCAHS_MANILA|Lagarde & et. al.|{PAGENO}");
        $mpdf->WriteHTML($html);
        $mpdf->Output();
        return redirect()->to($mpdf->Output('student_data.pdf','I'));
    
    }
}
?>