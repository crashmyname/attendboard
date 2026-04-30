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
            background: white;
            z-index: 10;
        }

        /* baris 1 header */
        .sticky-header thead tr:nth-child(1) th{
            top: 0;
            z-index: 30;
        }

        /* baris 2 header (tanggal) */
        .sticky-header thead tr:nth-child(2) th{
            top: 40px; /* sesuaikan tinggi row 1 */
            z-index: 20;
        }

        /* baris 3 header (hari) */
        .sticky-header thead tr:nth-child(3) th{
            top: 70px; /* sesuaikan tinggi row 1 + 2 */
            z-index: 10;
        }
        .status-indicator{
            width: 22px;
            height: 22px;
            border-radius: 50%;
            margin: auto;
        }

        .blue { background-color: #206bc4; }
        .green { background-color: #2fb344; }
        .yellow { background-color: #dcdc1a; }
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
                    <select name="dept_id" class="form-control" id="deptSelect">
                        <option value="01086">CA DEPT</option>
                        <option value="01085">ACC DEPT</option>
                        <option value="01087">SALES DEPT</option>
                        <option value="01088">DESIGN DEPT</option>
                        <option value="01089">QA DEPT</option>
                        <option value="01090">MDF DEPT</option>
                        <option value="01091">NMC DEPT</option>
                        <option value="01092">PE DEPT</option>
                        <option value="01094">PC DEPT</option>
                        <option value="01095">PRC DEPT</option>
                        <option value="01096">FACT 1 DEPT</option>
                        <option value="01097">FACT 2 DEPT</option>
                        <option value="01098">PN DEPT</option>
                        <option value="01099">AD DEPT</option>
                        <option value="01100">QC DEPT</option>
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
                            <span class="avatar avatar-xs rounded-pill bg-blue me-2"></span> IN / OUT
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <span class="avatar avatar-xs rounded-pill bg-green me-2"></span> GENBA
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <span class="avatar avatar-xs yellow rounded-pill me-2"></span> MEETING
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <span class="avatar avatar-xs rounded-pill bg-orange me-2"></span> TUGAS LUAR
                        </div>
                        <div class="mb-3 d-flex align-items-center">
                            <span class="avatar avatar-xs rounded-pill bg-red me-2"></span> TIDAK MASUK
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
<script>

function getWeekDates() {
    let today = new Date()

    // cari hari senin
    let day = today.getDay()
    let diff = today.getDate() - day + (day === 0 ? -6 : 1)

    let monday = new Date(today.setDate(diff))

    let dates = []

    for (let i = 0; i < 6; i++) {
        let d = new Date(monday)
        d.setDate(monday.getDate() + i)

        let yyyy = d.getFullYear()
        let mm = String(d.getMonth() + 1).padStart(2, '0')
        let dd = String(d.getDate()).padStart(2, '0')

        dates.push(`${yyyy}${mm}${dd}`)
    }

    return dates
}

let weekDates = getWeekDates()

let today = new Date()
let yyyy = today.getFullYear()
let mm = String(today.getMonth() + 1).padStart(2, '0')
let dd = String(today.getDate()).padStart(2, '0')

let todayYmd = `${yyyy}${mm}${dd}`

function renderTable(res) {

    let html = ''

    // 🔥 grouping by section
    let grouped = {}

    res.data.forEach(emp => {
        if (!grouped[emp.section]) {
            grouped[emp.section] = []
        }
        grouped[emp.section].push(emp)
    })

    let no = 1

    // 🔥 looping per section
    Object.keys(grouped).forEach(section => {

        // HEADER SECTION
        html += `
            <tr>
                <td colspan="13" style="text-align:left; font-weight:bold; background:#f1f3f5;">
                    ${section.toUpperCase()}
                </td>
            </tr>
        `

        // DATA KARYAWAN
        grouped[section].forEach(emp => {

            let todayAtt = emp.attendance?.[todayYmd]

            let inDot = ''
            let outDot = ''

            if (todayAtt?.jamMasuk && todayAtt.jamMasuk !== '-' && todayAtt.jamKeluar === '-') {
                inDot = `<div class="status-indicator blue"></div>`
            }

            if (todayAtt?.jamKeluar && todayAtt.jamKeluar !== '-') {
                outDot = `<div class="status-indicator blue"></div>`
            }

            html += `
            <tr>
                <td>${no++}</td>
                <td style="text-align:left">${emp.name}</td>
                <td></td>
                <td>${inDot}</td>
                <td>${outDot}</td>
            `

            weekDates.forEach(date => {
                let att = emp.attendance?.[date]

                if (att) {

                    let color = ''

                    if (
                        ['A1','A2','CT','SD','KK'].includes(att.kode)
                    ) color = 'red'

                    // if (att.kode === 'NC') color = 'yellow'

                    html += `
                        <td>
                            <div class="status-indicator ${color}"></div>
                        </td>
                    `
                } else {
                    html += `<td></td>`
                }
            })

            html += `
                <td>${todayAtt.kode}</td>
                <td>-</td>
            </tr>
            `
        })
    })

    $("tbody").html(html)
}

function loadData() {

    $.ajax({
        url: "http://localhost:3333/hr/api/v1/data/perdept/weekly/get",
        method: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            api_key: "P@ssw0rdKuatBanget14045",
            dept_id: $("#deptSelect").val()
        }),
        success: function(res) {
            renderTable(res)
        }
    })
}

$("#deptSelect").on("change", loadData)

loadData()

</script>
</html>