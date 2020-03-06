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
        </style>
	</head>
	<body>
        <section class="header">
            <img src="{{ public_path('assets/images/prints/header-logo.png') }}" style="height: 180px;">
            {{-- <h2>Surigao del Sur State University</h2>
            <h4>Rosario, Tandag City, Surigao del Sur 8300</h4>
            <h4>Telefax No. 086-214-4221</h4>
            <h4>Website: www.sdssu.edu.ph</h4> --}}
            <hr style="position:relative; top:-25px;">
        </section>
        <table>
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
	</body>
</html>