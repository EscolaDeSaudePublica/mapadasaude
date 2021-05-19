<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<style>
    .activeTr{
    /* background-color: #c3c3c3; */
    /* border: 1px solid black; */
    margin-top: 10px;
    color: saddlebrown;
    border-radius: 5px;
    }
    .th-right{
    float: left;
    margin-left: 5px;
    color:#3C3939;
    /* width: 300%; */
    }
    .text-center {
    text-align: center;
    }
    .table {
    background-color: transparent;
    font-size: 12px;
    font-family: Arial, Helvetica, sans-serif;
    }
    .caption {
    padding-top: 8px;
    padding-bottom: 8px;
    color: #777;
    text-align: left;
    }
    th {
    text-align: left;
    }
    .table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
    }
    .table > thead > tr > th,
    .table > tbody > tr > th,
    .table > tfoot > tr > th,
    .table > thead > tr > td,
    .table > tbody > tr > td,
    .table > tfoot > tr > td {
    padding: 2px;
    line-height: 1.42857143;
    vertical-align: top;
    }
    .table > thead > tr > th {
    vertical-align: bottom;
    /* border-bottom: 1px solid #ddd; */
    }
    .table > tbody + tbody {
    border-top: 1px solid #716e6e;
    }
    .table .table {
    background-color: #fff;
    }
    .table-bordered {
    /*border: 1px solid #ddd;*/
    border: 1px solid #716e6e;
    }
    .table-bordered > thead > tr > th,
    .table-bordered > tbody > tr > th,
    .table-bordered > tfoot > tr > th,
    .table-bordered > thead > tr > td,
    .table-bordered > tbody > tr > td,
    .table-bordered > tfoot > tr > td {
    border: 1px solid #716e6e;
    }
    .table-striped > thead > tr > th,
    .table-striped > tfoot > tr > th,
    .table-striped > tbody > tr > th,
    .table-striped > thead > tr > td,
    .table-striped > tbody > tr > td,
    .table-striped > tfoot > tr > td {
    border-bottom: 1px solid #716e6e;
    }
    .space-tbody-10 {
    width: 15%;
    }
    .space-tbody-15 {
    width: 20%;
    }
    .table-striped > tbody > tr:nth-of-type(odd) {
    background-color: #f9f9f9;
    }
    .table-hover > tbody > tr:hover {
    background-color: #f5f5f5;
    }
    table col[class*="col-"] {
    position: static;
    display: table-column;
    float: none;
    }
    table td[class*="col-"],
    table th[class*="col-"] {
    position: static;
    display: table-cell;
    float: none;
    }
    .table > thead > tr > td.active,
    .table > tbody > tr > td.active,
    .table > tfoot > tr > td.active,
    .table > thead > tr > th.active,
    .table > tbody > tr > th.active,
    .table > tfoot > tr > th.active,
    .table > thead > tr.active > td,
    .table > tbody > tr.active > td,
    .table > tfoot > tr.active > td,
    .table > thead > tr.active > th,
    .table > tbody > tr.active > th,
    .table > tfoot > tr.active > th {
    background-color: #f5f5f5;
    }
    .table-hover > tbody > tr > td.active:hover,
    .table-hover > tbody > tr > th.active:hover,
    .table-hover > tbody > tr.active:hover > td,
    .table-hover > tbody > tr:hover > .active,
    .table-hover > tbody > tr.active:hover > th {
    background-color: #e8e8e8;
    }
    .table-responsive {
    min-height: .01%;
    overflow-x: auto;
    }
    .fontArial {
    font-family: Arial !important;
    }
    .td-classificacao {
    width: 10%;  border-right: 1px solid black
    }
    .border-title {
    border: 1px solid #716e6e;
    }
    .container {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
    }
    @media print {
        tr.vendorListHeading {
            background-color: #1a4567 !important;
            -webkit-print-color-adjust: exact; 
        }
    }

@media print {
    .vendorListHeading th {
        color: white !important;
    }
}
</style>
<script>
    $(document).ready(function () {
        //
        //window.print();
    });
    $(function () {
      $("#btn-print-report").click(function (e) { 
         console.log(e);
         e.preventDefault();
         $("#btn-print-report").css('display', 'none');
         window.print();
         setTimeout(() => {
          $("#btn-print-report").css('display', 'inline-block');
         }, 1000);
     });
    });
</script>

<div class="container">
    <table width="100%" >
        <thead>
            <tr class="text-center">
                <td>
                    <img src="https://mapadasaude.dev.org.br/assets/img/logo_escola_estado.png" style="width: 400px;"/>
                </td>
            </tr>
            <tr class="text-center">
                <td>
                    <h4 style="margin-top: 15px;"><?php echo $app->view->jsObject['title']; ?></h4>
                </td>
            </tr>
            <tr class="text-center">
                <td><h5 style="margin-top: 10px;"><?php echo $nameOpportunity; ?></h5></td>
            </tr>
        </thead>
    </table>
</div>
