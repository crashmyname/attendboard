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
        .yellow { background-color: #fdfd13; }
        .orange { background-color: #fd7e14; }
        .red { background-color: #d63939; }

        .table-striped > tbody > tr:nth-of-type(odd) > td {
            background-color: unset;
        }

        /* default semua cell normal */
        .table td {
            background-color: #fff;
        }

        /* hanya kolom tanggal yang di-grey */
        td.date-col:not(.today-col) {
            background-color: #e9ecef !important;
        }

        /* kolom hari ini */
        td.today-col {
            background-color: #ffffff !important;
            font-weight: bold;
        }

        thead th {
            font-size: 14px !important;
        }

        #header-dates th {
            font-size: 13px !important;
            font-weight: 600;
        }

        #header-days th {
            font-size: 12px !important;
            font-weight: 500;
        }
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }
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
                    <div class="loading-overlay d-none" id="loadingOverlay">
                        <div class="spinner-border text-primary"></div>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title">Attendance Board</h3>
                    </div>
                    <div class="table-responsive sticky-header" style="max-height: 75vh;">
                        <table class="table table-vcenter table-bordered">
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
                                <tr id="header-dates"></tr>
                                <tr id="header-days"></tr>
                            </thead>
                            <tbody>
                                <!-- <tr>
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
                                </tr> -->
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
function getWeekDatesManual() {
    return [
        '20260413',
        '20260414',
        '20260415',
        '20260416',
        '20260417',
        '20260418'
    ]
}
function getWeekDates() {
    let today = new Date()
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

function formatDate(ymd) {
    return `${ymd.slice(6,8)}/${ymd.slice(4,6)}/${ymd.slice(2,4)}`
}

function getDayName(ymd) {
    let d = new Date(ymd.slice(0,4), ymd.slice(4,6)-1, ymd.slice(6,8))
    return ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'][d.getDay()]
}

let weekDates = getWeekDates()

let today = new Date()
let yyyy = today.getFullYear()
let mm = String(today.getMonth() + 1).padStart(2, '0')
let dd = String(today.getDate()).padStart(2, '0')

let todayYmd = `${yyyy}${mm}${dd}`
let todayIndex = weekDates.indexOf(todayYmd)

// RENDER HEADER DINAMIS
function renderHeader() {
    let headerDates = ''
    let headerDays = ''

    weekDates.forEach((date, i) => {
        let cls = (i === todayIndex) ? 'today-col' : ''

        headerDates += `<th class="${cls}">${formatDate(date)}</th>`
        headerDays += `<th class="${cls}">${getDayName(date)}</th>`
    })

    $("#header-dates").html(headerDates)
    $("#header-days").html(headerDays)
}

// RENDER TABLE
function renderTable(res) {

    let html = ''
    let grouped = {}

    res.data.forEach(emp => {
        if (!grouped[emp.section]) {
            grouped[emp.section] = []
        }
        grouped[emp.section].push(emp)
    })

    let no = 1

    Object.keys(grouped).forEach(section => {

        html += `
            <tr>
                <td colspan="13" style="text-align:left; font-weight:bold; background:#f1f3f5;">
                    ${section.toUpperCase()}
                </td>
            </tr>
        `

        grouped[section].forEach(emp => {

            let todayAtt = emp.attendance?.[todayYmd]

            let inDot = ''
            let outDot = ''
            
            if (!todayAtt) {
                outDot = `<div class="status-indicator blue"></div>`
            }

            if (todayAtt && todayAtt.jamMasuk && todayAtt.jamMasuk !== '-' && todayAtt.jamKeluar === '-') {
                inDot = `<div class="status-indicator blue"></div>`
            }

            if (todayAtt && todayAtt.jamKeluar && todayAtt.jamKeluar !== '-') {
                outDot = `<div class="status-indicator blue"></div>`
            }

            if (todayAtt && todayAtt.kode === 'NC' || ['A1','A2','CT','SD','KK'].includes(todayAtt && todayAtt.kode)) {
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

            weekDates.forEach((date, i) => {
                let att = emp.attendance?.[date]

                let cls = (i === todayIndex) ? 'today-col' : ''

                let color = ''

                if (att && ['A1','A2','CT','SD','KK'].includes(att.kode)) {
                    color = 'red'
                }

                html += `
                    <td class="date-col ${cls}">
                        ${att ? `<div class="status-indicator ${color}"></div>` : ''}
                    </td>
                `
            })

            html += `
                <td class="${todayIndex !== -1 ? 'today-col' : ''}">
                    ${todayAtt?.kode ?? '-'}
                </td>
                <td>${emp?.calculateActOtMinutes ?? '-'}</td>
            </tr>
            `
        })
    })

    $("tbody").html(html)

    //  AUTO SCROLL KE HARI INI
    setTimeout(() => {
        let colIndex = todayIndex + 6
        let container = document.querySelector('.table-responsive')

        let cell = document.querySelector(`tbody tr td:nth-child(${colIndex})`)

        if (cell && container) {
            container.scrollLeft = cell.offsetLeft - 200
        }
    }, 300)
}

// LOAD DATA
function loadData() {
    $("#loadingOverlay").removeClass("d-none")
    $.ajax({
        url: "<?= env('API_DATA')?>",
        method: "POST",
        contentType: "application/json",
        data: JSON.stringify({
            api_key: "P@ssw0rdKuatBanget14045",
            dept_id: $("#deptSelect").val()
        }),
        success: function(res) {
            renderTable(res)
        },
        error: function() {
            alert("Gagal load data")
        },
        complete: function() {
            $("#loadingOverlay").addClass("d-none")
        }
    })
}

$("#deptSelect").on("change", loadData)

// INIT
renderHeader()
loadData()

</script>
</html>