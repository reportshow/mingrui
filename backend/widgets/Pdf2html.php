<?php
namespace backend\widgets;

use yii\base\Widget;

class Pdf2html extends Widget
{

    public $report = [];
    public function run()
    {
        if ($this->report->pdfurl) {
            $pahtinfo = self::fileinfo($this->report);
            $pdfpath  = $pahtinfo['pdf'];
            $htmlpath = $pahtinfo['html'];
            if (!file_exists($htmlpath)) {
                $buf = file_get_contents($this->report->pdfurl);
                file_put_contents($pdfpath, $buf);
                $exe = "pdf2htmlEX  --embed-outline 0 --zoom 1.7 {$pdfpath} {$htmlpath}";

                exec($exe, $output);
            }

            $this->readhtml($htmlpath, $this->report);

        }

    }
    public function readhtml($file, $report)
    {
        $findme   = [];
        $findme[] = $report->sample->realname;
        $findme[] = $report->sample->doctor->hospital->name;
        // var_dump($findme);exit;
        $replace = '<span class="blur">赵钱孙李</span>';

        $handle = fopen($file, "rb");
        if (false === $handle) {
            exit("Failed to open stream");
        }
        $contents = '';
        $count    = 0;
        while (!feof($handle)) {
            $contents = fread($handle, 8192);
            if ($count == 0) {
                $contents = str_replace(
                    '<head>',
                    '<head><meta content="width=device-width, initial-scale=0.3, minimum-scale=0.1, maximum-scale=2, user-scalable=yes" name="viewport"/>',
                    $contents);
            }
            //$contents = str_replace($findme, $replace, $contents);
            if (strpos($contents, '送检单位')) {
              //  $contents = $this->replaceHospital($contents, $report->sample->doctor->hospital->name);
            }
            echo $contents;
        }
        echo "<style>@media screen and (max-width:768px) {
               #sidebar{display:none}
               #sidebar.opened{display:none}
               #sidebar.opened+#page-container{left:0px}
            }
           /* .blur{-webkit-filter: blur(6px);
                -filter: blur(6px);
            }*/
            </style>";

        fclose($handle);
    }
    public function replaceHospital($contents, $hospital)
    {
        $p0     = strpos($contents, '送检单位');
        $left   = substr($contents, 0, $p0);
        $middle = substr($contents, $p0, 300);
        $right  = substr($contents, $p0 + 300);
        for ($i = strlen($hospital); $i > 1; $i--) {
            $middle = str_replace(mb_substr($hospital, 0, $i), '', $middle);
            $middle = str_replace(mb_substr($hospital,  $i), '', $middle);
        }

        return $left . $middle . $right;
    }
    public static function fileinfo($report)
    {
        $rid      = $report->report_id;
        $pdfpath  = 'pdf/' . $rid . '.pdf';
        $htmlpath = 'pdf/' . $rid . '.html';
        return ['pdf' => $pdfpath, 'html' => $htmlpath];
    }

}
