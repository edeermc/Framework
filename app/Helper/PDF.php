<?php

namespace App\Helper;

use FPDF;

class PDF extends FPDF {
    public $PDFtitle;
    protected $javascript;
    protected $n_js;

    function __construct($t, $o = 'P', $u = 'mm', $s = 'A4'){
        parent::FPDF($o, $u, $s);
        $this->PDFtitle = $t;

        $this->SetTitle($this->PDFtitle);
        $this->SetAuthor('SICE México', true);
        $this->SetCreator('SICE México', true);
    }

    // Cabecera de página
    public function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->SetY(5);
        $this->MultiCell(80, 10, $this->PDFtitle, 'B', 'L');
        $this->SetY(5);
        $this->MultiCell(0, 10, utf8_decode('SICE México'), 'B', 'R');
        $this->Ln(5);
    }

    // Pie de página
    public function Footer() {
        $this->SetFont('Arial', 'I', 8);
        $this->SetY(-10);
        $this->MultiCell(80, 10, date('d/m/Y') . ' a las ' . date('H:i:s'), 'T', 'L');
        $this->SetY(-10);
        $this->MultiCell(0, 10, utf8_decode('Página ' . $this->PageNo() . ' de {nb}'), 'T', 'R');
    }

    function IncludeJS($script, $isUTF8 = true) {
        if(!$isUTF8)
            $script = utf8_encode($script);
        $this->javascript = $script;
    }
    
    function _putjavascript() {
        $this->_newobj();
        $this->n_js=$this->n;
        $this->_out('<<');
        $this->_out('/Names [(EmbeddedJS) '.($this->n+1).' 0 R]');
        $this->_out('>>');
        $this->_out('endobj');
        $this->_newobj();
        $this->_out('<<');
        $this->_out('/S /JavaScript');
        $this->_out('/JS '.$this->_textstring($this->javascript));
        $this->_out('>>');
        $this->_out('endobj');
    }

    function _putresources() {
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }

    function _putcatalog() {
        parent::_putcatalog();
        if (!empty($this->javascript)) {
            $this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>');
        }
    }

    public function setTitleStyle(){
        $this->SetFillColor(233, 233, 233);
        $this->SetFont('Helvetica', 'B', 9);
    }

    public function setBodyStyle(){
        $this->SetFillColor(255, 255, 255);
        $this->SetFont('Helvetica', '', 8);
    }

    public function generatePDF($type, $print = false){
        if ($print)
            $this->IncludeJS('print(true)');
        $this->Output(str_replace(' ', '', ucfirst($this->PDFtitle)) . '_' . date('YmdHis') . '.pdf', $type);
    }
}