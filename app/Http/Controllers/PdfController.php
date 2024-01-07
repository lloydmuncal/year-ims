<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use Storage;
use App;
use PDF;

class PdfController extends Controller
{

    public function filesSystem(){
        if(App::environment('development')){
            return 'fs_local';
        }else{
            return 'public';
        }
    }

    public function generatePDF(Request $file_name) {
        try {
            $pdf = new TCPDF();
        $pdf->SetAutoPageBreak(false);

        // Loop to add pages based on $file_name->tempNoPage
        $coverPath = 'Cover\\' . $file_name->SelectedCover;
        $coverImageData = Storage::disk($this->filesSystem())->get($coverPath);

        $pdf->AddPage();
        $pdf->Image('@' . $coverImageData, 0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), '', '', '', false, 300, '', false, false, 0);


        $backgroundPath1 = 'Background\\page0.PNG';
        $backgroundImageData1 = Storage::disk($this->filesSystem())->get($backgroundPath1);

        $pdf->AddPage();
        $pdf->Image('@' . $backgroundImageData1, 0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), '', '', '', false, 300, '', false, false, 0);

        $backgroundPath2 = 'Background\\page1.PNG';
        $backgroundImageData2 = Storage::disk($this->filesSystem())->get($backgroundPath2);
        $pdf->AddPage();
        $pdf->Image('@' . $backgroundImageData2, 0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), '', '', '', false, 300, '', false, false, 0);

        $backgroundPath3 = 'Background\\page2.PNG';
        $backgroundImageData3 = Storage::disk($this->filesSystem())->get($backgroundPath3);
        $pdf->AddPage();
        $pdf->Image('@' . $backgroundImageData3, 0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), '', '', '', false, 300, '', false, false, 0);

        $backgroundPath4 = 'Background\\page3.PNG';
        $backgroundImageData4 = Storage::disk($this->filesSystem())->get($backgroundPath4);

        $pdf->AddPage();
        $pdf->Image('@' . $backgroundImageData4, 0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), '', '', '', false, 300, '', false, false, 0);
       

        $backgroundPath = 'Background\\' . $file_name->SelectedBackground ;
        $backgroundImageData = Storage::disk($this->filesSystem())->get($backgroundPath);

        foreach ($file_name->tempNoPage as $item) {
            // Add a page to the PDF
            $pdf->AddPage();
            // Set the background image on each page
            $pdf->Image('@' . $backgroundImageData, 0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), '', '', '', false, 300, '', false, false, 0);


             // Set the font for the document (example: using Helvetica)
                $pdf->SetFont('helvetica', 'BI', 25);
                $pdf->SetXY(35, 40); // Set the coordinates where you want to add text
                $pdf->Cell(0, 10, $item[0]['Section'], 0, 1, 'L');


            foreach ($item as $index => $image) {
                $imagePath = 'student_pic\\' . $image['FileName'];
                $imageData = Storage::disk($this->filesSystem())->get($imagePath);
              
                if ($index === 0) {
                    $pdf->Image('@' . $imageData, 20, 53.5, 75, 105);
                    $pdf->SetLineWidth(1.5);
                    $pdf->SetDrawColor(128, 128, 128);
                    $pdf->Rect(20, 53.5, 75, 105, 'D');

                    $pdf->SetFont('helvetica', 'BI', 25);
                    $pdf->SetXY(44,147); // Set the coordinates where you want to add text
                    $pdf->Cell(0, 10,$image['Name'], 0, 1, 'L');
                }
                else if ($index === 1) {
                    $pdf->Image('@' . $imageData, 114, 53.5, 75, 105);
                    $pdf->SetLineWidth(1.5);
                    $pdf->SetDrawColor(128, 128, 128);
                    $pdf->Rect(114, 53.5, 75, 105, 'D');

                    $pdf->SetFont('helvetica', 'BI', 25);
                    $pdf->SetXY(140,147); // Set the coordinates where you want to add text
                    $pdf->Cell(0, 10,$image['Name'], 0, 1, 'L');
                }
                else if ($index === 2) {
                    $pdf->Image('@' . $imageData, 20, 172, 75, 105);
                    $pdf->SetLineWidth(1.5);
                    $pdf->SetDrawColor(128, 128, 128);
                    $pdf->Rect( 20, 172, 75, 105, 'D');


                    $pdf->SetFont('helvetica', 'BI', 25);
                    $pdf->SetXY(44,265); // Set the coordinates where you want to add text
                    $pdf->Cell(0, 10,$image['Name'], 0, 1, 'L');
        
                }
                else if ($index === 3) {
                    $pdf->Image('@' . $imageData, 114, 172, 75, 105);
                    $pdf->SetLineWidth(1.5);
                    $pdf->SetDrawColor(128, 128, 128);
                    $pdf->Rect(114, 172, 75, 105, 'D');

                    $pdf->SetFont('helvetica', 'BI', 25);
                    $pdf->SetXY(140,265); // Set the coordinates where you want to add text
                    $pdf->Cell(0, 10,$image['Name'], 0, 1, 'L');
                }
            }
        }

        $output = $pdf->Output('output.pdf', 'S');
        return response($output, 200)
            ->header('Content-Type', 'application/pdf');
        } catch (\Throwable $th) {
            return response()->json(["message"->$th],500);
        }
    }

    public function testprint(Request $file_name)
    {
        $coverPath = 'Cover\\' . $file_name->SelectedCover;
        $coverImageData = Storage::disk($this->filesSystem())->get($coverPath);

        $pagesData = [];
        $backgroundPath = 'Background\\' . $file_name->SelectedBackground;
        $backgroundImageData = Storage::disk($this->filesSystem())->get($backgroundPath);

        foreach ($file_name->tempNoPage as $item) {
            $pageData = [
                'background' => $backgroundImageData,
                'images' => [], // Array to store image data for the current page
            ];

            foreach ($item as $index => $image) {
                $imagePath = 'student_pic\\' . $image['FileName'];
                $imageData = Storage::disk($this->filesSystem())->get($imagePath);

                // Assuming you want to include each image in the 'images' array
                $pageData['images'][] = [
                    'path' => $imagePath,
                    'data' => $imageData,
                ];
            }

            $pagesData[] = $pageData;
        }
        // $pdf = Pdf::loadView('pdf.invoice', ['cover' => $coverImageData,'']);
        $pdf = Pdf::loadView('pdf.invoice', ['cover' => $coverImageData, 'pagesData' => $pagesData]);
        return $pdf->stream('invoice.pdf');
    }


}
