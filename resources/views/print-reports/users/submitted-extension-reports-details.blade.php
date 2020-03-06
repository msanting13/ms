<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Reports</title>
        <style>
            #cost { font-family: DejaVu Sans, sans-serif; }
            table {
                border-collapse: collapse;
                width: 100%;
            }

            table, th, td {
                border: 1px solid black;
            }
            td.data{
                text-align: justify;
            }
            th, td {
                padding: 15px;
            }
            th{
                text-align: left;
            }
            .header{
                text-align: center;
            }
            .header h2, h4{
                border: 1px solid#ccc;
                margin: 0px;
            }
            * {
              box-sizing: border-box;
            }


            .img-header {
              text-align: center;
              padding: 32px;
            }

            .row {
              display: -ms-flexbox; /* IE10 */
              display: flex;
              -ms-flex-wrap: wrap; /* IE10 */
              flex-wrap: wrap;
              padding: 0 4px;
            }

            /* Create four equal columns that sits next to each other */
            .column {
              -ms-flex: 25%; /* IE10 */
              flex: 25%;
              max-width: 25%;
              padding: 0 4px;
            }

            .column img {
              margin-top: 8px;
              vertical-align: middle;
              width: 100%;
            }

            /* Responsive layout - makes a two column-layout instead of four columns */
            @media screen and (max-width: 800px) {
              .column {
                -ms-flex: 50%;
                flex: 50%;
                max-width: 50%;
              }
            }

            /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
            @media screen and (max-width: 600px) {
              .column {
                -ms-flex: 100%;
                flex: 100%;
                max-width: 100%;
              }
            }
            .primary {page-break-after: always;}
        </style>
	</head>
	<body>
        <section class="header">
            <img src="https://res.cloudinary.com/zyana/image/upload/v1583460431/assets/header-logo_i2kbjj.png" style="height: 180px;">
            {{-- <h2>Surigao del Sur State University</h2>
            <h4>Rosario, Tandag City, Surigao del Sur 8300</h4>
            <h4>Telefax No. 086-214-4221</h4>
            <h4>Website: www.sdssu.edu.ph</h4> --}}
            <hr style="position:relative; top:-25px;">
        </section>
        <table class="primary">
            <tbody>
                <tr>
                    <th>Title:</th>
                    <td>{{ $data->title }}</td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td class="data">{{ $data->short_description }}</td>
                </tr>
                <tr>
                    <th>Project cost:</th>
                    <td id="cost">{{ $data->project_cost }}</td>
                </tr>
                <tr>
                    <th>Funding source:</th>
                    <td>{{ $data->funding_source }}</td>
                </tr>
                <tr>
                    <th>Agency:</th>
                    <td>{{ $data->agency }}</td>
                </tr>
                <tr>
                    <th>SDG's addressed:</th>
                    <td class="data">{{ $data->sdgs_addressed }}</td>
                </tr>
                <tr>
                    <th>Beneficiaries:</th>
                    <td class="data">{{ $data->beneficiaries }}</td>
                </tr>
            </tbody>
        </table>
        <div class="secondary">
            <div class="img-header">
              <h1>Photos</h1>
            </div>
            <div class="row"> 
              <div class="column">
                @foreach($data->extensionReportPhotos as $photo)
                    <img src="{{ $photo->url }}" style="width:100%">
                @endforeach
              </div>
            </div>
        </div>
	</body>
</html>