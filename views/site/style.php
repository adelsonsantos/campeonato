<head>
    <style>
        table.diaria {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th.borda {
            border: 0.5px solid #b5b5b5;
            text-align: left;
            padding: 8px;
        }

        tr.bordaMenu {
            background-color: #82a3bd;
        }

        tr:nth-child(even) {
            background-color: #ffffff;
        }

        .font-topo {
            font-size: 20px;
            font-weight: bold;
        }
        #imageDiaria {
            content: url(<?php /*echo Yii::$app->request->baseUrl . '../../image/iconDiarias.png';*/ ?>);
            margin-left: 30px;
            margin-bottom: auto;
            margin-top: 5px;
            transition: .5s ease;
            float: left;
        }

        #classificacao table {
            font-family: arial, sans-serif;
            border-collapse: collapse;

            font-weight: bold;
        }

        #classificacao td, th {
            border: 1px solid #949090;
            text-align: left;
            padding: 5px;
            font-weight: bold;
            font-size: 25px;
        }

        #classificacao tr:nth-child(even) {
            background-color: #dddddd;
        }

        #classificacao th, .table-dark thead th {
            border-color: white;
            color: white;
            background-color: #222;
        }


        #jogos table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            font-weight: bold;
        }

        #jogos td, th {
            border: 1px solid #949090;
            text-align: left;
            padding: 5px;
            font-weight: bold;
            font-size: 25px;
        }

        #jogos tr:nth-child(even) {
            background-color: rgba(221, 221, 221, 0.42);
        }

        #jogos th, .table-dark thead th {
            border-color: white;
            color: white;
            background-color: #989898;
        }

        #conteudo-index {
            padding-left: 130px;
        }

        #conteudo-itemm {
            min-width: 250px;
            max-width: 800px;
            margin-top: 10px;
        }
        #conteudo-item {
            min-width: 440px;
            max-width: 250px;
            margin-top: 10px;
        }
    </style>
</head>