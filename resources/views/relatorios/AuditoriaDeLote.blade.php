<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .border-dotted{
            border-style: dotted;
            }
			.mt-1{
				padding-top:5px;
				padding-bottom:5px;
			}
			.smallFont{
				font-size:12px;
				border-top:1px solid black!important;
				
			}
			.midFont{
				padding-top:10px!important;
				border-top:1px solid black!important;
				font-size:18px;
			}
			body {
			    font-family: Arial, Helvetica, sans-serif;
			}
			.wrapper {
				margin: 0 -20px 0;
				padding: 0 15px;
			}
		    .middle {
		        text-align: center;
		    }
		    .title {
			    font-size: 35px;
		    }
		    .pb-10 {
		    	padding-bottom: 10px;
		    }
		    .pb-5 {
		    	padding-bottom: 5px;
		    }
		    .head-content{
		    	padding-bottom: 4px;
		    	border-style: none none ridge none;
		    	font-size: 18px;
		    }
            thead { display: table-header-group; }
            tfoot { display: table-row-group; }
            tr { page-break-inside: avoid; }
		    table.table {
		    	font-size: 13px;
		    	border-collapse: collapse;
		    }
			.page-break {
		        page-break-after: always;
		        page-break-inside: avoid;
			}
			tr.even {
				background-color: #eff0f1;
			}
			table .left {
				text-align: left;
			}
			table .right {
				text-align: right;
			}
			table .bold {
				font-weight: 600;
			}
			.bg-black {
				background-color: #000;
			}
			.f-white {
				color: #fff;
			}
			
		</style>
    
    <title>Hello, world!</title>
    <button class="btn btn-primary">Bootstrap btn</button>
</head>

<body>

    <table class="table">
        <thead>
            <tr>
                <td>Imagem</td>
                <td>Latin America Inventory Service<br><span style="font-size:10px" CNPJ: 27.690.850/0001-15</span></td>
                <td>0026</td>
            </tr>
            <tr class="smallFont" style="border-collapse: collapse; outline: thin solid">
                <td class="smallFont mt-1">Cliente: <b>GPA - MINUTO PA (6765)</b></td>
                <td class="smallFont mt-1">Gerente: <b>RENATA</b></td>
                <td class="smallFont mt-1">Nº da OS: <b1.605.190.0G /PA22</b>
                </td>
            </tr>
            <tr class="smallFont">
                <td>Endereço: <b>CORONEL SILVA TELES Nº 170 |</b></td>
                <td>Líder: <b>RICHARD RODRIGUES DE OLIVEIRA</b></td>
                <td>Data Inventário: <b>16/05/2022 (Seg) - 19:00</b></td>
            </tr>
            <tr style="border-collapse: collapse; outline: thin solid">
                <td colspan="3" class="text-center"><u>Relatório de auditoria de lote</u></td>
            </tr>
        </thead>
    </table>

    <table class="table">
        <tbody>
                <tr>
                <!-- <td>Colaborador</td> -->
                <td>Ref</td>
                <td>Seção</td>
                <td>EAN</td>
                <td>PLU</td>
                <td>Descrição produto</td>
                <td>Qde</td>
                <td>Ajuste</td>
                <td>Status</td>
                </tr>
                @foreach($infos as $info)
                <tr class="border-bottom ">
                <!-- <tr class="page-break"> -->
                    <!-- <td>Colaborador</td> -->
                    <td>{{$info->codcontagem}}</td>
                    <td>{{$info->sec_secao}}</td>
                    <td>{{$info->con_ean}}EAN</td>
                    <td>{{$info->con_cadcodint}}PLU</td>
                    <td>{{$info->cad_desc}}Descrição</td>
                    <td>{{$info->codcontagem}}Qde</td>
                    <td>{{$info->codcontagem}}Ajuste</td>
                    <td>{{$info->codcontagem}}Status</td>
                </tr>
                @endforeach
                
            </tbody>
                    
        </table>
    <div class="page-break"></div>
    <table class="table">
        <thead>
            <tr>
                <td>Imagem</td>
                <td>Latin America Inventory Service<br><span style="font-size:10px" CNPJ: 27.690.850/0001-15</span></td>
                <td>0026</td>
            </tr>
            <tr class="smallFont" style="border-collapse: collapse; outline: thin solid">
                <td class="smallFont mt-1">Cliente: <b>GPA - MINUTO PA (6765)</b></td>
                <td class="smallFont mt-1">Gerente: <b>RENATA</b></td>
                <td class="smallFont mt-1">Nº da OS: <b1.605.190.0G /PA22</b>
                </td>
            </tr>
            <tr class="smallFont">
                <td>Endereço: <b>CORONEL SILVA TELES Nº 170 |</b></td>
                <td>Líder: <b>RICHARD RODRIGUES DE OLIVEIRA</b></td>
                <td>Data Inventário: <b>16/05/2022 (Seg) - 19:00</b></td>
            </tr>
            <tr style="border-collapse: collapse; outline: thin solid">
                <td colspan="3" class="midFont"><u>Relatório de auditoria de lote</u></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
