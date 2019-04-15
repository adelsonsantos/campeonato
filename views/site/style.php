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
    </style>
</head>