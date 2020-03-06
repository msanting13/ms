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

            /* td.data{
                text-align: justify;
            }
            th, td {
                padding: 15px;
            }
            th{
                text-align: left;
            }  */

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
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
        <table style="overflow:hidden;">
            <thead>
                <tr>
                    <th>Research title</th>
                    <th>Description</th>
                    <th>Project cost</th>
                    <th>Funding source</th>
                    <th>Agency</th>
                    <th>SDG/s addressed</th>
                    <th>Beneficiaries</th>
                    <th>Date submitted</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($data as $value)
                    <tr>
                        <td valign="top">{{ $value->title }}</td>
                        <td class="data" valign="top">
                            <div style="word-wrap: break-word;">
                                {{ $value->short_description }}
                            </div>
                        </td>
                        <td valign="top" id="cost">{{ $value->project_cost }}</td>
                        <td valign="top">{{ $value->funding_source }}</td>
                        <td valign="top">{{ $value->agency }}</td>
                        <td valign="top">{{ $value->sdgs_addressed }}</td>
                        <td class="data" valign="top">
                            <div style="word-wrap: break-word;">
                                {{ $value->beneficiaries }}
                            </div>
                        </td>
                        <td valign="top">{{ $value->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
	</body>
</html>