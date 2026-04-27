<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papan Monitoring Absensi & Overtime</title>

    <link href="<?= asset('tabler/dist/css/tabler.min.css') ?>" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <style>
        body{
            background:#f5f7fb;
        }
        .board-title{
            font-size:32px;
            font-weight:700;
        }
        .period-title{
            font-size:20px;
            color:#6c757d;
        }
        .status-box{
            width:100%;
            height:35px;
            border-radius:6px;
        }
        .table th, .table td{
            text-align:center;
            vertical-align:middle;
            white-space: nowrap;
        }
        .sticky-header thead th{
            position: sticky;
            top: 0;
            z-index: 2;
            background: white;
        }
        .status-indicator{
            width: 22px;
            height: 22px;
            border-radius: 50%;
            margin: auto;
        }

        .blue { background-color: #206bc4; }
        .green { background-color: #2fb344; }
        .yellow { background-color: #f59f00; }
        .orange { background-color: #fd7e14; }
        .red { background-color: #d63939; }
    </style>
</head>
<body>
<div class="page">
    <div class="container-fluid py-4">

        <!-- Header -->
        <div class="mb-4 text-center">
            <div class="board-title">PAPAN MONITORING ABSENSI & OVERTIME</div>
            <div class="period-title">Period : April 2026</div>
            <div class="row">
                <div class="col-md-3">
                    <select name="" class="form-control" id="">
                        <option value="ISS">ISS</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Main Table -->
            <div class="col-md-9">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">Attendance Board</h3>
                    </div>
                    <div class="table-responsive sticky-header" style="max-height: 75vh;">
                        <table class="table table-vcenter table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th rowspan="3">No</th>
                                    <th rowspan="3">Nama</th>
                                    <th rowspan="3">Jobdesk</th>
                                    <th rowspan="3">IN</th>
                                    <th rowspan="3">OUT</th>
                                    <th colspan="6">Tanggal</th>
                                    <th rowspan="3">Keterangan</th>
                                    <th rowspan="3">OT (Jam)</th>
                                </tr>
                                <tr>
                                    <th>27/4/26</th>
                                    <th>28/4/26</th>
                                    <th>29/4/26</th>
                                    <th>30/4/26</th>
                                    <th>1/5/26</th>
                                    <th>2/5/26</th>
                                </tr>
                                <tr>
                                    <th>Senin</th>
                                    <th>Selasa</th>
                                    <th>Rabu</th>
                                    <th>Kamis</th>
                                    <th>Jumat</th>
                                    <th>Sabtu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Fadli Azka Prayogi</td>
                                    <td>IT Support</td>
                                    <td>08:00</td>
                                    <td>17:00</td>
                                    <td><div class="status-indicator blue"></div></td>
                                    <td><div class="status-indicator green"></div></td>
                                    <td><div class="status-indicator yellow"></div></td>
                                    <td><div class="status-indicator orange"></div></td>
                                    <td><div class="status-indicator red"></div></td>
                                    <td><div class="status-indicator blue"></div></td>
                                    <td>Meeting dengan supplier</td>
                                    <td>2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Legend -->
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">Keterangan</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-center">
                            <span class="badge badge-pill bg-blue me-2">&nbsp;&nbsp;&nbsp;</span> IN / OUT
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <span class="badge bg-green me-2">&nbsp;&nbsp;&nbsp;</span> GENBA
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <span class="badge bg-yellow me-2">&nbsp;&nbsp;&nbsp;</span> MEETING
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <span class="badge bg-orange me-2">&nbsp;&nbsp;&nbsp;</span> TUGAS LUAR
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <span class="badge bg-red me-2">&nbsp;&nbsp;&nbsp;</span> TIDAK MASUK
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>