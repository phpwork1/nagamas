<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use Yii;
use app\components\base\AppLabels;
use app\components\base\AppConstants;


/**
 * RamSearch represents the model behind the search form of `app\models\Ram`.
 */
class RamSearch extends Ram
{
    public $filename;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'driver_id', 'car_id', 'r_price', 'r_bruto', 'r_tarra', 'area_id'], 'integer'],
            [['r_date'], 'safe'],
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
        $query = Ram::find();

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
            'r_date' => $this->r_date,
            'r_price' => $this->r_price,
            'r_bruto' => $this->r_bruto,
            'r_tarra' => $this->r_tarra,
        ]);


        return $dataProvider;
    }

    public function export($month, $year) {

        $query = Ram::findBySql("SELECT * FROM ram where EXTRACT(MONTH FROM r_date) = $month AND EXTRACT(YEAR FROM r_date) = $year ORDER BY r_date ASC");

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
        $filename = sprintf(AppConstants::REPORT_NAME_RAM, Date('dmYHis'));

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
        $activeSheet->setTitle(AppLabels::RAM);

        // set column width
        $activeSheet->getColumnDimension('A')->setWidth(15);
        $activeSheet->getColumnDimension('B')->setWidth(30);
        $activeSheet->getColumnDimension('C')->setWidth(20);
        $activeSheet->getColumnDimension('D')->setWidth(20);
        $activeSheet->getColumnDimension('E')->setWidth(40);

        //header
        $activeSheet->mergeCells('A1:E2');
        $activeSheet->setCellValue('A1', sprintf("Laporan Penjualan Sawit ke PT. %s Bulan %s Tahun %s", AppLabels::BAM ,AppConstants::$month[$month], $year));

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
        foreach($model as $key => $ram){
            $activeSheet->setCellValue('A'. $rowIndex, $date!=$ram->r_date ?  Yii::$app->formatter->asDate($ram->r_date, AppConstants::FORMAT_DATE_USER_SHOW_MONTH) : '');
            $activeSheet->setCellValue('B'. $rowIndex, $ram->area->a_name);
			$activeSheet->getStyle('C' . $rowIndex)->getNumberFormat()->setFormatCode('#,##');
            $activeSheet->setCellValue('C'. $rowIndex, $ram->netto);
            $activeSheet->setCellValue('D'. $rowIndex, Yii::$app->formatter->asCurrency($ram->r_price));
            $activeSheet->setCellValue('E'. $rowIndex, Yii::$app->formatter->asCurrency($ram->total));
            $activeSheet->getStyle('A' . $rowIndex)->applyFromArray($styleArray);
            $activeSheet->getStyle('B' . $rowIndex)->applyFromArray($styleArray);
            $activeSheet->getStyle('C' . $rowIndex)->applyFromArray($styleArray);
            $activeSheet->getStyle('D' . $rowIndex)->applyFromArray($styleArray);
            $activeSheet->getStyle('E' . $rowIndex)->applyFromArray($styleArray);
            $weightTotal+=$ram->netto;
            $priceTotal+=$ram->total;
            $rowIndex++;
            $date = $ram->r_date;
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

        $objPHPExcel->removeSheetByIndex($objPHPExcel->getSheetCount() - 1);
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save(Yii::getAlias(AppConstants::THEME_EXCEL_EXPORT_DIR) . $filename);

        $this->filename = $filename;

        return true;
    }
}
