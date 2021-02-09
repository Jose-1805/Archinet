<?php

namespace Archinet\Models;


use Archinet\User;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;

class Pdf extends Fpdf
{
    protected $width_page = 170;

    public $print_footer = true;
    public $es_hoja_vida = false;
    public $user = null;
    public $tope = 230;

    /*function __construct($orientation = 'P', $unit = 'mm', $size = 'A4')
    {
        parent::__construct($orientation, $unit, $size);
    }*/

    function __construct($print_footer, $es_hoja_vida = false, $user = null)
    {
        parent::__construct();
        $this->print_footer = $print_footer;
        $this->es_hoja_vida = $es_hoja_vida;
        $this->user = $user;
    }

    // Page header
    function Header()
    {
        if($this->es_hoja_vida){
            $width_titulo = 100;
            $this->width_page = 175;
            $margen = 20;
            $font_size = 9;

            $this->SetFont('Arial', '', 8);
            $this->Cell($this->width_page,'10','HOJA DE VIDA',0,0,'R');
            // Logo
            $this->Image('imagenes/logos/logo_sena.png',$margen,10,20);

            $this->SetFont('Arial', 'B', 12);
            $this->SetY(15);
            $this->Cell(($this->width_page-$width_titulo)/2,'25');
            $this->MultiCell($width_titulo,'5','SENA CENTRO DE COMERCIO Y SERVICIOS REGIONAL CAUCA',0,'C',false);
            $this->Image('imagenes/logos/logoarchinet.png',$this->width_page-5,8,35);
            $this->Ln(10);
            $this->Cell($this->width_page,'0','',0,0,'C',true);

            $this->Ln(1);
            $this->SetFont('Arial', 'B', $font_size);
            $this->Cell(40,'10','Nombre',0,0,'L');
            $this->SetFont('Arial', '', $font_size);
            $this->Cell($this->width_page-40,'10',utf8_decode($this->user->fullName()),0,0,'L');

            $this->Ln(5);
            $this->SetFont('Arial', 'B', $font_size);
            $this->Cell(40,'10',utf8_decode('Identificación'),0,0,'L');
            $this->SetFont('Arial', '', $font_size);
            $this->Cell($this->width_page-40,'10',utf8_decode($this->user->identificacion),0,0,'L');

            $this->Ln(5);
            $this->SetFont('Arial', 'B', $font_size);
            $this->Cell(40,'10',utf8_decode('Tipo documento'),0,0,'L');
            $this->SetFont('Arial', '', $font_size);
            $this->Cell($this->width_page-40,'10',utf8_decode($this->user->tipo_identificacion),0,0,'L');

            $this->Ln(12);


            return true;
        }
        // Logo
        $this->Image('imagenes/logos/logo_sena.png',($this->width_page/2)+10,10,20);
        $this->Ln(30);
    }

// Page footer
    function Footer()
    {
        if($this->print_footer) {
            if($this->es_hoja_vida){
                $this->width_page = 195;
                $this->SetY(-10);
                $this->Line(20,$this->GetY(),$this->width_page,$this->GetY());
                // Arial italic 8
                $this->SetFont('Arial', '', 9);
                $this->Cell($this->width_page,5,utf8_decode('Fecha de expedición: '.date('Y-m-d')),0,0,'L');
                $this->SetY(-10);
                $this->Cell($this->width_page-20,5,utf8_decode('Página: '.$this->PageNo()),0,0,'R');
                return true;
            }
            // Position at 1.5 cm from bottom
            $this->SetY(-35);
            // Arial italic 8
            $this->SetFont('Arial', '', 9);
            $this->Cell($this->width_page,5,utf8_decode('Ministerio de Trabajo.'),0,0,'C');

            $this->Ln(5);
            $this->SetFont('Arial', 'B', 9);
            $this->Cell($this->width_page,5,utf8_decode('SERVICIO NACIONAL DE APRENDIZAJE'),0,0,'C');
            $this->Ln(5);

            $this->Cell(20);
            $this->Cell($this->width_page-40,5,utf8_decode('Regional Cauca/ Despacho de Dirección/ Grupo Mixto'),'B',0,'C');
            $this->Cell(20);
            $this->SetFont('Arial', '', 9);
            $this->Ln(5);
            $this->Cell($this->width_page,5,utf8_decode('Direccion Calle 4 No 2 - 67, Ciudad Popayán. – teléfono 8242343'),0,0,'C');
            $this->Ln(5);
            $this->Cell($this->width_page,5,utf8_decode('www.sena.edu.co - Línea gratuita nacional: 01 8000 9 10 270 GD-F-011 V04 Pág. 1'),0,0,'C');


        }
    }

    public static function certificadoLaboralBasico(User $user, $tramite){

        $acta = Documento::actasPosesionNombramiento($user->id)->orderBy('numero_folio','DESC')->first();

        if(!$acta)return redirect('/');

        $metadatos = $acta->metadatos;


        $pdf = new Pdf(true);
        $pdf->SetMargins(20,0, 20);

        $tope = 230;
        $pdf->AddPage();
        DB::beginTransaction();
        $certificado = CertificadoLaboral::siguiente();
        $certificado->save();
        //agregamos datos generales
        //datos del propietario
        $pdf->SetFont('Arial', 'IB', 12);
        $pdf->cell($pdf->width_page,10,utf8_decode('Certificación No. '.$certificado->anio.' - '.$certificado->consecutivo),0,0);
        $pdf->Ln(20);
        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell($pdf->width_page,5,utf8_decode('EL COORDINADOR DEL GRUPO DE APOYO ADMINISTRATIVO MIXTO DE LA REGIONAL CAUCA'),0,'C');
        $pdf->Ln('20');
        $pdf->Cell($pdf->width_page,5,utf8_decode('CERTIFICA'),0,0,'C');

        $meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

        $texto_certificacion = 'Que el señor '.$user->fullName().', identificado con '.$user->tipo_identificacion.' No. '.$user->identificacion
            .', presta sus servicios a esta Entidad con nombramiento de '.$metadatos->tipo_nombramiento
            .', desde el '.date('d',strtotime($metadatos->fecha_nombramiento)).' de '.$meses[date('m',strtotime($metadatos->fecha_nombramiento))-1].' de '.date('Y',strtotime($metadatos->fecha_nombramiento))
            .', desempeñando a la fecha el cargo de '.$metadatos->cargo.' Grado '.$metadatos->grado.' del '.$metadatos->dependencia.' del SENA Regional Cauca';

        if($tramite == 'Trámite bancario'){
            $texto_certificacion .= ', con una asignación básica mensual de $ '.number_format($metadatos->salario,2,',','.').'.';
        }else{
            $texto_certificacion .= '.';
        }

        $pdf->Ln('20');
        $pdf->MultiCell($pdf->width_page,5,utf8_decode($texto_certificacion),0);


        $texto_certificacion = 'Se expide en Popayán, a los '.date('d').' días del mes de '.$meses[date('m')-1].' de '.date('Y').', para '.$tramite.'.';
        $pdf->Ln('5');
        $pdf->MultiCell($pdf->width_page,5,utf8_decode($texto_certificacion),0);

        $pdf->Ln('45');
        $pdf->Cell($pdf->width_page,5,utf8_decode('MILTON FABIAN DÍAZ MOSQUERA'),0,0,'C');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Ln('15');
        $pdf->Cell($pdf->width_page,5,utf8_decode('Revisó: Rigoberto Noguera.'),0,0,'L');
        $pdf->Ln('8');
        $pdf->Cell($pdf->width_page,5,utf8_decode('Proyectó: Diana Huila.'),0,0,'L');
        $pdf->Ln('5');
        $pdf->Cell($pdf->width_page,5,utf8_decode('Teléfono: 8242343- 8220122 IP 22021.'),0,0,'L');

        $pdf->SetFont('Arial', '', 5);
        $pdf->Image('imagenes/logos/LogoIcontec.png',($pdf->width_page+20),$tope-16,9.5);
        $pdf->Text($pdf->width_page + 19, $tope+2, 'Certificado No.');
        $pdf->Text($pdf->width_page + 18.5, $tope+4, 'SC-CER339681');

        $pdf->Image('imagenes/logos/LogoIonet.png',($pdf->width_page+17.5),$tope+7,15.5);
        $pdf->Text($pdf->width_page + 19, $tope+25, 'Certificado No.');
        $pdf->Text($pdf->width_page + 17.2, $tope+27, 'CO-SC-CER339681');

        $pdf->Output();
        DB::commit();
        exit;
    }

    public static function hojaVida(User $user){

        $pdf = new Pdf(true, true, $user);

        $pdf->SetMargins(20,0, 20);
        $font_size = 9;

        $pdf->tope = 250;
        $pdf->AddPage();

        $espacio_paneles = 10;

        /******************************
         ****** INICIO DATOS BÁSICOS **
         ******************************/
        $pdf->datosBasicos($font_size);
        $pdf->Ln($espacio_paneles);
        $pdf->informacionLaboralActual($font_size);
        $pdf->Ln($espacio_paneles);
        $pdf->educacionFormal($font_size);

        //si esta cerca al tope se agrega nueva página
        if($pdf->GetY() + 45 > $pdf->tope){
            $pdf->AddPage();
        }else{
            $pdf->Ln($espacio_paneles);
        }

        $pdf->educacionNoFormal($font_size);

        //si esta cerca al tope se agrega nueva página
        if($pdf->GetY() + 45 > $pdf->tope){
            $pdf->AddPage();
        }else{
            $pdf->Ln($espacio_paneles);
        }

        $pdf->experienciaLaboralExterna($font_size);

        //si esta cerca al tope se agrega nueva página
        if($pdf->GetY() + 45 > $pdf->tope){
            $pdf->AddPage();
        }else{
            $pdf->Ln($espacio_paneles);
        }

        $pdf->experienciaLaboralInterna($font_size);

        if($pdf->GetY() + 1 > $pdf->tope){
            $pdf->AddPage();
        }

        $pdf->SetY($pdf->tope - 1);

        $pdf->Cell(13,10,'Firma: ',0,0,'L',false);
        $pdf->SetY($pdf->tope+6);
        $pdf->SetX(33);
        $pdf->Line($pdf->GetX(),$pdf->GetY(),$pdf->GetX()+70,$pdf->GetY());

        $pdf->Output();
        exit;
    }

    public function datosBasicos($font_size){
        //ancho de cada columna de la seccion
        $w_col_1 = 30;
        $w_col_2 = 36;
        $w_col_3 = 22;
        $w_col_4 = 21;
        $w_col_5 = 30;
        $w_col_6 = 36;
        //TOTAL = 175; -> igual a width_page

        $this->SetFont('Arial', 'B', $font_size);
        $this->SetFillColor(200, 200, 200);
        $this->cell($this->width_page,10,utf8_decode('Datos Básicos'),1,0,'C',true);

        $this->Ln(12);
        $y = $this->GetY();
        $x = $this->GetX();

        $x_rect = $x;
        $y_rect = $y;

        $y += 2.5;
        //la posicion mas alta de y en cada fila del pdf
        $max_y = $y;

        /***************************+++
         **********PRIMERA FILA *******
         *****************************/

        //col_1
        $this->SetY($y);
        $this->SetX($x);
        $this->SetFont('Arial', 'B', $font_size);
        $this->MultiCell($w_col_1,4,utf8_decode('Dirección:'),0,'L');
        //si la posición actual es mas alta a la ultima en Y
        $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

        //col_2
        $this->SetY($y);
        $this->SetX($x += $w_col_1);
        $this->SetFont('Arial', '', $font_size);
        $this->MultiCell($w_col_2,4,utf8_decode($this->user->direccion),0,'L');
        //si la posición actual es mas alta a la ultima en Y
        $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

        //col_3
        $this->SetY($y);
        $this->SetX($x += $w_col_2);
        $this->SetFont('Arial', 'B', $font_size);
        $this->MultiCell($w_col_3,4,utf8_decode('Teléfono:'),0,'L');
        //si la posición actual es mas alta a la ultima en Y
        $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

        //col_4
        $this->SetY($y);
        $this->SetX($x += $w_col_3);
        $this->SetFont('Arial', '', $font_size);
        $this->MultiCell($w_col_4,4,utf8_decode($this->user->celular),0,'L');
        //si la posición actual es mas alta a la ultima en Y
        $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

        //col_5
        $this->SetY($y);
        $this->SetX($x += $w_col_4);
        $this->SetFont('Arial', 'B', $font_size);
        $this->MultiCell($w_col_5,4,utf8_decode('Fecha nacimiento:'),0,'L');
        //si la posición actual es mas alta a la ultima en Y
        $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

        //col_6
        $this->SetY($y);
        $this->SetX($x += $w_col_5);
        $this->SetFont('Arial', '', $font_size);
        $this->MultiCell($w_col_6,4,utf8_decode($this->user->fecha_nacimiento),0,'L');
        //si la posición actual es mas alta a la ultima en Y
        $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

        /***************************+++
         ******** SEGUNDA FILA ********
         *****************************/
        $y = $max_y+2;
        $x = $this->GetX();

        //col_1
        $this->SetY($y);
        $this->SetX($x);
        $this->SetFont('Arial', 'B', $font_size);
        $this->MultiCell($w_col_1,4,utf8_decode('Correo personal:'),0,'L');
        //si la posición actual es mas alta a la ultima en Y
        $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

        //col_2
        $this->SetY($y);
        $this->SetX($x += $w_col_1);
        $this->SetFont('Arial', '', $font_size);
        $this->MultiCell($w_col_2,4,utf8_decode($this->user->email_opcional),0,'L');
        //si la posición actual es mas alta a la ultima en Y
        $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

        //col_3
        $this->SetY($y);
        $this->SetX($x += $w_col_2);
        $this->SetFont('Arial', 'B', $font_size);
        $this->MultiCell($w_col_3,4,utf8_decode('Estado Civil:'),0,'L');
        //si la posición actual es mas alta a la ultima en Y
        $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

        //col_4
        $this->SetY($y);
        $this->SetX($x += $w_col_3);
        $this->SetFont('Arial', '', $font_size);
        $this->MultiCell($w_col_4,4,utf8_decode($this->user->estado_civil),0,'L');
        //si la posición actual es mas alta a la ultima en Y
        $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

        //col_5
        $this->SetY($y);
        $this->SetX($x += $w_col_4);
        $this->SetFont('Arial', 'B', $font_size);
        $this->MultiCell($w_col_5,4,utf8_decode('Título profesional:'),0,'L');
        //si la posición actual es mas alta a la ultima en Y
        $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

        //col_6


        $certificado_estudio = Documento::certificadosEstudio($this->user->id,true,'si')
            ->select('metadatos.titulo_obtenido')
            ->where('metadatos.nivel_estudio','Profesional')
            ->orderBy('metadatos.fecha_fin','DESC')->first();

        $titulo_obtenido = $certificado_estudio?$certificado_estudio->titulo_obtenido:'';

        $this->SetY($y);
        $this->SetX($x += $w_col_5);
        $this->SetFont('Arial', '', $font_size);
        $this->MultiCell($w_col_6,4,utf8_decode($titulo_obtenido),0,'L');
        //si la posición actual es mas alta a la ultima en Y
        $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

        $this->Rect($x_rect,$y_rect-1,$this->width_page,($this->GetY()-$y_rect)+5,'Draw');
    }

    public function informacionLaboralActual($font_size){
        //ancho de cada columna de la seccion
        $w_col_1 = 27;
        $w_col_2 = 38;
        $w_col_3 = 26;
        $w_col_4 = 37;
        $w_col_5 = 27;
        $w_col_6 = 20;
        //TOTAL = 175; -> igual a width_page

        $this->SetFont('Arial', 'B', $font_size);
        $this->SetFillColor(200, 200, 200);
        $this->cell($this->width_page,10,utf8_decode('Información Laboral Actual'),1,0,'C',true);

        $this->Ln(12);
        $y = $this->GetY();
        $x = $this->GetX();

        $x_rect = $x;
        $y_rect = $y;

        $y += 2.5;

        //la posicion mas alta de y en cada fila del pdf
        $max_y = $y;

        $acta = Documento::actasPosesionNombramiento($this->user->id)
            ->select('metadatos.*')->orderBy('metadatos.fecha_nombramiento','DESC')->first();

        if($acta) {
            /***************************+++
             **********PRIMERA FILA *******
             *****************************/

            //col_1
            $this->SetY($y);
            $this->SetX($x);
            $this->SetFont('Arial', 'B', $font_size);
            $this->MultiCell($w_col_1, 4, utf8_decode('Cargo:'), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            //col_2
            $this->SetY($y);
            $this->SetX($x += $w_col_1);
            $this->SetFont('Arial', '', $font_size);
            $this->MultiCell($w_col_2, 4, utf8_decode($acta->cargo.' Grado '.$acta->grado), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            //col_3
            $this->SetY($y);
            $this->SetX($x += $w_col_2);
            $this->SetFont('Arial', 'B', $font_size);
            $this->MultiCell($w_col_3, 4, utf8_decode('Nombramiento:'), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            //col_4
            $this->SetY($y);
            $this->SetX($x += $w_col_3);
            $this->SetFont('Arial', '', $font_size);
            $this->MultiCell($w_col_4, 4, utf8_decode($acta->tipo_nombramiento?$acta->tipo_nombramiento:$acta->tipo_novedad), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            //col_5
            $this->SetY($y);
            $this->SetX($x += $w_col_4);
            $this->SetFont('Arial', 'B', $font_size);
            $this->MultiCell($w_col_5, 4, utf8_decode('Estado:'), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            //col_6
            $this->SetY($y);
            $this->SetX($x += $w_col_5);
            $this->SetFont('Arial', '', $font_size);
            $this->MultiCell($w_col_6, 4, utf8_decode($this->user->estado), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            /***************************+++
             ******** SEGUNDA FILA ********
             *****************************/
            $y = $max_y+2;
            $x = $this->GetX();

            //col_1
            $this->SetY($y);
            $this->SetX($x);
            $this->SetFont('Arial', 'B', $font_size);
            $this->MultiCell($w_col_1, 4, utf8_decode('Fecha Nombramiento:'), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            //col_2
            $this->SetY($y);
            $this->SetX($x += $w_col_1);
            $this->SetFont('Arial', '', $font_size);
            $this->MultiCell($w_col_2, 4, utf8_decode($acta->fecha_nombramiento), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            //col_3
            $this->SetY($y);
            $this->SetX($x += $w_col_2);
            $this->SetFont('Arial', 'B', $font_size);
            $this->MultiCell($w_col_3, 4, utf8_decode('Dependencia:'), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            //col_4
            $this->SetY($y);
            $this->SetX($x += $w_col_3);
            $this->SetFont('Arial', '', $font_size);
            $this->MultiCell($w_col_4, 4, utf8_decode($acta->dependencia), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            //col_5
            $this->SetY($y);
            $this->SetX($x += $w_col_4);
            $this->SetFont('Arial', 'B', $font_size);
            $this->MultiCell($w_col_5, 4, utf8_decode('Sueldo Actual:'), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            //col_6
            $this->SetY($y);
            $this->SetX($x += $w_col_5);
            $this->SetFont('Arial', '', $font_size);
            $this->MultiCell($w_col_6, 4, utf8_decode('$ '. number_format($acta->salario, 0,'', '.')), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            /***************************+++
             ******** TERCERA FILA ********
             *****************************/
            $y = $max_y+2;
            $x = $this->GetX();

            //col_1
            $this->SetY($y);
            $this->SetX($x);
            $this->SetFont('Arial', 'B', $font_size);
            $this->MultiCell($w_col_1, 4, utf8_decode('Correo Istitucional:'), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            //col_2
            $this->SetY($y);
            $this->SetX($x += $w_col_1);
            $this->SetFont('Arial', '', $font_size);
            $this->MultiCell($w_col_2, 4, utf8_decode($this->user->email), 0, 'L');
            //si la posición actual es mas alta a la ultima en Y
            $max_y = $max_y < $this->GetY()?$this->GetY():$max_y;

            $this->Rect($x_rect, $y_rect - 1, $this->width_page, ($this->GetY() - $y_rect) + 8, 'Draw');
        }else{
            $this->SetFont('Arial', '', $font_size);
            $this->MultiCell($this->width_page, 10, utf8_decode('No se han registrado documentos con la información laboral actual del funcionario'), 1, 'C');
        }
    }

    public function educacionFormal($font_size){
        //ancho de cada columna de la seccion
        $w_col_1 = 27;
        $w_col_2 = 38;
        $w_col_3 = 26;
        $w_col_4 = 20;
        $w_col_5 = 21;
        $w_col_6 = 21;
        $w_col_7 = 22;
        //TOTAL = 175; -> igual a width_page

        //posiciones iniciales del rectangulo encabezado
        $x_rect = $this->GetX();
        $y_rect = $this->GetY();

        $this->SetFont('Arial', 'B', $font_size);
        $this->SetFillColor(200, 200, 200);
        $this->cell($this->width_page,10,utf8_decode('Educacion Formal'),0,0,'C',true);
        $this->Ln(10);

        $x = $this->GetX();
        $y = $this->GetY();
        //posicion más alta (para saber hasta donde dibujar el rectangulo)
        $max_y = $y;

        $this->MultiCell($w_col_1,10,utf8_decode('Nivel de Estudio'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_1);
        $this->MultiCell($w_col_2,10,utf8_decode('Título Obtenido'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_2);
        $this->MultiCell($w_col_3,10,utf8_decode('Institución'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_3);
        $this->MultiCell($w_col_4,10,utf8_decode('Grado'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_4);
        $this->MultiCell($w_col_5,10,utf8_decode('Fecha inicio'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_5);
        $this->MultiCell($w_col_6,10,utf8_decode('Fecha fin'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_6);
        $this->MultiCell($w_col_7,10,utf8_decode('Tiempo'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->Rect($x_rect,$y_rect,$this->width_page,$max_y-$y_rect,'D');

        $this->Ln(2);

        $certificados_formal = Documento::certificadosEstudio($this->user->id,true)
            ->select('metadatos.*')->orderBy('metadatos.fecha_nombramiento','DESC')->get();

        if(count($certificados_formal)) {
            /***************************+++******
             ***** CICLO PARA CADA REGISTRO *****
             ************************************/

            $x = $this->GetX();
            $y = $this->GetY();

            $x_rect = $x;
            $y_rect = $y;

            $y += 2.5;

            $max_y = $this->GetY();
            //for ($i=0;$i < 10;$i++)
            foreach ($certificados_formal as $certificado){
                //si esta cerca al tope se agrega nueva página
                if($y + 15 > $this->tope){
                    $this->Rect($x_rect, $y_rect - 1, $this->width_page, ($max_y - $y_rect)+5, 'Draw');
                    $this->AddPage();
                    $y = 60;
                    $y_rect = $y;
                    $max_y = $y;
                }

                //col_1
                $this->SetY($y);
                $this->SetX($x);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_1, 4, utf8_decode($certificado->nivel_estudio), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_2
                $this->SetY($y);
                $this->SetX($x += $w_col_1);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_2, 4, utf8_decode($certificado->titulo_obtenido), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_3
                $this->SetY($y);
                $this->SetX($x += $w_col_2);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_3, 4, utf8_decode($certificado->institucion), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_4
                $this->SetY($y);
                $this->SetX($x += $w_col_3);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_4, 4, utf8_decode($certificado->graduado), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_5
                $this->SetY($y);
                $this->SetX($x += $w_col_4);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_5, 4, utf8_decode($certificado->fecha_inicio), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_6
                $this->SetY($y);
                $this->SetX($x += $w_col_5);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_6, 4, utf8_decode($certificado->fecha_fin), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_7
                $this->SetY($y);
                $this->SetX($x += $w_col_6);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_7, 4, utf8_decode($certificado->duracion.' '.$certificado->tipo_duracion), 0, 'C');

                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                $y = ($max_y + 1);
                $x = $x_rect;

                $this->Line(20,$y,$this->width_page+20,$y);

                $y += 2;
            }

            $this->SetY($max_y);
            $this->Rect($x_rect, $y_rect - 1, $this->width_page, ($max_y - $y_rect)+5, 'Draw');
        }else{
            $this->SetFont('Arial', '', $font_size);
            $this->MultiCell($this->width_page, 10, utf8_decode('No se han registrado documentos de certificados de educación formal'), 1, 'C');
        }
    }

    public function educacionNoFormal($font_size){
        //ancho de cada columna de la seccion
        $w_col_1 = 37;
        $w_col_2 = 38;
        $w_col_3 = 35;
        $w_col_4 = 23;
        $w_col_5 = 21;
        $w_col_6 = 21;
        //TOTAL = 175; -> igual a width_page

        //posiciones iniciales del rectangulo encabezado
        $x_rect = $this->GetX();
        $y_rect = $this->GetY();

        $this->SetFont('Arial', 'B', $font_size);
        $this->SetFillColor(200, 200, 200);
        $this->cell($this->width_page,10,utf8_decode('Educacion No Formal'),0,0,'C',true);
        $this->Ln(10);

        $x = $this->GetX();
        $y = $this->GetY();
        //posicion más alta (para saber hasta donde dibujar el rectangulo)
        $max_y = $y;

        $this->MultiCell($w_col_1,10,utf8_decode('Nivel de Estudio'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_1);
        $this->MultiCell($w_col_2,10,utf8_decode('Nombre Curso'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_2);
        $this->MultiCell($w_col_3,10,utf8_decode('Institución'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_3);
        $this->MultiCell($w_col_4,10,utf8_decode('Fecha inicio'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_4);
        $this->MultiCell($w_col_5,10,utf8_decode('Fecha fin'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_5);
        $this->MultiCell($w_col_6,10,utf8_decode('Tiempo'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->Rect($x_rect,$y_rect,$this->width_page,$max_y-$y_rect,'D');

        $this->Ln(2);

        $certificados_no_formal = Documento::certificadosEstudio($this->user->id,false)
            ->select('metadatos.*')->orderBy('metadatos.fecha_nombramiento','DESC')->get();

        if(count($certificados_no_formal)) {
            /***************************+++******
             ***** CICLO PARA CADA REGISTRO *****
             ************************************/

            $x = $this->GetX();
            $y = $this->GetY();

            $x_rect = $x;
            $y_rect = $y;

            $y += 2.5;

            $max_y = $this->GetY();
            //for ($i=0;$i < 10;$i++)
            foreach ($certificados_no_formal as $certificado){
                //si esta cerca al tope se agrega nueva página
                if($y + 15 > $this->tope){
                    $this->Rect($x_rect, $y_rect - 1, $this->width_page, ($max_y - $y_rect)+5, 'Draw');
                    $this->AddPage();
                    $y = 60;
                    $y_rect = $y;
                    $max_y = $y;
                }

                //col_1
                $this->SetY($y);
                $this->SetX($x);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_1, 4, utf8_decode($certificado->nivel_estudio), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_2
                $this->SetY($y);
                $this->SetX($x += $w_col_1);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_2, 4, utf8_decode($certificado->nombre_curso), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_3
                $this->SetY($y);
                $this->SetX($x += $w_col_2);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_3, 4, utf8_decode($certificado->institucion), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_4
                $this->SetY($y);
                $this->SetX($x += $w_col_3);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_4, 4, utf8_decode($certificado->fecha_inicio), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_5
                $this->SetY($y);
                $this->SetX($x += $w_col_4);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_5, 4, utf8_decode($certificado->fecha_fin), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_6
                $this->SetY($y);
                $this->SetX($x += $w_col_5);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_6, 4, utf8_decode($certificado->duracion.' '.$certificado->tipo_duracion), 0, 'C');

                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                $y = ($max_y + 1);
                $x = $x_rect;

                $this->Line(20,$y,$this->width_page+20,$y);

                $y += 2;
            }

            $this->SetY($max_y);
            $this->Rect($x_rect, $y_rect - 1, $this->width_page, ($max_y - $y_rect)+5, 'Draw');
        }else{
            $this->SetFont('Arial', '', $font_size);
            $this->MultiCell($this->width_page, 10, utf8_decode('No se han registrado documentos de certificados de educación no formal'), 1, 'C');
        }
    }

    public function experienciaLaboralExterna($font_size){
        //ancho de cada columna de la seccion
        $w_col_1 = 40;
        $w_col_2 = 40;
        $w_col_3 = 30;
        $w_col_4 = 35;
        $w_col_5 = 30;

        //TOTAL = 175; -> igual a width_page

        //posiciones iniciales del rectangulo encabezado
        $x_rect = $this->GetX();
        $y_rect = $this->GetY();

        $this->SetFont('Arial', 'B', $font_size);
        $this->SetFillColor(200, 200, 200);
        $this->cell($this->width_page,10,utf8_decode('Experiencia laboral externa'),0,0,'C',true);
        $this->Ln(10);

        $x = $this->GetX();
        $y = $this->GetY();
        //posicion más alta (para saber hasta donde dibujar el rectangulo)
        $max_y = $y;

        $this->MultiCell($w_col_1,10,utf8_decode('Nombre empresa'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_1);
        $this->MultiCell($w_col_2,10,utf8_decode('Cargo'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_2);
        $this->MultiCell($w_col_3,10,utf8_decode('Fecha vinculación'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_3);
        $this->MultiCell($w_col_4,10,utf8_decode('Fecha terminacion'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_4);
        $this->MultiCell($w_col_5,10,utf8_decode('Tiempo laborado'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->Rect($x_rect,$y_rect,$this->width_page,$max_y-$y_rect,'D');

        $this->Ln(2);

        $certificados_laborales = Documento::certificacionesLaboralesExternas($this->user->id)
            ->select('metadatos.*')->orderBy('metadatos.fecha_terminacion','DESC')->get();

        if(count($certificados_laborales)) {
            /***************************+++******
             ***** CICLO PARA CADA REGISTRO *****
             ************************************/

            $x = $this->GetX();
            $y = $this->GetY();

            $x_rect = $x;
            $y_rect = $y;

            $y += 2.5;

            $max_y = $this->GetY();
            //for ($i=0;$i < 10;$i++)
            foreach ($certificados_laborales as $certificado){
                //si esta cerca al tope se agrega nueva página
                if($y + 15 > $this->tope){
                    $this->Rect($x_rect, $y_rect - 1, $this->width_page, ($max_y - $y_rect)+5, 'Draw');
                    $this->AddPage();
                    $y = 60;
                    $y_rect = $y;
                    $max_y = $y;
                }

                //col_1
                $this->SetY($y);
                $this->SetX($x);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_1, 4, utf8_decode($certificado->empresa), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_2
                $this->SetY($y);
                $this->SetX($x += $w_col_1);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_2, 4, utf8_decode($certificado->cargo_externa), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_3
                $this->SetY($y);
                $this->SetX($x += $w_col_2);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_3, 4, utf8_decode($certificado->fecha_vinculacion), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_4
                $this->SetY($y);
                $this->SetX($x += $w_col_3);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_4, 4, utf8_decode($certificado->fecha_terminacion), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_5
                $this->SetY($y);
                $this->SetX($x += $w_col_4);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_5, 4, utf8_decode($certificado->duracionStr($certificado->fecha_vinculacion,$certificado->fecha_terminacion)), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                $y = ($max_y + 1);
                $x = $x_rect;

                $this->Line(20,$y,$this->width_page+20,$y);

                $y += 2;
            }

            $this->SetY($max_y);
            $this->Rect($x_rect, $y_rect - 1, $this->width_page, ($max_y - $y_rect)+5, 'Draw');
        }else{
            $this->SetFont('Arial', '', $font_size);
            $this->MultiCell($this->width_page, 10, utf8_decode('No se han registrado documentos de certificaciones laborales externas'), 1, 'C');
        }
    }

    public function experienciaLaboralInterna($font_size){
        //ancho de cada columna de la seccion
        $w_col_1 = 37;
        $w_col_2 = 25;
        $w_col_3 = 25;
        $w_col_4 = 35;
        $w_col_5 = 21;
        $w_col_6 = 32;
        //TOTAL = 175; -> igual a width_page

        //posiciones iniciales del rectangulo encabezado
        $x_rect = $this->GetX();
        $y_rect = $this->GetY();

        $this->SetFont('Arial', 'B', $font_size);
        $this->SetFillColor(200, 200, 200);
        $this->cell($this->width_page,10,utf8_decode('Experiencia laboral interna'),0,0,'C',true);
        $this->Ln(10);

        $x = $this->GetX();
        $y = $this->GetY();
        //posicion más alta (para saber hasta donde dibujar el rectangulo)
        $max_y = $y;

        $this->MultiCell($w_col_1,10,utf8_decode('Cargo'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_1);
        $this->MultiCell($w_col_2,10,utf8_decode('Inicio'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_2);
        $this->MultiCell($w_col_3,10,utf8_decode('Terminación'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_3);
        $this->MultiCell($w_col_4,10,utf8_decode('Tipo nombramiento'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_4);
        $this->MultiCell($w_col_5,10,utf8_decode('Sueldo'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->SetY($y);
        $this->SetX($x += $w_col_5);
        $this->MultiCell($w_col_6,10,utf8_decode('Dependencia'),0,'C',true);
        $max_y = $this->GetY() > $max_y?$this->GetY():$max_y;

        $this->Rect($x_rect,$y_rect,$this->width_page,$max_y-$y_rect,'D');

        $this->Ln(2);

        $certificados_laborales = Documento::certificacionesLaborales($this->user->id)
            ->select('metadatos.*')->orderBy('metadatos.fecha_terminacion','DESC')->get();

        if(count($certificados_laborales)) {
            /***************************+++******
             ***** CICLO PARA CADA REGISTRO *****
             ************************************/

            $x = $this->GetX();
            $y = $this->GetY();

            $x_rect = $x;
            $y_rect = $y;

            $y += 2.5;

            $max_y = $this->GetY();
            //for ($i=0;$i < 10;$i++)
            foreach ($certificados_laborales as $certificado){
                //si esta cerca al tope se agrega nueva página
                if($y + 15 > $this->tope){
                    $this->Rect($x_rect, $y_rect - 1, $this->width_page, ($max_y - $y_rect)+5, 'Draw');
                    $this->AddPage();
                    $y = 60;
                    $y_rect = $y;
                    $max_y = $y;
                }

                //col_1
                $this->SetY($y);
                $this->SetX($x);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_1, 4, utf8_decode($certificado->cargo), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_2
                $this->SetY($y);
                $this->SetX($x += $w_col_1);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_2, 4, utf8_decode($certificado->fecha_vinculacion), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_3
                $this->SetY($y);
                $this->SetX($x += $w_col_2);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_3, 4, utf8_decode($certificado->fecha_terminacion), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_4
                $this->SetY($y);
                $this->SetX($x += $w_col_3);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_4, 4, utf8_decode($certificado->tipo_nombramiento), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_5
                $this->SetY($y);
                $this->SetX($x += $w_col_4);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_5, 4, utf8_decode('$ '.number_format($certificado->asignacion_mensual,0,',','.')), 0, 'C');
                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                //col_6
                $this->SetY($y);
                $this->SetX($x += $w_col_5);
                $this->SetFont('Arial', '', $font_size);
                $this->MultiCell($w_col_6, 4, utf8_decode('???????'), 0, 'C');

                //si la posición actual es mas alta a la ultima en Y
                $max_y = $max_y < $this->GetY() ? $this->GetY() : $max_y;

                $y = ($max_y + 1);
                $x = $x_rect;

                $this->Line(20,$y,$this->width_page+20,$y);

                $y += 2;
            }

            $this->SetY($max_y);
            $this->Rect($x_rect, $y_rect - 1, $this->width_page, ($max_y - $y_rect)+5, 'Draw');
        }else{
            $this->SetFont('Arial', '', $font_size);
            $this->MultiCell($this->width_page, 10, utf8_decode('No se han registrado documentos de certificaciones laborales internas'), 1, 'C');
        }
    }
}