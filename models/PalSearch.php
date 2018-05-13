<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use Yii;
use app\components\base\AppLabels;
use app\components\base\AppConstants;


/**
 * PalSearch represents the model behind the search form of `app\models\Pal`.
 */
class PalSearch extends Pal
{
    public $filename;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'driver_id', 'car_id', 'p_price', 'p_bruto', 'p_tarra', 'area_id'], 'integer'],
            [['p_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pal::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'driver_id' => $this->driver_id,
            'car_id' => $this->car_id,
            'area_id' => $this->area_id,
            'p_price' => $this->p_price,
            'p_date' => $this->p_date,
            'p_bruto' => $this->p_bruto,
            'p_tarra' => $this->p_tarra,
        ]);


        return $dataProvider;
    }

    public function export($month, $year) {

        $query = Pal::findBySql("SELECT * FROM pal where EXTRACT(MONTH FROM p_date) = $month AND EXTRACT(YEAR FROM p_date) = $year ORDER BY p_date ASC");

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // export to excel

        //main excel setup
        $objPHPExcel = new \PHPExcel();
        $filename = sprintf(AppConstants::REPORT_NAME_PAL, Date('dmYHis'));

        //Set default style
        $defaultStyleArray = [
            'font' => [
                'size' => 10
            ],
        ];

        //Get model
        $model = $dataProvider->getModels();

        $objPHPExcel->getDefaultStyle()->applyFromArray($defaultStyleArray);

        //Creating sheet
        $activeSheet = $objPHPExcel->createSheet(0);
        $activeSheet->setTitle(AppLabels::PAL);

        // set column width
        $activeSheet->getColumnDimension('A')->setWidth(15);
        $activeSheet->getColumnDimension('B')->setWidth(30);
        $activeSheet->getColumnDimension('C')->setWidth(20);
        $activeSheet->getColumnDimension('D')->setWidth(20);
        $activeSheet->getColumnDimension('E')->setWidth(40);

        $activeSheet->getColumnDimension('G')->setWidth(15);
        $activeSheet->getColumnDimension('H')->setWidth(30);
        $activeSheet->getColumnDimension('I')->setWidth(20);
        $activeSheet->getColumnDimension('J')->setWidth(20);
        $activeSheet->getColumnDimension('K')->setWidth(40);

        //header
        $activeSheet->mergeCells('A1:E2');
        $activeSheet->setCellValue('A1', sprintf("Laporan Penjualan Sawit ke PT. %s Bulan %s Tahun %s", AppLabels::PAL ,AppConstants::$month[$month], $year));

        $activeSheet->mergeCells('G1:K2');
        $activeSheet->setCellValue('G1', sprintf("Laporan Penjualan Sawit ke PT. %s Bulan %s Tahun %s", AppLabels::PAL ,AppConstants::$month[$month], $year));

        //header style
        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 16,
                'color' => [
                    'argb' => \PHPExcel_Style_Color::COLOR_WHITE
                ]
            ],
            'alignment' => [
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ],
            'fill' => [
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => ['argb' => 'FFC00000']
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => [
                        'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                    ]
                ]
            ]
        ];

        $activeSheet->getStyle('A1:E2')->applyFromArray($styleArray);
        $activeSheet->getStyle('G1:K2')->applyFromArray($styleArray);

        //body header
        $activeSheet->mergeCells('A3:A4');
        $activeSheet->mergeCells('B3:B4');
        $activeSheet->mergeCells('C3:C4');
        $activeSheet->mergeCells('D3:D4');
        $activeSheet->mergeCells('E3:E4');

        $activeSheet->setCellValue('A3', AppLabels::DATE );
        $activeSheet->setCellValue('B3', AppLabels::NAME);
        $activeSheet->setCellValue('C3', AppLabels::WEIGHT);
        $activeSheet->setCellValue('D3', AppLabels::PRICE);
        $activeSheet->setCellValue('E3', AppLabels::TOTAL);

        $activeSheet->mergeCells('G3:G4');
        $activeSheet->mergeCells('H3:H4');
        $activeSheet->mergeCells('I3:I4');
        $activeSheet->mergeCells('J3:J4');
        $activeSheet->mergeCells('K3:K4');

        $activeSheet->setCellValue('G3', AppLabels::DATE );
        $activeSheet->setCellValue('H3', AppLabels::NAME);
        $activeSheet->setCellValue('I3', AppLabels::WEIGHT);
        $activeSheet->setCellValue('J3', AppLabels::PRICE);
        $activeSheet->setCellValue('K3', AppLabels::TOTAL);

        //body header style
        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => [
                    'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                ]
            ],
            'alignment' => [
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ],
            'fill' => [
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => ['argb' => 'FFD9D9D9']
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => [
                        'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                    ]
                ]
            ]
        ];

        $activeSheet->getStyle('A3:A4')->applyFromArray($styleArray);
        $activeSheet->getStyle('B3:B4')->applyFromArray($styleArray);
        $activeSheet->getStyle('C3:C4')->applyFromArray($styleArray);
        $activeSheet->getStyle('D3:D4')->applyFromArray($styleArray);
        $activeSheet->getStyle('E3:E4')->applyFromArray($styleArray);

        $activeSheet->getStyle('G3:G4')->applyFromArray($styleArray);
        $activeSheet->getStyle('H3:H4')->applyFromArray($styleArray);
        $activeSheet->getStyle('I3:I4')->applyFromArray($styleArray);
        $activeSheet->getStyle('J3:J4')->applyFromArray($styleArray);
        $activeSheet->getStyle('K3:K4')->applyFromArray($styleArray);

        //main data
        $styleArray = [
            'alignment' => [
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => [
                        'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                    ]
                ]
            ],
        ];
        $rowIndex = 5;
        $weightTotal = 0;
        $priceTotal = 0;
        $date = 0;
        foreach($model as $key => $pal){
            $activeSheet->setCellValue('A'. $rowIndex, $date!=$pal->p_date ?  Yii::$app->formatter->asDate($pal->p_date, AppConstants::FORMAT_DATE_USER_SHOW_MONTH) : '');
            $activeSheet->setCellValue('B'. $rowIndex, $pal->area->a_name);
			$activeSheet->getStyle('C' . $rowIndex)->getNumberFormat()->setFormatCode('#,##');
            $activeSheet->setCellValue('C'. $rowIndex, $pal->netto);
            $activeSheet->setCellValue('D'. $rowIndex, Yii::$app->formatter->asCurrency($pal->p_price));
            $activeSheet->setCellValue('E'. $rowIndex, Yii::$app->formatter->asCurrency($pal->total));
            $activeSheet->getStyle('A' . $rowIndex)->applyFromArray($styleArray);
            $activeSheet->getStyle('B' . $rowIndex)->applyFromArray($styleArray);
            $activeSheet->getStyle('C' . $rowIndex)->applyFromArray($styleArray);
            $activeSheet->getStyle('D' . $rowIndex)->applyFromArray($styleArray);
            $activeSheet->getStyle('E' . $rowIndex)->applyFromArray($styleArray);
            $weightTotal+=$pal->netto;
            $priceTotal+=$pal->total;
            $rowIndex++;
            $date = $pal->p_date;
        }


        //footer
        $activeSheet->mergeCells('A' . $rowIndex . ':B' . $rowIndex);
        $styleArray = [
            'alignment' => [
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => [
                        'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                    ]
                ]
            ],
            'font' => [
                'bold' => true,
                'size' => 13,
                'color' => [
                    'argb' => \PHPExcel_Style_Color::COLOR_RED
                ]
            ],
            'fill' => [
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => ['argb' => 'FFD9D9D9']
            ],
        ];
        $activeSheet->getStyle('A' . $rowIndex . ':B' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->getStyle('C' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->getStyle('D' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->getStyle('E' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('A'. $rowIndex, AppLabels::TOTAL);
		$activeSheet->getStyle('C' . $rowIndex)->getNumberFormat()->setFormatCode('#,##');
        $activeSheet->setCellValue('C'. $rowIndex, $weightTotal);
        $activeSheet->setCellValue('E'. $rowIndex, Yii::$app->formatter->asCurrency($priceTotal));

        $rowIndex++;

        $activeSheet->mergeCells('C' . $rowIndex . ':D' . $rowIndex);
        $styleArray = [
            'alignment' => [
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => [
                        'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                    ]
                ]
            ],
            'font' => [
                'bold' => true,
                'size' => 13,
                'color' => [
                    'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                ]
            ],
            'fill' => [
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => ['argb' => \PHPExcel_Style_Color::COLOR_YELLOW]
            ],
        ];
        $activeSheet->getStyle('C' . $rowIndex . ':D' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('C'. $rowIndex, AppLabels::TAX);

        $activeSheet->getStyle('E' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('E'. $rowIndex, Yii::$app->formatter->asCurrency($priceTotal * (AppConstants::DEFAULT_PALM_TAX/100)));
        $rowIndex++;

        $activeSheet->mergeCells('C' . $rowIndex . ':D' . $rowIndex);
        $styleArray = [
            'alignment' => [
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => [
                        'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                    ]
                ]
            ],
            'font' => [
                'bold' => true,
                'size' => 13,
                'color' => [
                    'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                ]
            ],
            'fill' => [
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => ['argb' => \PHPExcel_Style_Color::COLOR_YELLOW]
            ],
        ];
        $activeSheet->getStyle('C' . $rowIndex . ':D' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('C'. $rowIndex, AppLabels::PALM_VILLAGE_FEE);

        $activeSheet->getStyle('E' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('E'. $rowIndex, Yii::$app->formatter->asCurrency($weightTotal*AppConstants::DEFAULT_PALM_VILLAGE_FEE));
        $rowIndex++;

        $activeSheet->mergeCells('C' . $rowIndex . ':D' . $rowIndex);
        $styleArray = [
            'alignment' => [
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => [
                        'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                    ]
                ]
            ],
            'font' => [
                'bold' => true,
                'size' => 13,
                'color' => [
                    'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                ]
            ],
            'fill' => [
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => ['argb' => \PHPExcel_Style_Color::COLOR_YELLOW]
            ],
        ];
        $activeSheet->getStyle('C' . $rowIndex . ':D' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('C'. $rowIndex, AppLabels::TOTAL);

        $activeSheet->getStyle('E' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('E'. $rowIndex, Yii::$app->formatter->asCurrency($priceTotal-($priceTotal*AppConstants::DEFAULT_PALM_TAX/100)-($weightTotal*AppConstants::DEFAULT_PALM_VILLAGE_FEE)));

        //main data 2
        $styleArray = [
            'alignment' => [
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => [
                        'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                    ]
                ]
            ],
        ];
        $rowIndex = 5;
        $weightTotal = 0;
        $priceTotal = 0;
        $date = 0;
        foreach($model as $key => $pal){
            $activeSheet->setCellValue('G'. $rowIndex, $date!=$pal->p_date ?  Yii::$app->formatter->asDate($pal->p_date, AppConstants::FORMAT_DATE_USER_SHOW_MONTH) : '');
            $activeSheet->setCellValue('H'. $rowIndex, $pal->area->a_name);
			$activeSheet->getStyle('I' . $rowIndex)->getNumberFormat()->setFormatCode('#,##');
            $activeSheet->setCellValue('I'. $rowIndex, $pal->netto);
            $activeSheet->setCellValue('J'. $rowIndex, Yii::$app->formatter->asCurrency($pal->p_price-50));
            $activeSheet->setCellValue('K'. $rowIndex, Yii::$app->formatter->asCurrency($pal->netto*($pal->p_price-50)));
            $activeSheet->getStyle('G' . $rowIndex)->applyFromArray($styleArray);
            $activeSheet->getStyle('H' . $rowIndex)->applyFromArray($styleArray);
            $activeSheet->getStyle('I' . $rowIndex)->applyFromArray($styleArray);
            $activeSheet->getStyle('J' . $rowIndex)->applyFromArray($styleArray);
            $activeSheet->getStyle('K' . $rowIndex)->applyFromArray($styleArray);
            $weightTotal+=$pal->netto;
            $priceTotal+=$pal->netto*($pal->p_price-50);
            $rowIndex++;
            $date = $pal->p_date;
        }


        //footer 2
        $activeSheet->mergeCells('G' . $rowIndex . ':H' . $rowIndex);
        $styleArray = [
            'alignment' => [
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => [
                        'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                    ]
                ]
            ],
            'font' => [
                'bold' => true,
                'size' => 13,
                'color' => [
                    'argb' => \PHPExcel_Style_Color::COLOR_RED
                ]
            ],
            'fill' => [
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => ['argb' => 'FFD9D9D9']
            ],
        ];
        $activeSheet->getStyle('G' . $rowIndex . ':H' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->getStyle('I' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->getStyle('J' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->getStyle('K' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('G'. $rowIndex, AppLabels::TOTAL);
		$activeSheet->getStyle('I' . $rowIndex)->getNumberFormat()->setFormatCode('#,##');
        $activeSheet->setCellValue('I'. $rowIndex, $weightTotal);
        $activeSheet->setCellValue('K'. $rowIndex, Yii::$app->formatter->asCurrency($priceTotal));

        $rowIndex++;

        $activeSheet->mergeCells('I' . $rowIndex . ':J' . $rowIndex);
        $styleArray = [
            'alignment' => [
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => [
                        'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                    ]
                ]
            ],
            'font' => [
                'bold' => true,
                'size' => 13,
                'color' => [
                    'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                ]
            ],
            'fill' => [
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => ['argb' => \PHPExcel_Style_Color::COLOR_YELLOW]
            ],
        ];
        $activeSheet->getStyle('I' . $rowIndex . ':J' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('I'. $rowIndex, AppLabels::TAX);

        $activeSheet->getStyle('K' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('K'. $rowIndex, Yii::$app->formatter->asCurrency($priceTotal * (AppConstants::DEFAULT_PALM_TAX/100)));
        $rowIndex++;

        $activeSheet->mergeCells('I' . $rowIndex . ':J' . $rowIndex);
        $styleArray = [
            'alignment' => [
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => [
                        'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                    ]
                ]
            ],
            'font' => [
                'bold' => true,
                'size' => 13,
                'color' => [
                    'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                ]
            ],
            'fill' => [
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => ['argb' => \PHPExcel_Style_Color::COLOR_YELLOW]
            ],
        ];
        $activeSheet->getStyle('I' . $rowIndex . ':J' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('I'. $rowIndex, AppLabels::PALM_VILLAGE_FEE);

        $activeSheet->getStyle('K' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('K'. $rowIndex, Yii::$app->formatter->asCurrency($weightTotal*AppConstants::DEFAULT_PALM_VILLAGE_FEE));
        $rowIndex++;

        $activeSheet->mergeCells('I' . $rowIndex . ':J' . $rowIndex);
        $styleArray = [
            'alignment' => [
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ],
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    'color' => [
                        'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                    ]
                ]
            ],
            'font' => [
                'bold' => true,
                'size' => 13,
                'color' => [
                    'argb' => \PHPExcel_Style_Color::COLOR_BLACK
                ]
            ],
            'fill' => [
                'type' => \PHPExcel_Style_Fill::FILL_SOLID,
                'startcolor' => ['argb' => \PHPExcel_Style_Color::COLOR_YELLOW]
            ],
        ];
        $activeSheet->getStyle('I' . $rowIndex . ':J' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('I'. $rowIndex, AppLabels::TOTAL);

        $activeSheet->getStyle('K' . $rowIndex)->applyFromArray($styleArray);
        $activeSheet->setCellValue('K'. $rowIndex, Yii::$app->formatter->asCurrency($priceTotal-($priceTotal*AppConstants::DEFAULT_PALM_TAX/100)-($weightTotal*AppConstants::DEFAULT_PALM_VILLAGE_FEE)));

        $objPHPExcel->removeSheetByIndex($objPHPExcel->getSheetCount() - 1);
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save(Yii::getAlias(AppConstants::THEME_EXCEL_EXPORT_DIR) . $filename);

        $this->filename = $filename;

        return true;
    }
}
