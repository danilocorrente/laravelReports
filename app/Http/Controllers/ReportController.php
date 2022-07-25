<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ContagensModel;
use App\Models\InvRelaAuditoriaModel;
use PdfReport;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    //
    public $headerTemplate = "";

    

    public function domPDF(Request $request){
        
        $queryBuilder = InvRelaAuditoriaModel::select(['cad_desc','sec_secao','codcontagem','con_ean','con_cadcodint','ros_nome','ros_id'])->where("codrelauditoria",26)
        ->join("contagens","codcontagem","con_id")
        ->join("cadastro","cad_ean","con_ean")
        ->join("roster","contagens.hor_matricula","ros_matricula")->orderBy("ros_nome")->get();

        $data = array('infos' => $queryBuilder);
        $pdf = Pdf::loadView('relatorios.AuditoriaDeLote', $data);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
        
        return $pdf->download('invoice.pdf');


    }
    public function index(Request $request)
    {
        // $fromDate = $request->input('from_date');
        // $toDate = $request->input('to_date');
        // $sortBy = $request->input('sort_by');
    
        $title =    '<table cellpadding="0" cellspacing="0" width="100%" border="0">
                        <tr>
                            <td>Imagem</td>
                            <td>Latin America Inventory Service<br><span style="font-size:10px"CNPJ: 27.690.850/0001-15</span></td>
                            <td>0026</td>
                        </tr>
                        <tr class="smallFont" style="border-collapse: collapse; outline: thin solid">
                            <td class="smallFont mt-1">Cliente: <b>GPA - MINUTO PA (6765)</b></td>
                            <td class="smallFont mt-1">Gerente: <b>RENATA</b></td>
                            <td class="smallFont mt-1">Nº da OS: <b1.605.190.0G/PA22</b></td>
                        </tr>
                        <tr class="smallFont">
                            <td>Endereço: <b>CORONEL SILVA TELES Nº 170 |</b></td>
                            <td>Líder: <b>RICHARD RODRIGUES DE OLIVEIRA</b></td>
                            <td>Data Inventário: <b>16/05/2022 (Seg) - 19:00</b></td>
                        </tr>
                        <tr style="border-collapse: collapse; outline: thin solid">
                        <td colspan="3" class="midFont"><u>Relatório de auditoria de lote</u></td>
                        </tr>
                    </table>'; // Report title
    
        $meta = [ // For displaying filters description on header
            'xpto on' => "<span style='color:red;'>Dester</span>",
        ];
    
        $queryBuilder = InvRelaAuditoriaModel::select(['cad_desc','sec_secao','codcontagem','con_ean','con_cadcodint','ros_nome','ros_id'])->where("codrelauditoria",26)
        ->join("contagens","codcontagem","con_id")
        ->join("cadastro","cad_ean","con_ean")
        ->join("roster","contagens.hor_matricula","ros_matricula");
        
                            // ->whereBetween('registered_at', [$fromDate, $toDate])
                            // ->orderBy($sortBy);
    
                            // dd($queryBuilder->get());
        $columns = [ // Set Column to be displayed
            'Colaborador' => function($ref){ return $ref->ros_nome;},
            'Ref.' => function($ref){ return $ref->codcontagem;},
            'Seção' => function($ref){ return $ref->sec_secao;},
            'EAN' => function($ref){ return $ref->con_ean;},
            'PLU' => function($ref){ return $ref->con_cadcodint;},
            'Descrição Produto' => function($ref){ return $ref->cad_desc;},
            'Qde.' => function($ref){ return $ref->primeiraqde;},
            'Ajuste.' => function($ref){ return "";},
            'Status' => function($customer) { // You can do data manipulation, if statement or any action do you want inside this closure
                return $customer->con_ean;
                // return ($customer->balance > 100000) ? 'Rich Man' : 'Normal Guy';
            }
            // 'Registered At', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
            // 'Status' => function($result) { // You can do if statement or any action do you want inside this closure
            //     return ($result->balance > 100000) ? 'Rich Man' : 'Normal Guy';
            // }
        ];
    
        $PdfGenerate = PdfReport::of($title, $meta, $queryBuilder, $columns)
        ->editColumn('Colaborador', [
            'class' => 'right none bolder italic-red'
        ])->setCss([
            // '.none' => 'display:none;',
            // '.italic-red' => 'color: red;font-style: italic;'
        ])
        ->groupBy('Colaborador');

        // ->editColumns(['Total Balance', 'Status'], [ // Mass edit column
        //     'class' => 'right bold'
    // ])
        // ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
        //     'Total Balance' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
        // ])
        // ->limit(20) // Limit record to be showed
        
        $res = $PdfGenerate->download("a.pdf");
        $stream = $PdfGenerate->stream();

        return $stream;


        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        try {
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
            ->editColumn('Status', [ // Change column class or manipulate its data for displaying to report
                'displayAs' => function($result) {
                    return $result->con_ean;
                    dd($result->con_ean);
                    // return $result->dhcadastro;
                },
                // 'class' => 'left'
            ])
            // ->editColumns(['Total Balance', 'Status'], [ // Mass edit column
            //     'class' => 'right bold'
        // ])
            // ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
            //     'Total Balance' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
            // ])
            // ->limit(20) // Limit record to be showed
            ->stream();
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
 // other available method: store('path/to/file.pdf') to save to disk, download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }

    
}
